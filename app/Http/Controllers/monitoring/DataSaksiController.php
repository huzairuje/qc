<?php

namespace App\Http\Controllers\monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserEvent;
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
    	return view('layouts.monitoring.data_saksi.create');
    }

    public function get_datatable()
    {
         // $tabulasi = Tabulasi::query();
        $data_saksi = User::where('parent_id', 7);
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
            return '<a href="'.route('monitoring.datasaksi.show', $data_saksi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Lihat</a><a href="'.route('monitoring.datasaksi.edit', $data_saksi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('monitoring.datasaksi.delete', $data_saksi->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Delete</a>';
        })

            ->make(true);
    }

    public function store(Request $request)
    {
 		$input = $request->all();
        $data_saksi = User::create($input);

        flash('Data Saksi created successfully')->success();
        return redirect(route('monitoring.datasaksi.show',$data_saksi));
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

}
