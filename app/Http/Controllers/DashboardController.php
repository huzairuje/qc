<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Provinsi;
use App\Models\Event;
use App\Models\Dapil;
use App\Models\DapilLokasi;
use App\Models\Suara;
use Charts;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

      $event = Event::dropdown();
      $dapillokasi = DapilLokasi::all();

      $chart = Charts::multi('bar', 'material')
            // Setup the chart settings
            ->title("Chart Suara")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(700, 300) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
             ->colors(['#2196F3', '#F44336', '#FFC107'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset(Suara::select(['calon_id','jumlah']))
            ->responsive(false)
            // Setup what the values mean
            ->labels(['Pasangan 1', 'Pasangan 2', 'Pasangan 3']);

      return view('layouts.dashboard.index', compact('event','dapillokasi','chart'));
      // $chart = Charts::multi('line', 'material')->labels(Event::dropdown()->unique('nama'));
      //   foreach (Table::all()->unique('segment') as $segment) {
      //       $data = Table::where('segment', $segment)->get()->pluck('claim');
      //       $f_data = [];
      //       for ($i = 0; $i < count($data); $i++) {
      //           $value = $i != 0 ? $ $data[$i] + $data[$i - 1] : $data[$i];
      //           array_push($f_data, $value);
      //       }
      //       $chart->dataset($segment, $f_data);
      //   }
      //
      //   return view('layouts.dashboard.index', compact('event','dapillokasi','chart'));
            }

    public function ajax()
    {
      // $event = Event::dropdown();
      //
      // $chart = Charts::multi('bar', 'material')
      //       // Setup the chart settings
      //       ->title('event')
      //       // A dimension of 0 means it will take 100% of the space
      //       ->dimensions(700, 300) // Width x Height
      //       // This defines a preset of colors already done:)
      //       ->template("material")
      //       // You could always set them manually
      //        ->colors(['#2196F3', '#F44336', '#FFC107'])
      //       // Setup the diferent datasets (this is a multi chart)
      //       ->dataset('Data Suara', [5,20,100])
      //       ->responsive(false)
      //       // Setup what the values mean
      //       ->labels(['Pasangan 1', 'Pasangan 2', 'Pasangan 3']);
    }


}
