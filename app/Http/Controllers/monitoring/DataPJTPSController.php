<?php

namespace App\Http\Controllers\monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
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
    	return view('layouts.monitoring.data_pj_tps.create');
    }

    public function get_datatable()
    {
         // $tabulasi = Tabulasi::query();
        $datapjtps = User::where('parent_id', 6);
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
 		$input = $request->all();

        $datapjtps = DataPJTPSMonitoring::create($input);

        flash('Data Korsak created successfully')->success();
        return redirect(route('monitoring.datapjtps.show',$datapjtps));
    }

    public function edit($id)
    {
        $datapjtps = DataPJTPSMonitoring::find($id);

        if (empty($datapjtps)) {
            flash('Data Saksi Tidak Ada');

            return redirect(route('monitoring.datapjtps'));
        }
        return view('layouts.monitoring.data_pj_tps.edit', compact('datapjtps'));

    }
    public function update(Request $request,$id)
    {
        $datapjtps = DataPJTPSMonitoring::find($id);
            if (empty($datapjtps)) {

                flash('Data Saksi not found');

            return redirect(route('monitoring.datapjtps'));
        }

            $datapjtps->nama       = $request->nama;
            $datapjtps->alamat       = $request->alamat;
            $datapjtps->no_telpon    = $request->no_telpon;
            $datapjtps->email    = $request->email;
            $datapjtps->list_id_tps    = $request->list_id_tps;
            $datapjtps->foto    = $request->foto;

            $datapjtps->update();


        flash('Data Saksi saved successfully')->success();
        return redirect(route('monitoring.datapjtps.show', $datapjtps));

    }

    public function show($id)
    {
        $datapjtps = DataPJTPSMonitoring::find($id);
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
