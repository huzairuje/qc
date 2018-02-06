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
use App\Models\AdminProvinsi;
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

class DataAdminProvinsiController extends Controller
{
    public function index()
    {
        return view('layouts.monitoring.data_admin_provinsi.index');
    }

    public function create()
    {
        $provinsi = Provinsi::pluck('nama','id')->all();
        // dd($provinsi);

        // $kota = array();
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

    	return view('layouts.monitoring.data_admin_provinsi.create', compact('eventList','provinsi'));
    }

    public function get_datatable()
    {
         // $tabulasi = Tabulasi::query();
        $data_provinsi = Sentinel::findRoleById(3)->users()->with('roles');
        // $restaurants = restaurants::where('res_id', 1);
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($data_provinsi)

            ->editColumn('username', function ($data_provinsi) {
                if (['username'] == 'provinsi') {
                    return 'Admin Provinsi';
                } else {
                    return 'Data tidak ada';
                }
            })

            ->addColumn('action', function ($data_provinsi) {
            return '<a href="'.route('monitoring.dataadminprovinsi.show', $data_provinsi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i>Lihat</a><a href="'.route('monitoring.dataadminprovinsi.edit', $data_provinsi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('monitoring.dataadminprovinsi.delete', $data_provinsi->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
        })

            ->make(true);
    }

    public function store(Request $request)
    {
        $request->merge([
            'password' => '12345678',
            'parent_id' => Sentinel::getUser()->id,
        ]);
        // dd($request->all());
        if($request->role == 'admin-provinsi')
        {
            $data_provinsi = Sentinel::register($request->all());
        }
        else
        {
            $data_provinsi = Sentinel::registerAndActivate($request->all());
        }

        $insertedId = $data_provinsi->id;

        Sentinel::findRoleById(3)->users()->attach( $data_provinsi );
        try
        {
            // insert to table user_event
            $data_provinsi = new UserEvent;
            $data_provinsi->user_id = $insertedId;
            $data_provinsi->event_id = $request->event;

            $data_provinsi->save();


            //insert to table admin_kecamatan
            $data_provinsi = new AdminProvinsi();
            
            $data_provinsi->user_id = $insertedId;
            $data_provinsi->provinsi_id = $request->provinsi_id;
            $data_provinsi->alamat = $request->alamat;
            $data_provinsi->foto = $request->foto;
            // $data_provinsi->tps_id = $request->tps_id;

            // dd($data_saksi);
            $data_provinsi->save();
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
        

        return redirect(route('monitoring.dataadminprovinsi.show', compact('insertedId')));
    }

    public function edit($id)
    {
        $data_provinsi = User::find($id);

        if (empty($data_provinsi)) {
            flash('Data Tidak Ada');

            return redirect(route('monitoring.dataadminprovinsi'));
        }
        return view('layouts.monitoring.data_admin_provinsi.edit', compact('data_provinsi'));

    }
    public function update(Request $request,$id)
    {
        $data_provinsi = User::find($id);
            if (empty($data_provinsi)) {

                flash('Data not found');

            return redirect(route('monitoring.dataadminprovinsi'));
        }

            $data_provinsi->nama       = $request->nama;
            $data_provinsi->alamat       = $request->alamat;
            $data_provinsi->no_telpon    = $request->no_telpon;
            $data_provinsi->email    = $request->email;
            // $data_kecamatan->id_tps    = $request->id_tps;
            $data_provinsi->foto    = $request->foto;

            $data_provinsi->update();


        flash('Data saved successfully')->success();
        return redirect(route('monitoring.dataadminprovinsi.show', $data_provinsi));

    }

    public function show($id)
    {
        $data_provinsi = User::find($id);
        // dd($tabulasi);

        if (empty($data_provinsi)) {
            flash('Data not found')->error();

            return redirect(route('monitoring.dataadminprovinsi'));
        }

        return view('layouts.monitoring.data_admin_provinsi.show',compact('data_provinsi'));


    }

    public function destroy($id)
    {

    	$data_provinsi = User::findOrFail($id);
            if (empty($data_provinsi)) {

                    flash('Data not found');

                return redirect(route('monitoring.dataadminprovinsi'));
            }
        $data_provinsi->delete();

        flash('Data deleted successfully')->success();
        return redirect(route('monitoring.dataadminprovinsi'));
	}

    public function ajax(Request $request)
    {      
      $type = $request->type;
      switch ($type) {
          case 'get-provincy':
          $result = Provinsi::get()->pluck( 'nama', 'id' )->all();
          return $result;
          break;

          default:
          return $result['status'] = false;
          break;
        }
    }
}
