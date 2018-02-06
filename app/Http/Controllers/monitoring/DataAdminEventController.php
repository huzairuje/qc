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
use App\Models\AdminEvent;
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

class DataAdminEventController extends Controller
{
    public function index()
    {
        return view('layouts.monitoring.data_admin_event.index');
    }

    public function create()
    {
        $event = Event::pluck('nama','id')->all();
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

    	return view('layouts.monitoring.data_admin_event.create', compact('eventList','event'));
    }

    public function get_datatable()
    {
         // $tabulasi = Tabulasi::query();
        $data_event = Sentinel::findRoleById(2)->users()->with('roles');
        // $restaurants = restaurants::where('res_id', 1);
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($data_event)

            ->editColumn('username', function ($data_event) {
                if (['username'] == 'event') {
                    return 'Admin Event';
                } else {
                    return 'Data tidak ada';
                }
            })

            ->addColumn('action', function ($data_event) {
            return '<a href="'.route('monitoring.dataadminprovinsi.show', $data_event->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i>Lihat</a><a href="'.route('monitoring.dataadminprovinsi.edit', $data_event->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('monitoring.dataadminprovinsi.delete', $data_event->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
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
        if($request->role == 'admin-event')
        {
            $data_event = Sentinel::register($request->all());
        }
        else
        {
            $data_event = Sentinel::registerAndActivate($request->all());
        }

        $insertedId = $data_event->id;

        Sentinel::findRoleById(2)->users()->attach( $data_event );
        try
        {
            // insert to table user_event
            $data_event = new UserEvent;
            $data_event->user_id = $insertedId;
            $data_event->event_id = $request->event;

            $data_event->save();


            //insert to table admin_kecamatan
            $data_event = new AdminEvent();
            
            $data_event->user_id = $insertedId;
            $data_event->alamat = $request->alamat;
            $data_event->foto = $request->foto;
            // $data_event->provinsi_id = $request->provinsi_id;
            // $data_event->tps_id = $request->tps_id;

            // dd($data_saksi);
            $data_event->save();
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
        

        return redirect(route('monitoring.dataadminevent.show', compact('insertedId')));
    }

    public function edit($id)
    {
        $data_event = User::find($id);

        if (empty($data_event)) {
            flash('Data Tidak Ada');

            return redirect(route('monitoring.dataadminevent'));
        }
        return view('layouts.monitoring.data_admin_event.edit', compact('data_event'));

    }
    public function update(Request $request,$id)
    {
        $data_event = User::find($id);
            if (empty($data_event)) {

                flash('Data not found');

            return redirect(route('monitoring.dataadminevent'));
        }

            $data_event->nama       = $request->nama;
            $data_event->alamat       = $request->alamat;
            $data_event->no_telpon    = $request->no_telpon;
            $data_event->email    = $request->email;
            // $data_kecamatan->id_tps    = $request->id_tps;
            $data_event->foto    = $request->foto;

            $data_event->update();


        flash('Data saved successfully')->success();
        return redirect(route('monitoring.dataadminevent.show', $data_event));

    }

    public function show($id)
    {
        $data_event = User::find($id);
        // dd($tabulasi);

        if (empty($data_event)) {
            flash('Data not found')->error();

            return redirect(route('monitoring.dataadminevent'));
        }

        return view('layouts.monitoring.data_admin_event.show',compact('data_event'));


    }

    public function destroy($id)
    {

    	$data_event = User::findOrFail($id);
            if (empty($data_event)) {

                    flash('Data not found');

                return redirect(route('monitoring.dataadminevent'));
            }
        $data_event->delete();

        flash('Data deleted successfully')->success();
        return redirect(route('monitoring.dataadminevent'));
	}

    public function ajax(Request $request)
    {      
      $type = $request->type;
      switch ($type) {
          case 'get-event':
          $result = Event::get()->pluck( 'nama', 'id' )->all();
          return $result;
          break;

          default:
          return $result['status'] = false;
          break;
        }
    }
}
