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


class DataSaksiController extends Controller
{
    public function index()
    {
        return view('layouts.monitoring.data_saksi.index');
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

    	return view('layouts.monitoring.data_saksi.create', compact('eventList','provinsi','kota','kecamatan','kelurahan','tps'));
    }

    public function get_datatable()
    {
         // $tabulasi = Tabulasi::query();
        $data_saksi = Sentinel::findRoleById(7)->users()->with('roles');
        // $restaurants = restaurants::where('res_id', 1);
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($data_saksi)

            ->editColumn('username', function ($data_saksi) {
                if (['username'] == 'saksi') {
                    return 'Saksi';
                } else {
                    return 'Data SAKSI tidak ada';
                }
            })

            ->addColumn('action', function ($data_saksi) {
            return '<a href="'.route('monitoring.datasaksi.show', $data_saksi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i>Lihat</a><a href="'.route('monitoring.datasaksi.edit', $data_saksi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('monitoring.datasaksi.delete', $data_saksi->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
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
        if($request->role == 'korsak' || $request->role == 'saksi')
        {
            $user = Sentinel::register($request->all());
        }
        else
        {
            $user = Sentinel::registerAndActivate($request->all());
        }

        $insertedId = $user->id;

        Sentinel::findRoleById(7)->users()->attach( $user );
        try
        {
            $user = new UserEvent;
            $user->user_id = $insertedId;
            $user->event_id = $request->event;
            $user->save();
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }

        return redirect(route('monitoring.datasaksi.show', $insertedId));
    }

    public function edit($id)
    {
        $data_saksi = User::find($id);

        if (empty($data_saksi)) {
            flash('Data Saksi Tidak Ada');

            return redirect(route('monitoring.datasaksi'));
        }
        return view('layouts.monitoring.data_saksi.edit', compact('data_saksi'));

    }
    public function update(Request $request,$id)
    {
        $data_saksi = User::find($id);
            if (empty($data_saksi)) {

                flash('Data Saksi not found');

            return redirect(route('monitoring.datasaksi'));
        }

            $data_saksi->nama       = $request->nama;
            $data_saksi->alamat       = $request->alamat;
            $data_saksi->no_telpon    = $request->no_telpon;
            $data_saksi->email    = $request->email;
            $data_saksi->id_tps    = $request->id_tps;
            $data_saksi->foto    = $request->foto;

            $data_saksi->update();


        flash('Data Saksi saved successfully')->success();
        return redirect(route('monitoring.datasaksi.show', $data_saksi));

    }

    public function show($id)
    {
        $data_saksi = User::find($id);
        // dd($tabulasi);

        if (empty($data_saksi)) {
            flash('Data Saksi not found')->error();

            return redirect(route('monitoring.datasaksi'));
        }

        return view('layouts.monitoring.data_saksi.show',compact('data_saksi'));


    }

    public function destroy($id)
    {

    	$data_saksi = User::findOrFail($id);
            if (empty($data_saksi)) {

                    flash('Data Saksi not found');

                return redirect(route('monitoring.datasaksi'));
            }
        $data_saksi->delete();

        flash('Data Saksi deleted successfully')->success();
        return redirect(route('monitoring.datasaksi'));
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
