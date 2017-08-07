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
        // return $tabulasiDataTable->render('tabulasi.index');
        return view('layouts.tabulasi.index');

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

        return view('layouts.tabulasi.create', compact('dokumen','provinsi','kota_kabupaten'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $tabulasi = Tabulasi::create($input);

        flash('Data Tabulasi updated successfully.')->success();
        return redirect(route('tabulasi.show', $tabulasi->id));
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
        return view('layouts.tabulasi.create', compact('dokumen','provinsi','kota_kabupaten'));
        
    }

    
}
