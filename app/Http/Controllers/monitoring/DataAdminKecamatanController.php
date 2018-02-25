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
use App\Models\AdminKecamatan;
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

class DataAdminKecamatanController extends Controller
{
    public function index()
    {
        return view('layouts.monitoring.data_admin_kecamatan.index');
    }

    public function create()
    {
        $provinsi = Provinsi::pluck('nama','id')->all();
        // dd($provinsi);

        $kota = array();
        // dd($kota_kabupaten);

        $kecamatan = array();

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

    	return view('layouts.monitoring.data_admin_kecamatan.create', compact('eventList','provinsi','kota','kecamatan'));
    }

    public function get_datatable()
    {
        $logged_user = Sentinel::getUser();
        $logged_user_role = $logged_user->role_user->role->slug;
        $users = Sentinel::findRoleBySlug('admin-kecamatan')->users();
        switch ($logged_user_role) {
            case 'admin-pusat':
                $data_kecamatan = $users->with('roles');
                break;
            default:
                $data_kecamatan = $users->where('parent_id', $logged_user->id)->with('roles');
                break;
        }

        return Datatables::eloquent($data_kecamatan)

            ->editColumn('username', function ($data_kecamatan) {
                if (['username'] == 'kecamatan') {
                    return 'Admin Kecamatan';
                } else {
                    return 'Data tidak ada';
                }
            })

            ->addColumn('action', function ($data_kecamatan) {
            return '<a href="'.route('monitoring.dataadminkecamatan.show', $data_kecamatan->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i>Lihat</a><a href="'.route('monitoring.dataadminkecamatan.edit', $data_kecamatan->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('monitoring.dataadminkecamatan.delete', $data_kecamatan->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
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
       'kecamatan_id' => 'required'
       // 'lokasi' => 'required',
       // 'tahun' => 'required',
        ]);

        $request->merge([
            'password' => '12345678',
            'parent_id' => Sentinel::getUser()->id,
        ]);
        // dd($request->all());
        if($request->role == 'admin-kecamatan')
        {
            $data_kecamatan = Sentinel::register($request->all());
        }
        else
        {
            $data_kecamatan = Sentinel::registerAndActivate($request->all());
        }

        $insertedId = $data_kecamatan->id;

        Sentinel::findRoleById(5)->users()->attach( $data_kecamatan );
        try
        {
            // insert to table user_event
            $data_kecamatan = new UserEvent;
            $data_kecamatan->user_id = $insertedId;
            $data_kecamatan->event_id = $request->event;

            $data_kecamatan->save();


            //insert to table admin_kecamatan
            $detail_kecamatan = new AdminKecamatan();
            
            $detail_kecamatan->user_id = $insertedId;
            $detail_kecamatan->kecamatan_id = $request->kecamatan_id;
            $detail_kecamatan->alamat = $request->alamat;
            $detail_kecamatan->foto = $request->foto;
            // $detail_kecamatan->tps_id = $request->tps_id;

            // dd($data_saksi);
            $detail_kecamatan->save();
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
        

        return redirect(route('monitoring.dataadminkecamatan.show', compact('insertedId')));
    }

    public function edit($id)
    {

        $user = User::findOrFail($id);

        if (empty($user)) {
            flash('Data Saksi not found')->error();

            return redirect(route('monitoring.datasaksi'));
        }

        $provinsi  = Provinsi::pluck('nama','id')->all();
        // dd($provinsi);

        $kota = array();
        // dd($kota_kabupaten);

        $kecamatan = array();

        // $user = User::where('id' , '=', $id)->first();

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

        $data_kecamatan = AdminKecamatan::where('user_id', $id)->first();

        return view('layouts.monitoring.data_admin_kecamatan.edit', compact('provinsi', 'kota', 'kecamatan', 'user', 'eventList', 'data_kecamatan'));

    }
    public function update(Request $request,$id)
    {
        $data_kecamatan = User::findOrFail($id);
            if (empty($data_kecamatan)) {

                flash('Data Saksi not found');

            return redirect(route('monitoring.dataadminkecamatan'));
        }
            $data_kecamatan->update($request->all());
            // dd($request);
            try{
                $detail_kecamatan = AdminKecamatan::where('user_id', $id)->first();
                $detail_kecamatan->alamat = $request->alamat;
                $detail_kecamatan->foto = $request->foto;
                $detail_kecamatan->kecamatan_id = $request->kecamatan_id;
                
                $detail_kecamatan->update();

                    
                }catch(\Exception $e){
                echo $e->getMessage(); 
            }
        
        flash('Data Saksi saved successfully')->success();
        return redirect(route('monitoring.dataadminkecamatan.show', compact('data_kecamatan')));
    }

    public function show($id)
    {
        $data_kecamatan = User::find($id);
        // dd($tabulasi);

        if (empty($data_kecamatan)) {
            flash('Data Saksi not found')->error();

            return redirect(route('monitoring.dataadminkecamatan'));
        }

        return view('layouts.monitoring.data_admin_kecamatan.show',compact('data_kecamatan'));


    }

    public function destroy($id)
    {

    	$data_kecamatan = User::findOrFail($id);
            if (empty($data_kecamatan)) {

                    flash('Data not found');

                return redirect(route('monitoring.dataadminkecamatan'));
            }
        $data_kecamatan->delete();

        flash('Data deleted successfully')->success();
        return redirect(route('monitoring.dataadminkecamatan'));
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

          default:
          return $result['status'] = false;
          break;
        }
    }
}
