<?php

namespace App\Http\Controllers\monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserEvent;
use App\Models\Event;
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
        $role = Sentinel::getUser()->roles()->first()->slug;

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

        return view('layouts.monitoring.data_pj_tps.create', $data);
    }

    public function get_datatable()
    {
        // $tabulasi = Tabulasi::query();
        $datapjtps = Sentinel::findRoleById(6)->users()->with('roles');
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($datapjtps)
        ->addColumn('action', function ($datapjtps) {
            return '<a href="'.route('monitoring.datapjtps.show', $datapjtps->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Lihat</a><a href="'.route('monitoring.datapjtps.edit', $datapjtps->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('monitoring.datapjtps.delete', $datapjtps->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Delete</a>';
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

        Sentinel::findRoleById(6)->users()->attach( $user );
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
}
