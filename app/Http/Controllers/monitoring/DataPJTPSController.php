<?php

namespace App\Http\Controllers\monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserEvent;
use App\Models\Event;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Tps;
use App\Models\SaksiTps;
use Sentinel;
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
use Flash;

class DataPJTPSController extends Controller
{
    public function index()
    {
        return view('layouts.monitoring.data_pj_tps.index');
    }

    public function create()
    {
        $provinsi = Provinsi::pluck('nama','id')->all();
        // dd($provinsi);

        $kota = array();
        // dd($kota_kabupaten);

        $kecamatan = array();

        $kelurahan = array();

        $tps = array();

        $role = Sentinel::getUser()->roles()->first()->slug;

        $userEvents = UserEvent::all()->where('user_id', Sentinel::getUser()->id);
        foreach ($userEvents as $key => $userEvent) {
            $listEventId[$key] = $userEvent->event_id;
        }
        if(count($userEvents) != 0)
        {
            $eventList = Event::all()->whereIn('id', $listEventId);
        }
        else
        {
            $eventList = Event::all()->where('id', 0);
        }
        // dd($data['eventList']);

        return view('layouts.monitoring.data_pj_tps.create', compact('eventList','provinsi','kota','kecamatan','kelurahan','tps'));
    }

    public function get_datatable()
    {
        // $tabulasi = Tabulasi::query();
        $datapjtps = Sentinel::findRoleById(6)->users()->with('roles');
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($datapjtps)
        ->addColumn('action', function ($datapjtps) {
            return '<a href="'.route('monitoring.datapjtps.show', $datapjtps->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i>Lihat</a><a href="'.route('monitoring.datapjtps.edit', $datapjtps->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('monitoring.datapjtps.delete', $datapjtps->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
        })
        ->make(true);
    }

    public function store(Request $request)
    {
        $v = $this->validate($request,[
          'no_telpon' => 'required',
           // 'tingkat_id' => 'required',
           'email' => 'required',
           'username' => 'required',
           'kelurahan_id' => 'required',
           'tps_id' => 'required'
           // 'lokasi' => 'required',
           // 'tahun' => 'required',
        ]);
        
        $phone_pass = $request->phone;

        // $request['password'] = substr($phone_pass, 6);

        $request->merge([
            'parent_id' => Sentinel::getUser()->id,
            'password' => substr($phone_pass, 6),
        ]);
        // dd($request->all());
        if($request->role == 'korsak' || $request->role == 'saksi')
        {
            $datapjtps = Sentinel::register($request->all());
        }
        else
        {
            $datapjtps = Sentinel::registerAndActivate($request->all());
        }

        $insertedId = $datapjtps->id;

        Sentinel::findRoleById(6)->users()->attach( $datapjtps );
        try
        {
            // insert to table user_event
            $datapjtps = new UserEvent;
            $datapjtps->user_id = $insertedId;
            $datapjtps->event_id = $request->event;

            $datapjtps->save();


            //insert to table saksi_tps
            $datapjtps = new SaksiTps();
            
            $datapjtps->user_id = $insertedId;
            $datapjtps->tps_id = $request->tps_id;
            $datapjtps->kelurahan_id = $request->kelurahan_id;
            $datapjtps->alamat = $request->alamat;
            $datapjtps->foto = $request->foto;

            // dd($datapjtps);
            $datapjtps->save();
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }

        return redirect(route('monitoring.datapjtps.show', $insertedId));
    }


    public function edit($id)
    {
        $data['user'] = User::where('id' , '=', $id)->first();

        $userEvents = UserEvent::all()->where('user_id', Sentinel::getUser()->id);
        foreach ($userEvents as $key => $userEvent) {
            $listEventId[$key] = $userEvent->event_id;
        }
        if(count($userEvents) != 0)
        {
            $data['eventList'] = Event::all()->whereIn('id', $listEventId);
        }
        else
        {
            $data['eventList'] = Event::all()->where('id', 0);
        }

        return view('layouts.monitoring.data_pj_tps.edit', $data);

    }
    public function update(Request $request,$id)
    {
        $data = User::find($id);

        if (empty($data)) {

            flash('User not found');

            return redirect(route('monitoring.datapjtps.index'));
        }

        $data->update($request->all());


        flash('Data Saksi saved successfully')->success();
        return redirect(route('monitoring.datapjtps.show', $data));

    }

    public function show($id)
    {
        $datapjtps = User::find($id);
        // dd($tabulasi);

        if (empty($datapjtps)) {
            flash('Data Saksi not found')->error();

            return redirect(route('monitoring.datapjtps'));
        }

        return view('layouts.monitoring.data_pj_tps.show',compact('datapjtps'));


    }

    public function destroy($id)
    {

        $datapjtps = DataPJTPSMonitoring::findOrFail($id);
        if (empty($datapjtps)) {

            flash('Data Saksi not found');

            return redirect(route('monitoring.datapjtps'));
        }
        $datapjtps->delete();

        flash('Data Saksi deleted successfully')->success();
        return redirect(route('monitoring.datapjtps'));
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
          $result = Kecamatan::where('kota_id', $request->kota_id)->orderBy('nama', 'ASC')->get()->pluck('nama', 'id')->all();
          return $result;
          break;

          case 'get-kelurahan':
          $result = Kelurahan::where('kecamatan_id', $request->kecamatan_id)->orderBy('nama', 'ASC')->get()->pluck('nama', 'id')->all();
          return $result;
          break;

          case 'get-tps':
          $result = Tps::where('kelurahan_id', $request->kelurahan_id)->orderBy('nomor', 'ASC')->get()->pluck('nomor', 'id')->all();
          return $result;
          break;

          default:
          return $result['status'] = false;
          break;
        }
    }
}
