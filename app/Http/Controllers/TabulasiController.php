<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Charts;

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
    public function index()
    {
        $chart_penggunaan_suara = Charts::multi('bar', 'material')
            // Setup the chart settings
            ->title("Penggunaan Surat Suara")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(900, 400) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
            // ->colors(['#2196F3', '#F44336', '#FFC107'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Surat Suara', [30,4,20,80])
            // Setup what the values mean
            ->labels(['Surat suara yang diterima dan cadangan', 'Surat suara dikembalikan', 'Surat suara tidak digunakan', 'Surat suara yang digunakan']);

        $chart_jumlah_suara = Charts::multi('bar', 'material')
            // Setup the chart settings
            ->title("Jumlah Surat Suara")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(800, 400) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
            // ->colors(['#2196F3', '#F44336', '#FFC107'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Surat Suara', [70,4,100])
            // Setup what the values mean
            ->labels(['Surat sah seluruh salon', 'Surat tidak sah', 'Suara sah dan tidak sah']);

        $chart_total_calon = Charts::multi('bar', 'material')
            // Setup the chart settings
            ->title("Total Suara Calon")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(800, 400) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
            // ->colors(['#2196F3', '#F44336', '#FFC107'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Suara Calon', [30,65,5])
            // Setup what the values mean
            ->labels(['Pasangan 1', 'Pasangan 2', 'Pasangan 3']);

       return view('layouts.tabulasi.index', ['chart_penggunaan_suara' => $chart_penggunaan_suara,'chart_jumlah_suara' => $chart_jumlah_suara, 'chart_total_calon' => $chart_total_calon]);
    }

    public function create()
    {
        return view('layouts.tabulasi.create');
    }
}
