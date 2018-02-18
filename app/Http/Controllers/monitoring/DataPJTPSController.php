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
use App\Models\KorsakTps;
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
        $data_korsak = Sentinel::findRoleById(6)->users()->with('roles');
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($data_korsak)
        ->addColumn('action', function ($data_korsak) {
            return '<a href="'.route('monitoring.datapjtps.show', $data_korsak->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i>Lihat</a><a href="'.route('monitoring.datapjtps.edit', $data_korsak->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('monitoring.datapjtps.delete', $data_korsak->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
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
            $data_korsak = Sentinel::register($request->all());
        }
        else
        {
            $data_korsak = Sentinel::registerAndActivate($request->all());
        }

        $insertedId = $data_korsak->id;

        Sentinel::findRoleById(6)->users()->attach( $data_korsak );
        try
        {
            // insert to table user_event
            $data_korsak = new UserEvent;
            $data_korsak->user_id = $insertedId;
            $data_korsak->event_id = $request->event;

            $data_korsak->save();


            //insert to table saksi_tps
            $detail_korsak = new KorsakTps();
            
            $detail_korsak->user_id = $insertedId;
            $detail_korsak->tps_id = $request->tps_id;
            $detail_korsak->kelurahan_id = $request->kelurahan_id;
            $detail_korsak->alamat = $request->alamat;
            $detail_korsak->foto = $request->foto;

            // dd($datapjtps);
            $detail_korsak->save();
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }

        return redirect(route('monitoring.datapjtps.show', compact('insertedId')));
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        // $data['user'] = User::where('id' , '=', $id)->first();
        if (empty($user)) {

            flash('Data Saksi not found')->error();
            return redirect(route('monitoring.datapjtps.index'));

        }

        $provinsi  = Provinsi::pluck('nama','id')->all();
        // dd($provinsi);

        $kota = array();
        // dd($kota_kabupaten);

        $kecamatan = array();

        $kelurahan = array();

        $tps = array();

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

        $korsak_tps = KorsakTps::where('user_id', $id)->first();


        return view('layouts.monitoring.data_pj_tps.edit', compact('user', 'eventList' , 'korsak_tps', 'provinsi', 'kota', 'kecamatan', 'kelurahan', 'tps'));

    }
    public function update(Request $request,$id)
    {
        $data_korsak = User::find($id);

        if (empty($data_korsak)) {

            flash('User not found');

            return redirect(route('monitoring.datapjtps.index'));
        }

        $data_korsak->update($request->all());
            // dd($request);
            try{
                $korsak_tps = KorsakTps::where('user_id', $id)->first();
                $korsak_tps->alamat = $request->alamat;
                $korsak_tps->foto = $request->foto;
                $korsak_tps->tps_id = $request->tps_id;
                $korsak_tps->kelurahan_id = $request->kelurahan_id;
                
                $korsak_tps->update();

                    
                }catch(\Exception $e){
                echo $e->getMessage(); 
            }


        flash('Data Saksi saved successfully')->success();
        return redirect(route('monitoring.datapjtps.show', compact('data_korsak', 'korsak_tps')));

    }

    public function show($id)
    {
        $data_korsak = User::find($id);
        // dd($tabulasi);

        if (empty($data_korsak)) {
            flash('Data Saksi not found')->error();

            return redirect(route('monitoring.datapjtps'));
        }

        return view('layouts.monitoring.data_pj_tps.show',compact('data_korsak'));


    }

    public function destroy($id)
    {

        $data_korsak = DataPJTPSMonitoring::findOrFail($id);
        if (empty($data_korsak)) {

            flash('Data Saksi not found');

            return redirect(route('monitoring.datapjtps'));
        }
        $data_korsak->delete();

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
