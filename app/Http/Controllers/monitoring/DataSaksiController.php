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
        $logged_user = Sentinel::getUser();
        $logged_user_role = $logged_user->role_user->role->slug;
        $users = Sentinel::findRoleBySlug('saksi')->users();
        switch ($logged_user_role) {
            case 'admin-pusat':
                $data_saksi = $users->with('roles');
                break;
            default:
                $data_saksi = $users->where('parent_id', $logged_user->id)->with('roles');
                break;
        }

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
        $v = $this->validate($request,[
          'phone' => 'required',
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
            $data_saksi = Sentinel::register($request->all());
        }
        else
        {
            $data_saksi = Sentinel::registerAndActivate($request->all());
        }

        $insertedId = $data_saksi->id;

        Sentinel::findRoleById(7)->users()->attach( $data_saksi );
        try
        {
            // insert to table user_event
            $data_saksi = new UserEvent;
            $data_saksi->user_id = $insertedId;
            $data_saksi->event_id = $request->event;

            $data_saksi->save();


            //insert to table saksi_tps
            $detail_saksi = new SaksiTps();
            
            $detail_saksi->user_id = $insertedId;
            $detail_saksi->tps_id = $request->tps_id;
            $detail_saksi->kelurahan_id = $request->kelurahan_id;
            $detail_saksi->alamat = $request->alamat;
            $detail_saksi->foto = $request->foto;

            // dd($detail_saksi);
            $detail_saksi->save();
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
        

        return redirect(route('monitoring.datasaksi.show', compact('insertedId')));
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

        $kelurahan = array();

        $tps = array();

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

        $saksi_tps = SaksiTps::where('user_id', $id)->first();

        return view('layouts.monitoring.data_saksi.edit', compact('provinsi', 'kota', 'kecamatan', 'kelurahan', 'tps', 'user', 'eventList', 'saksi_tps'));

    }
    public function update(Request $request,$id)
    {
        $data_saksi = User::findOrFail($id);
            if (empty($data_saksi)) {

                flash('Data Saksi not found');

            return redirect(route('monitoring.datasaksi'));
        }
            $data_saksi->update($request->all());
            // dd($request);
            try{
                $saksi_tps = SaksiTps::where('user_id', $id)->first();
                if (!$saksi_tps) {
                    $saksi_tps = new SaksiTps();
                    $saksi_tps->user_id = $id;
                }
                $saksi_tps->alamat = $request->alamat;
                $saksi_tps->foto = $request->foto;
                $saksi_tps->tps_id = $request->tps_id;
                $saksi_tps->kelurahan_id = $request->kelurahan_id;
                
                $saksi_tps->save();
                    
                }catch(\Exception $e){
                echo $e->getMessage(); 
            }
        
        flash('Data Saksi saved successfully')->success();
        return redirect(route('monitoring.datasaksi.show', $data_saksi));

    }

    public function show($id)
    {
        $data_saksi = User::findOrFail($id);
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
