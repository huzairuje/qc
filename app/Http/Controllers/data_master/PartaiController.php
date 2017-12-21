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
use App\Models\Partai;
use Charts;
use Flash;
class PartaiController extends Controller
{
    public function index()
    {

        return view('layouts.data_master.partai.index');

    }
    public function get_datatable()
    {
        // $tabulasi = Tabulasi::query();
        $partai = Partai::select(['id','nama']);
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($partai)


        ->addColumn('action', function ($partai) {
            return '<a href="'.route('datamaster.partai.show', $partai->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Lihat</a><a href="'.route('datamaster.partai.edit', $partai->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('datamaster.partai.delete', $partai->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Delete</a>';
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

        $partai = Partai::find($id);
        // dd($tabulasi);

        if (empty($partai)) {
            flash('Tabulasi not found')->error();

            return redirect(route('tabulasi.index'));
        }

        return view('layouts.data_master.partai.show',compact('partai','chart'));


    }

    public function create()
    {
        return view('layouts.data_master.partai.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $partai = Partai::create($input);

        flash('Data Tabulasi created successfully')->success();
        return redirect(route('datamaster.partai.show',$partai));
    }



    public function edit ($id)
    {
        // $tabulasi = $this->findWithoutFail($id);
        $partai = Tabulasi::find($id);
        $provinsi = Provinsi::pluck('nama_provinsi','id')->all();
        $kota_kabupaten = KotaKab::where('provinsi_id', $partai->provinsi_id)->pluck('nama','id')->all();
        $kecamatan = Kecamatan::where('kota_kabupaten_id', $partai->kota_kabupaten_id)->pluck('nama','id')->all();
        $kelurahan = Kelurahan::where('kecamatan_id', $partai->kecamatan_id)->pluck('nama','id')->all();
        // dd($kota_kabupaten);

        if (empty($partai)) {
            flash('Data Tabulasi Tidak Ada');

            return redirect(route('tabulasi.index'));
        }

        return view('layouts.tabulasi.edit', compact('tabulasi','provinsi','kota_kabupaten','kecamatan','kelurahan'));
    }



    public function update(Request $request,$id)
    {
        $partai = Tabulasi::find($id);
        if (empty($partai)) {

            flash('Tabulasi not found');

            return redirect(route('layouts.tabulasi.index'));
        }

        $partai->nama       = $request->nama;


        $partai->update();


        flash('Data Tabulasi saved successfully')->success();
        return redirect(route('tabulasi.show', $partai));

    }

    public function destroy($id)
    {

        $partai = Tabulasi::findOrFail($id);
        if (empty($partai)) {

            flash('Tabulasi not found');

            return redirect(route('layouts.tabulasi.index'));
        }
        $partai->delete();

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
