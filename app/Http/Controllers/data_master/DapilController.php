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
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Charts;
use Flash;
use App\Models\Dapil;
use App\Models\DapilLokasi;
use App\Models\Event;
use App\Models\UserEvent;
use Sentinel;

class DapilController extends Controller
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

        return view('layouts.data_master.dapil.index');

    }
    public function get_datatable()
    {
        $userEvents = UserEvent::all()->where('user_id', Sentinel::getUser()->id);
        foreach ($userEvents as $key => $userEvent) {
            $listEventId[$key] = $userEvent->event_id;
            // dd($userEvent);
        }

        if(count($userEvents) != 0)
        {
            $dapil = Dapil::select(['id', 'nama', 'event_id'])->whereIn('event_id', $listEventId);
        }
        else
        {
            $dapil = Dapil::select(['id', 'nama', 'event_id'])->where('event_id', 0);
        }
        // dd($dapil);
        return Datatables::eloquent($dapil)
        ->addColumn('event', function ($dapil) {
            return $dapil->event->nama ? $dapil->event->nama : 'Undefined';
        })
        ->addColumn('action', function ($dapil) {
            return '<a href="'.route('datamaster.dapil.show', $dapil->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Lihat</a><a href="'.route('datamaster.dapil.edit', $dapil->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('datamaster.dapil.delete', $dapil->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Delete</a>';
        })
        ->make(true);
    }



    public function show($id)
    {
        $dapil = Dapil::find($id);
        // dd($tabulasi);

        if (empty($dapil)) {
            flash('Dapil not found')->error();

            return redirect(route('datamaster.dapil.index'));
        }

        return view('layouts.data_master.dapil.show',compact('dapil'));


    }

    public function create()
    {

        $event = Event::pluck('nama','id')->all();

        $provinsi = Provinsi::pluck('nama','id')->all();
        // dd($provinsi);

        $kota = array();
        // dd($kota_kabupaten);

        $kecamatan = array();

        $kelurahan = array();
        return view('layouts.data_master.dapil.create', compact('provinsi','kota','kecamatan','kelurahan','event'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $dapil = Dapil::create($input);

        $insertedId = $dapil->id;
        $data = $request->data;
        foreach($data as $key => $lokasi){
            $dapilLokasi[$key] = ['dapil_id' => $insertedId, 'lokasi_id' => $lokasi];
        }
        DapilLokasi::insert($dapilLokasi);

        flash('Data Calon created successfully')->success();
        return redirect(route('datamaster.dapil.show',$dapil));
    }



    public function edit ($id)
    {
        // $tabulasi = $this->findWithoutFail($id);
        $dapil = Dapil::find($id);
        // $event = Event::where('id', $dapil->event_id)->pluck('nama','id')->all();
        $event = Event::pluck('nama','id')->all();

        $currentDataList = DapilLokasi::all()->where('dapil_id', $id);
        if (count($currentDataList) != 0) {
            foreach ($currentDataList as $key => $currentData) {
                $currentDataList[$key] = $currentData->lokasi_id;
            }
        } else {
            $currentDataList = [];
        }


        if (empty($dapil)) {
            flash('Data Dapil Tidak Ada');

            return redirect(route('datamaster.dapil.index'));
        }

        return view('layouts.data_master.dapil.edit', compact('dapil','event', 'data', 'currentDataList'));
    }



    public function update(Request $request,$id)
    {
        $dapil = Dapil::find($id);
        $currentDapilList = DapilLokasi::all()->where('dapil_id', $id);
        if (count($currentDapilList) != 0) {
            foreach ($currentDapilList as $key => $currentData) {
                $currentDataList[$key] = $currentData->lokasi_id;
            }
        } else {
            $currentDataList = [];
        }

        if (empty($dapil)) {

            flash('Dapil not found');

            return redirect(route('layouts.data_master.dapil.index'));
        }

        $dapil->nama            = $request->nama;
        $dapil->event_id          = $request->event_id;

        $dapil->update();

        $data = $request->data;

        $deletes = array_diff($currentDataList, $data);
        $adds = array_diff($data, $currentDataList);
        if (count($deletes) != 0) {
            foreach ($deletes as $key => $delete) {
                DapilLokasi::find($delete)->delete();
            }
        }
        if (count($adds) != 0) {
            foreach($adds as $key => $lokasi){
                $dapilLokasi[$key] = ['dapil_id' => $id, 'lokasi_id' => $lokasi];
            }
            DapilLokasi::insert($dapilLokasi);
        }


        flash('Data Dapil saved successfully')->success();
        return redirect(route('datamaster.dapil.show', $dapil));

    }

    public function destroy($id)
    {

        $dapil = Dapil::findOrFail($id);
        if (empty($dapil)) {

            flash('Dapil not found');

            return redirect(route('layouts.data_master.dapil.index'));
        }
        $dapil->delete();

        flash('Data Dapil deleted successfully')->success();
        return redirect(route('datamaster.dapil.index'));
    }

    public function ajax(Request $request)
    {
        $type = $request->type;
        switch ($type) {
            case 'get-data':
            $event = Event::where('id', $request->event_id)->first();
            if($event->jenis_id == 5)
            {
                if($event->tingkat_id == 2){
                    $result = Provinsi::where('id',$event->lokasi)->orderBy('nama', 'ASC')->get()->pluck( 'nama', 'id' )->all();
                }
                else if($event->tingkat_id == 3){
                    $result = Kota::where('id',$event->lokasi)->orderBy('nama', 'ASC')->get()->pluck( 'nama', 'id' )->all();
                }
            }
            else if($event->jenis_id == 4)
            {
                if($event->tingkat_id == 2){
                    $result = Kota::where('provinsi_id',$event->lokasi)->orderBy('nama', 'ASC')->get()->pluck( 'nama', 'id' )->all();
                }
                else if($event->tingkat_id == 3){
                    $result = Kecamatan::where('kota_id',$event->lokasi)->orderBy('nama', 'ASC')->get()->pluck( 'nama', 'id' )->all();
                }
            }
            return $result;
            break;

            default:
            return $result['status'] = false;
            break;
        }
    }
}
