<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Yajra\Datatables\Facades\Datatables;
use Yajra\Datatables\Services\DataTable;
use Yajra\Datatables\Facades\Datatables\Editor;
use Yajra\Datatables\Facades\Datatables\Field;
use Yajra\Datatables\Facades\Datatables\Format;
use Yajra\Datatables\Facades\Datatables\Mjoin;
use Yajra\Datatables\Facades\Datatables\Options;
use Yajra\Datatables\Facades\Datatables\Upload;
use Yajra\Datatables\Facades\Datatables\Validate;
use App\Models\Event;
use App\Models\Dapil;
use App\Models\Jenis;
use App\Models\Tingkat;
use App\Models\DapilLokasi;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\UserEvent;
use App\Models\RoleUser;
use Sentinel;
use Charts;
use Flash;


class EventController extends Controller
{
    public function index()
    {
        return view('layouts.event.index');
    }

    public function get_datatable()
    {
        $userEvents = UserEvent::all()->where('user_id', Sentinel::getUser()->id);
        foreach ($userEvents as $key => $userEvent) {
            $listEventId[$key] = $userEvent->event_id;
        }
        if(count($userEvents) != 0)
        {
            $data_event = Event::whereIn('id', $listEventId);
        }
        else
        {
            $data_event = Event::where('tahun', 1945);
        }

        return Datatables::eloquent($data_event)
        ->editColumn('jenis', function (Event $event) {
            return $event->jenis && $event->jenis->nama ? $event->jenis->nama : 'Undefined';
        })
        ->editColumn('lokasi', function (Event $event) {
            if($event->tingkat_id == 2){
                $result = Provinsi::where('id',$event->lokasi)->first()->nama;
            }
            else if($event->tingkat_id == 3){
                $result = Kota::where('id',$event->lokasi)->first()->nama;
            } else {
                $result = 'Indonesia';
            }
            return $result;
        })
        ->editColumn('tingkat', function (Event $event) {
            return $event->tingkat && $event->tingkat->nama ? $event->tingkat->nama : 'Undefined';
        })
        ->addColumn('action', function ($data_event) {
            return '<a href="'.route('event.show', $data_event->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i>Lihat</a><a href="'.route('event.edit', $data_event->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('event.delete', $data_event->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
        })
        ->make(true);
    }

    public function create()
    {

        $provinsi = Provinsi::pluck('nama','id')->all();
        $jenis = Jenis::pluck('nama','id')->all();
        $tingkat = Tingkat::pluck('nama','id')->all();
        $kota = array();

        return view('layouts.event.create', compact('provinsi','kota', 'jenis', 'tingkat'));
    }

    public function store(Request $request)
    {

    $v = $this->validate($request,[
      'jenis_id' => 'required',
       // 'tingkat_id' => 'required',
       'expired' => 'required',
       'nama' => 'required',
       // 'lokasi' => 'required',
       'tahun' => 'required',
        ]);


        if($request->jenis_id == 4 || $request->jenis_id == 5){
            if ($request->tingkat_id == 2){
                $request->merge(['lokasi' => $request->provinsi]);
            }
            else if ($request->tingkat_id == 3) {
                $request->merge(['lokasi' => $request->kota]);
            }
            else {
                $request->merge(['lokasi' => 0]);
            }
        } else {
            $request->merge(['lokasi' => 0]);
        }

        $input = $request->all();


        $data_event = Event::create($input);

        $insertedId = $data_event->id;

        try
        {
            $user = new UserEvent;
            $user->user_id = Sentinel::getUser()->id;
            $user->event_id = $insertedId;
            $user->save();
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }


        flash('Data Event created successfully')->success();
        return redirect(route('event.show',$data_event));
    }


    public function edit($id)
    {
        $userEvents = UserEvent::all()->where('user_id', Sentinel::getUser()->id);
        foreach ($userEvents as $key => $userEvent) {
            $listEventId[$key] = $userEvent->event_id;
        }

        $os = array("Mac", "NT", "Irix", "Linux");
        if (in_array($id, $listEventId)) {

            $event = Event::find($id);
            $jenis = Jenis::pluck('nama','id')->all();
            $tingkat = Tingkat::pluck('nama','id')->all();
            $provinsi = Provinsi::pluck('nama','id')->all();
            $kota = Kota::where('provinsi_id', $event->provinsi_id)->pluck('nama','id')->all();

            if (empty($event)) {
                flash('Event Tidak Ada');

                return redirect(route('event.index'));
            }
            return view('layouts.event.edit', compact('event','provinsi','kota','jenis','tingkat'));
        } else {
            flash('Event Tidak Ada');

            return redirect(route('event.index'));
        }

    }
    public function update(Request $request,$id)
    {
      // $v = $this->validate($request,[
      //   'jenis_id' => 'required',
      //    // 'tingkat_id' => 'required',
      //    'expired' => 'required',
      //    'nama' => 'required',
      //    // 'lokasi' => 'required',
      //    'tahun' => 'required',
      //    'lokasi' => 'required',
      //     ]);

        $event = Event::find($id);
        if (empty($event)) {

            flash('Calon not found');

            return redirect(route('event.index'));
        }

        if($request->jenis_id == 4 || $request->jenis_id == 5){
            if ($request->tingkat_id == 2){
                $request->merge(['lokasi' => $request->provinsi]);
            }
            else if ($request->tingkat_id == 3) {
                $request->merge(['lokasi' => $request->kota]);
            }
            else {
                $request->merge(['lokasi' => 0]);
            }
        } else {
            $request->merge(['lokasi' => 0]);
        }

        $event->nama            = $request->nama;
        $event->expired          = $request->expired;
        $event->jenis_id       = $request->jenis_id;
        $event->lokasi           = $request->lokasi;
        $event->tahun        = $request->tahun;
        $event->tingkat_id   = $request->tingkat_id;

        $event->update();

        $role = RoleUser::where('user_id', $id)->first();
        $role->role_id = $request->role;
        dd($role);
        $role->update();

        flash('Data Event updated successfully')->success();

        return redirect(route('event.show', $event));

    }

    public function show($id)
    {

        $event = Event::find($id);
        $eventchart = Event::chart()->where("event.id", $event->event_id)->get()->toJson();


        if (empty($event)) {
            flash('Event not found')->error();

            return redirect(route('event.index'));
        }
        if($event->jenis_id == 5 || $event->jenis_id == 4)
        {
            if($event->tingkat_id == 2){
                $result = Provinsi::where('id',$event->lokasi)->orderBy('nama', 'ASC')->get()->pluck( 'nama', 'id' )->first();
            }
            else if($event->tingkat_id == 3){
                $result = Kota::where('id',$event->lokasi)->orderBy('nama', 'ASC')->get()->pluck( 'nama', 'id' )->first();
            }
        }
        else
        {
            $result = Kota::find('id',$event->lokasi);
        }

        // return response()->json($event);
        return view('layouts.event.show',compact('event','chart','result','eventchart'));


    }

    public function destroy($id)
    {

        $event = Event::findOrFail($id);
        if (empty($event)) {

            flash('Event not found');

            return redirect(route('event.index'));
        }
        $event->delete();

        $role = RoleUser::where('user_id', $id)->first();
        $role->delete();

        flash('Data Saksi deleted successfully')->success();
        return redirect(route('event.index'));
    }

    public function ajax(Request $request)
    {
        $type = $request->type;
        switch ($type) {
            case 'get-provincy':
            $result = Provinsi::get()->pluck( 'nama', 'id' )->all();
            return $result;
            break;

            case 'get-city':
            $result = Kota::where('provinsi_id',$request->provinsi_id)->orderBy('nama', 'ASC')->get()->pluck( 'nama', 'id' )->all();
            return $result;
            break;

            case 'get-kecamatan':
            return Kecamatan::where('kota_id', $request->kota_kabupaten_id)->orderBy('nama', 'ASC')->get()->pluck('nama', 'id')->all();
            break;

            default:
            return $result['status'] = false;
            break;
        }
    }
}
