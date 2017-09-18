<?php

namespace App\Http\Controllers\monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataPJTPSMonitoring;
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
        $data_korsak = Datasaksi_monitoring::select(['id','nama', 'alamat', 'no_telpon', 'email', 'password', 'list_id_tps', 'foto']);
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($data_korsak)

            // ->editColumn('provinsi_id', function ($tabulasi) {
            //     if ($tabulasi->provinsi) {
            //         return $tabulasi->provinsi->nama_provinsi;
            //     } else {
            //         return 'Data PROVINSI tidak ada';
            //     }              
            // })
            // ->editColumn('kota_kabupaten_id', function ($tabulasi) {
            //     if ($tabulasi->kota_kabupaten) {
            //         return $tabulasi->kota_kabupaten->nama;
            //     } else {
            //         return 'Data KOTA/KABUPATEN tidak ada';
            //     }
            // })
            // ->editColumn('kecamatan_id', function ($tabulasi) {
            //     if ($tabulasi->kecamatan) {
            //         return $tabulasi->kecamatan->nama;
            //     } else {
            //         return 'Data KECAMATAN tidak ada';
            //     }
            // })
            // ->editColumn('kelurahan_id', function ($tabulasi) {
            //     if ($tabulasi->kecamatan) {
            //         return $tabulasi->kelurahan->nama;
            //     } else {
            //         return 'Data KELURAHAN tidak ada';
            //     }
            // })
            ->addColumn('action', function ($data_korsak) {
            return '<a href="'.route('monitoring.datakorsak.show', $data_korsak->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Lihat</a><a href="'.route('monitoring.datakorsak.edit', $data_korsak->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('monitoring.datakorsak.delete', $data_korsak->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Delete</a>';
        })
            
            ->make(true);
    }

    public function store(Request $request) 
    { 
 		$input = $request->all();
 
        $data_korsak = DataPJTPSMonitoring::create($input); 
        
        flash('Data Korsak created successfully')->success(); 
        return redirect(route('monitoring.datapjs.show',$data_korsak)); 
    }

    public function edit($id)
    {
        $data_korsak = DataPJTPSMonitoring::find($id);

        if (empty($data_korsak)) {
            flash('Data Saksi Tidak Ada');

            return redirect(route('monitoring.datapjs'));
        }
        return view('layouts.monitoring.data_pj_tps.edit', compact('data_korsak'));

    }
    public function update(Request $request,$id) 
    { 
        $data_korsak = DataPJTPSMonitoring::find($id);
            if (empty($data_korsak)) {

                flash('Data Saksi not found');

            return redirect(route('monitoring.datapjs'));
        }
         
            $data_korsak->nama       = $request->nama;
            $data_korsak->alamat       = $request->alamat;
            $data_korsak->no_telpon    = $request->no_telpon;
            $data_korsak->email    = $request->email;
            $data_korsak->list_id_tps    = $request->list_id_tps;
            $data_korsak->foto    = $request->foto;
            
            $data_korsak->update();
       

        flash('Data Saksi saved successfully')->success();
        return redirect(route('monitoring.datapjs.show', $data_saksi)); 
         
    } 

    public function show($id) 
    {  
        $data_korsak = DataPJTPSMonitoring::find($id); 
        // dd($tabulasi);
 
        if (empty($data_korsak)) { 
            flash('Data Saksi not found')->error(); 
 
            return redirect(route('monitoring.datapjs')); 
        } 
 
        return view('layouts.monitoring.data_pj_tps.show',compact('data_korsak')); 
 
 
    } 

    public function destroy($id) 
    {

    	$data_korsak = DataPJTPSMonitoring::findOrFail($id);
            if (empty($data_korsak)) {

                    flash('Data Saksi not found');

                return redirect(route('monitoring.datapjs'));
            }
        $data_korsak->delete();

        flash('Data Saksi deleted successfully')->success();
        return redirect(route('monitoring.datapjs')); 
	}
}
