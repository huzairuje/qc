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
use App\Models\AdminKota;
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

class DataAdminKotaController extends Controller
{
    public function index()
    {
        return view('layouts.monitoring.data_admin_kota.index');
    }

    public function create()
    {
        $provinsi = Provinsi::pluck('nama','id')->all();
        // dd($provinsi);

        $kota = array();
        // dd($kota_kabupaten);

        // $kecamatan = array();

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

    	return view('layouts.monitoring.data_admin_kota.create', compact('eventList','provinsi','kota'));
    }

    public function get_datatable()
    {
         // $tabulasi = Tabulasi::query();
        $data_kota = Sentinel::findRoleById(4)->users()->with('roles');
        // $restaurants = restaurants::where('res_id', 1);
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($data_kota)

            ->editColumn('username', function ($data_kota) {
                if (['username'] == 'kota') {
                    return 'Admin Kota';
                } else {
                    return 'Data tidak ada';
                }
            })

            ->addColumn('action', function ($data_kota) {
            return '<a href="'.route('monitoring.dataadminkota.show', $data_kota->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i>Lihat</a><a href="'.route('monitoring.dataadminkota.edit', $data_kota->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('monitoring.dataadminkota.delete', $data_kota->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
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
           'kota_id' => 'required',
           // 'tps_id' => 'required'
           // 'lokasi' => 'required',
           // 'tahun' => 'required',
        ]);
        $request->merge([
            'password' => '12345678',
            'parent_id' => Sentinel::getUser()->id,
        ]);
        // dd($request->all());
        if($request->role == 'admin-kota')
        {
            $data_kota = Sentinel::register($request->all());
        }
        else
        {
            $data_kota = Sentinel::registerAndActivate($request->all());
        }

        $insertedId = $data_kota->id;

        Sentinel::findRoleById(4)->users()->attach( $data_kota );
        try
        {
            // insert to table user_event
            $data_kota = new UserEvent;
            $data_kota->user_id = $insertedId;
            $data_kota->event_id = $request->event;

            $data_kota->save();


            //insert to table admin_kecamatan
            $detail_kota = new AdminKota();
            
            $detail_kota->user_id = $insertedId;
            $detail_kota->kota_id = $request->kota_id;
            $detail_kota->alamat = $request->alamat;
            $detail_kota->foto = $request->foto;
            // $detail_kota->tps_id = $request->tps_id;

            // dd($data_saksi);
            $detail_kota->save();
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
        

        return redirect(route('monitoring.dataadminkota.show', compact('insertedId')));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        if (empty($user)) {
            flash('Data Admin Kota not found')->error();

            return redirect(route('monitoring.dataadminkota'));
        }



        $data_kota = AdminKota::where('user_id', $id)->first();

        $provinsi  = Provinsi::pluck('nama','id')->all();
        // dd($provinsi);

        $kota = array();

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


        return view('layouts.monitoring.data_admin_kota.edit', compact('provinsi', 'kota', 'user', 'eventList', 'data_kota'));
    }
    public function update(Request $request,$id)
    {
        $data_kota = User::findOrFail($id);
            if (empty($data_kota)) {

                flash('Data not found');

            return redirect(route('monitoring.dataadminkota'));
        }
            $data_kota->update($request->all());
            // dd($request);
            try{
                $detail_kota = AdminKota::where('user_id', $id)->first();
                $detail_kota->alamat = $request->alamat;
                $detail_kota->foto = $request->foto;
                $detail_kota->kota_id = $request->kota_id;
                
                $detail_kota->update();

                    
                }catch(\Exception $e){
                echo $e->getMessage(); 
            }
        
        flash('Data Saksi saved successfully')->success();
        return redirect(route('monitoring.dataadminkota.show', compact('data_kota')));

    }

    public function show($id)
    {
        $data_kota = User::find($id);
        // dd($tabulasi);

        if (empty($data_kota)) {
            flash('Data not found')->error();

            return redirect(route('monitoring.dataadminkota'));
        }

        return view('layouts.monitoring.data_admin_kota.show',compact('data_kota'));


    }

    public function destroy($id)
    {

    	$data_kota = User::findOrFail($id);
            if (empty($data_kota)) {

                    flash('Data not found');

                return redirect(route('monitoring.dataadminkota'));
            }
        $data_kota->delete();

        flash('Data deleted successfully')->success();
        return redirect(route('monitoring.dataadminkota'));
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

          default:
          return $result['status'] = false;
          break;
        }
    }
}

