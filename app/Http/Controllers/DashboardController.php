<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use App\Provinsi;

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
        $data['chart_hasil'] = Charts::create('pie', 'highcharts')
            ->title('Perolehan Suara')
            ->labels(['A', 'B', 'C', 'D'])
            ->values([5,10,15,10])
            ->dimensions(700,400)
            ->responsive(false);

        // return view('layouts.dashboard.index', compact('chart_hasil'));

        $data['listProvinsi'] = Provinsi::all();

        return view('layouts.dashboard.index', $data);
    }
}
