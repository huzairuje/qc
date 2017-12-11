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
use App\Provinsi;
use App\KotaKab;
use App\Kecamatan;
use App\Kelurahan;
use Charts;
use Flash;

class CalonController extends Controller
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

        return view('layouts.data_master.calon.index');

    }
    public function get_datatable()
    {
         // $tabulasi = Tabulasi::query();
        $tabulasi = Tabulasi::select(['id','dokumen_id', 'provinsi_id', 'kota_kabupaten_id', 'kecamatan_id', 'kelurahan_id']);
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($tabulasi)

            ->editColumn('provinsi_id', function ($tabulasi) {
                if ($tabulasi->provinsi) {
                    return $tabulasi->provinsi->nama_provinsi;
                } else {
                    return 'Data PROVINSI tidak ada';
                }
            })
            ->editColumn('kota_kabupaten_id', function ($tabulasi) {
                if ($tabulasi->kota_kabupaten) {
                    return $tabulasi->kota_kabupaten->nama;
                } else {
                    return 'Data KOTA/KABUPATEN tidak ada';
                }
            })
            ->editColumn('kecamatan_id', function ($tabulasi) {
                if ($tabulasi->kecamatan) {
                    return $tabulasi->kecamatan->nama;
                } else {
                    return 'Data KECAMATAN tidak ada';
                }
            })
            ->editColumn('kelurahan_id', function ($tabulasi) {
                if ($tabulasi->kecamatan) {
                    return $tabulasi->kelurahan->nama;
                } else {
                    return 'Data KELURAHAN tidak ada';
                }
            })
            ->addColumn('action', function ($tabulasi) {
            return '<a href="'.route('tabulasi.show', $tabulasi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Lihat</a><a href="'.route('tabulasi.edit', $tabulasi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('tabulasi.delete', $tabulasi->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Delete</a>';
        })

            ->make(true);
    }



    public function show($id)
    {
    	$chart = Charts::multi('bar', 'material')
            // Setup the chart settings
            ->title("Hasil Data Suara")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(700, 300) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
             ->colors(['#2196F3', '#F44336', '#FFC107'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Data Suara', [5,20,100])
            ->responsive(false)
            // Setup what the values mean
            ->labels(['Pasangan 1', 'Pasangan 2', 'Pasangan 3']);

        $tabulasi = Tabulasi::find($id);
        // dd($tabulasi);

        if (empty($tabulasi)) {
            flash('Tabulasi not found')->error();

            return redirect(route('tabulasi.index'));
        }

        return view('layouts.tabulasi.show',compact('tabulasi','chart'));


    }

    public function create()
    {


        $provinsi = Provinsi::pluck('nama_provinsi','id')->all();
        // dd($provinsi);

        $kota_kabupaten = array();
        // dd($kota_kabupaten);

        $kecamatan = array();

        $kelurahan = array();

        return view('layouts.tabulasi.create', compact('provinsi','kota_kabupaten','kecamatan','kelurahan'));
    }

    public function store(Request $request)
    {



        $input = $request->all();

        $tabulasi = Tabulasi::create($input);

        flash('Data Tabulasi created successfully')->success();
        return redirect(route('tabulasi.show',$tabulasi));
    }



    public function edit ($id)
    {
        // $tabulasi = $this->findWithoutFail($id);
        $tabulasi = Tabulasi::find($id);
        $provinsi = Provinsi::pluck('nama_provinsi','id')->all();
        $kota_kabupaten = KotaKab::where('provinsi_id', $tabulasi->provinsi_id)->pluck('nama','id')->all();
        $kecamatan = Kecamatan::where('kota_kabupaten_id', $tabulasi->kota_kabupaten_id)->pluck('nama','id')->all();
        $kelurahan = Kelurahan::where('kecamatan_id', $tabulasi->kecamatan_id)->pluck('nama','id')->all();
        // dd($kota_kabupaten);

        if (empty($tabulasi)) {
            flash('Data Tabulasi Tidak Ada');

            return redirect(route('tabulasi.index'));
        }

        return view('layouts.tabulasi.edit', compact('tabulasi','provinsi','kota_kabupaten','kecamatan','kelurahan'));
    }



    public function update(Request $request,$id)
    {
        $tabulasi = Tabulasi::find($id);
            if (empty($tabulasi)) {

                flash('Tabulasi not found');

            return redirect(route('layouts.tabulasi.index'));
        }

            $tabulasi->dokumen_id       = $request->dokumen_id;
            $tabulasi->provinsi_id       = $request->provinsi_id;
            $tabulasi->kota_kabupaten_id    = $request->kota_kabupaten_id;
            $tabulasi->kelurahan_id    = $request->kelurahan_id;

            $tabulasi->update();


        flash('Data Tabulasi saved successfully')->success();
        return redirect(route('tabulasi.show', $tabulasi));

    }

    public function destroy($id)
    {

    	$tabulasi = Tabulasi::findOrFail($id);
            if (empty($tabulasi)) {

                    flash('Tabulasi not found');

                return redirect(route('layouts.tabulasi.index'));
            }
        $tabulasi->delete();

        flash('Data Tabulasi deleted successfully')->success();
        return redirect(route('tabulasi.index'));
	}

    public function ajax(Request $request)
    {
        $type = $request->type;
        switch ($type) {
            case 'get-city':
                 return KotaKab::where('provinsi_id',$request->provinsi_id)->orderBy('nama', 'ASC')->get()->pluck( 'nama', 'id' )->all();

                return $result;
                break;

            case 'get-kecamatan':
                return Kecamatan::where('kota_kabupaten_id', $request->kota_kabupaten_id)->orderBy('nama', 'ASC')->get()->pluck('nama', 'id')->all();
                break;

            case 'get-kelurahan':
                return Kelurahan::where('kecamatan_id', $request->kecamatan_id)->orderBy('nama', 'ASC')->get()->pluck('nama', 'id')->all();
                break;

            default:
                return $result['status'] = false;
                break;
        }


    }
}
