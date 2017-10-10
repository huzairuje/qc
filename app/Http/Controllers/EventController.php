<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Datasaksi_monitoring;
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

class EventController extends Controller
{
    public function index()
    {
        return view('layouts.monitoring.data_saksi.index');
    }

    public function create()
    {
    	return view('layouts.monitoring.data_saksi.create');
    }

    public function get_datatable()
    {
         // $tabulasi = Tabulasi::query();
        $data_saksi = Datasaksi_monitoring::select(['id','nama', 'alamat', 'no_telpon', 'email', 'password', 'id_tps', 'foto']);
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($data_saksi)

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
            ->addColumn('action', function ($data_saksi) {
            return '<a href="'.route('monitoring.datasaksi.show', $data_saksi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Lihat</a><a href="'.route('monitoring.datasaksi.edit', $data_saksi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('monitoring.datasaksi.delete', $data_saksi->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Delete</a>';
        })
            
            ->make(true);
    }

    public function store(Request $request) 
    { 
 		$input = $request->all();
        $data_saksi = Datasaksi_monitoring::create($input); 
        
        flash('Data Saksi created successfully')->success(); 
        return redirect(route('monitoring.datasaksi.show',$data_saksi)); 
    }

    public function edit($id)
    {
        $data_saksi = Datasaksi_monitoring::find($id);

        if (empty($data_saksi)) {
            flash('Data Saksi Tidak Ada');

            return redirect(route('monitoring.datasaksi'));
        }
        return view('layouts.monitoring.data_saksi.edit', compact('data_saksi'));

    }
    public function update(Request $request,$id) 
    { 
        $data_saksi = Datasaksi_monitoring::find($id);
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
        $data_saksi = Datasaksi_monitoring::find($id); 
        // dd($tabulasi);
 
        if (empty($data_saksi)) { 
            flash('Data Saksi not found')->error(); 
 
            return redirect(route('monitoring.datasaksi')); 
        } 
 
        return view('layouts.monitoring.data_saksi.show',compact('data_saksi')); 
 
 
    } 

    public function destroy($id) 
    {

    	$data_saksi = Datasaksi_monitoring::findOrFail($id);
            if (empty($data_saksi)) {

                    flash('Data Saksi not found');

                return redirect(route('monitoring.datasaksi'));
            }
        $data_saksi->delete();

        flash('Data Saksi deleted successfully')->success();
        return redirect(route('monitoring.datasaksi')); 
	}
}
