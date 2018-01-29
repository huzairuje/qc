<?php

namespace App\Http\Controllers\monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserEvent;
use App\Models\Event;
use Sentinel;
use DB;
use Yajra\Datatables\Facades\Datatables;
use Yajra\Datatables\Services\DataTable;

use Yajra\Datatables\Facades\Datatables\Field;

use Flash;

class LoginTerakhirController extends Controller
{
    public function index()
    {
    	return view('layouts.monitoring.login_terakhir.index');
    }

    public function get_datatable()
    {
         // $tabulasi = Tabulasi::query();
        $loginterakhir = User::select(['id','email', 'phone', 'last_login', 'username']);
        // $restaurants = restaurants::where('res_id', 1);
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($loginterakhir)

            ->addColumn('action', function ($loginterakhir) {
            return '<a href="'.route('monitoring.loginterakhir.show', $loginterakhir->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i>Lihat</a>';
        })

            ->make(true);
    }

    public function show($id)
    {
        $loginterakhir = User::find($id);
        // dd($tabulasi);

        if (empty($loginterakhir)) {
            flash('Data not found')->error();

            return redirect(route('monitoring.login_terakhir'));
        }

        return view('layouts.monitoring.login_terakhir.show',compact('loginterakhir'));


    }
}
