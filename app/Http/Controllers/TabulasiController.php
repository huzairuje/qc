<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tabulasi;
use App\Dokumen;
use App\Provinsi;
use App\KotaKab;
use App\Kecamatan;
use App\Kelurahan;
use Charts;
use Flash;


class TabulasiController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function quickCount()
    {
        return view('layouts.tabulasi.quick_count');

    }

    public function index()
    {
        $chart = Charts::multi('bar', 'material')
            // Setup the chart settings
            ->title("Hasil Data Suara")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(500, 300) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
             ->colors(['#2196F3', '#F44336', '#FFC107'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Data Suara', [5,20,100])
            ->responsive(false)
            // Setup what the values mean
            ->labels(['Pasangan 1', 'Pasangan 2', 'Pasangan 3']);


        $tabulasis = Tabulasi::all();

        if (empty($tabulasis)) {
            flash('Tabulasi not found')->error();

        }

        $dokumen = Dokumen::pluck('tipe_dokumen','id')->all();
        
        $provinsi = Provinsi::pluck('nama_provinsi','id')->all();

        $kota_kabupaten = array();

        $kecamatan = array();

        $kelurahan = array();

        return view('layouts.tabulasi.index',  compact('chart','tabulasis','dokumen','provinsi','kota_kabupaten','kecamatan','kelurahan'));

    }

    public function show($id)
    {

        $tabulasi = Tabulasi::find($id);

        if (empty($tabulasi)) {
            flash('Tabulasi not found')->error();

            return redirect(route('tabulasi.index'));
        }

        return view('layouts.tabulasi.show',compact('tabulasi'));


    }

    public function create()
    {
        $dokumen = Dokumen::pluck('tipe_dokumen','id')->all();

        $provinsi = Provinsi::pluck('nama_provinsi','id')->all();

        $kota_kabupaten = array();

        $kecamatan = array();

        $kelurahan = array();

        return view('layouts.tabulasi.create', compact('dokumen','provinsi','kota_kabupaten','kecamatan','kelurahan'));
    }

    public function store(Request $request)
    {
        
        // $input = $request->except(['data_suara']);
        // $data_suara = $this->($request->data_suara);
        // $input['data_suara'] = $data_suara; 
        // $dokumen = Dokumen::pluck('tipe_dokumen','id')->all();

        // $provinsi = Provinsi::pluck('nama_provinsi','id')->all();

        // $kota_kabupaten = array();

        $input = $request->all();

        $tabulasi = Tabulasi::create($input);
       
        flash('Data Tabulasi updated successfully.')->success();
        return redirect(route('tabulasi.index', compact('dokumen', 'provinsi', 'kota_kabupaten','kecamatan','kelurahan')));
    }

    

    public function edit ($id)
    {
        $dokumen = Dokumen::pluck('tipe_dokumen','id')->all();
        $provinsi = Provinsi::pluck('nama_provinsi','id')->all();
        $kota_kabupaten = array();
        return view('layouts.tabulasi.create', compact('dokumen','provinsi','kota_kabupaten'));

    }
    public function update($id)
    {
        $dokumen = Dokumen::pluck('tipe_dokumen','id')->all();
        $provinsi = Provinsi::pluck('nama_provinsi','id')->all();
        $kota_kabupaten = array();
        return view('layouts.tabulasi.index', compact('dokumen','provinsi','kota_kabupaten','kecamatan','kelurahan'));
        
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
