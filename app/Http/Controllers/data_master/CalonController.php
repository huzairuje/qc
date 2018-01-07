<?php

namespace App\Http\Controllers\data_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
use Charts;
use Flash;
use App\Models\Calon;
use App\Models\Event;
use App\Models\Dapil;
use App\Models\Partai;
use App\Models\UserEvent;
use Sentinel;

class CalonController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {

    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */

    public function index()
    {

        return view('layouts.data_master.calon.index');
    }
    public function get_datatable()
    {
        $userEvents = UserEvent::all()->where('user_id', Sentinel::getUser()->id);
        foreach ($userEvents as $key => $userEvent) {
            $listEventId[$key] = $userEvent->event_id;
        }
        if(count($userEvents) != 0)
        {
            $dataDapil = Dapil::all()->whereIn('event_id', $listEventId);

            if(count($dataDapil) != 0){
                foreach ($dataDapil as $key => $dapil) {
                    $listDapiltId[$key] = $dapil->id;
                }
                $calon = Calon::whereIn('dapil_id', $listDapiltId);
            }
        }
        else
        {
            $calon = Calon::where('id', 0);
        }

        return Datatables::eloquent($calon)
        ->editColumn('partai', function ($calon) {
            return $calon->partai->nama ? $calon->partai->nama : 'Undefined';
        })
        ->editColumn('dapil', function ($calon) {
            return $calon->dapil->nama ? $calon->dapil->nama : 'Undefined';
        })
        ->addColumn('action', function ($calon) {
            return '<a href="'.route('datamaster.calon.show', $calon->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Lihat</a><a href="'.route('datamaster.calon.edit', $calon->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('datamaster.calon.delete', $calon->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Delete</a>';
        })

        ->make(true);
    }



    public function show($id)
    {
        $data['calon'] = Calon::findOrFail($id);
        if (empty($data['calon'])) {
            flash('Calon not found')->error();

            return redirect(route('datamaster.calon.index'));
        }

        return view('layouts.data_master.calon.show', $data);
    }

    public function create()
    {

        $userEvents = UserEvent::all()->where('user_id', Sentinel::getUser()->id);
        foreach ($userEvents as $key => $userEvent) {
            $listEventId[$key] = $userEvent->event_id;
        }
        if(count($userEvents) != 0)
        {
            $data['listEvent'] = Event::all()->whereIn('id', $listEventId);
        }
        else
        {
            $data['listEvent'] = Event::all()->where('tahun', 1945);
        }

        $data['dapil'] = [];


        $data['partai'] = Partai::pluck('nama','id')->all();

        return view('layouts.data_master.calon.create', $data);
    }

    public function store(Request $request)
    {

      $v = $this->validate($request,[
        'dapil_id' => 'required',
         // 'tingkat_id' => 'required',
         'partai_id' => 'required',
         'nomor' => 'required',
         'nama' => 'required',
          ]);


        if($request->tipe == "0"){
            $request->merge(['nama' => Partai::find($request->partai_id)->nama]);
        }

        $event = Event::where('id', $request->event)->first();
        if($event->jenis->id == 1 || $event->jenis->id == 5){
            $request->merge(['has_wakil' => 1]);
        }

        $input = $request->all();

        $calon = Calon::create($input);

        flash('Data Calon created successfully')->success();
        return redirect(route('datamaster.calon.show',$calon));
    }



    public function edit ($id)
    {
        $userEvents = UserEvent::all()->where('user_id', Sentinel::getUser()->id);
        foreach ($userEvents as $key => $userEvent) {
            $listEventId[$key] = $userEvent->event_id;
        }
        if(count($userEvents) != 0)
        {
            $data['listEvent'] = Event::all()->whereIn('id', $listEventId);
        }
        else
        {
            $data['listEvent'] = Event::all()->where('tahun', 1945);
        }

        $data['dapil'] = [];


        $data['partai'] = Partai::pluck('nama','id')->all();

        $data['calon'] = Calon::find($id);

        if (empty($data['calon'])) {
            flash('Data Calon Tidak Ada');

            return redirect(route('datamaster.calon.index'));
        }

        return view('layouts.data_master.calon.edit', $data);
    }



    public function update(Request $request,$id)
    {
        $calon = Calon::find($id);
        if (empty($calon)) {

            flash('Calon not found');

            return redirect(route('layouts.data_master.calon.index'));
        }

        $calon->nama            = $request->nama;
        $calon->alamat          = $request->alamat;
        $calon->no_telpon       = $request->no_telpon;
        $calon->email           = $request->email;
        $calon->event_id        = $request->event_id;
        $calon->list_dapil_id   = $request->list_dapil_id;
        $calon->foto            = $request->foto;

        $calon->update();


        flash('Data Calon saved successfully')->success();
        return redirect(route('datamaster.calon.show', $calon));

    }

    public function destroy($id)
    {

        $calon = Calon::findOrFail($id);
        if (empty($calon)) {

            flash('Calon not found');

            return redirect(route('layouts.data_master.calon.index'));
        }
        $calon->delete();

        flash('Data Calon deleted successfully')->success();
        return redirect(route('datamaster.calon.index'));
    }

    public function ajax(Request $request)
    {
        $type = $request->type;
        switch ($type) {
            case 'get-dapil':
            $result = Dapil::where('event_id',$request->event_id)->orderBy('nama', 'ASC')->get()->pluck( 'nama', 'id' )->all();
            if(count($result) > 0){
                return $result;
            } else {
                return $result['message'] = 'Belum ada Dapil di event yang dipilih!';
            }
            break;

            default:
            return $result['status'] = false;
            break;
        }


    }
}
