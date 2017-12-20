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
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Charts;
use Flash;
use App\Models\Dapil;
use App\Models\Event;

class DapilController extends Controller
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

        return view('layouts.data_master.dapil.index');

    }
    public function get_datatable()
    {
         // $tabulasi = Tabulasi::query();
        $dapil = Dapil::select(['id', 'nama', 'event_id']);
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);
        return Datatables::eloquent($dapil)

                ->editColumn('event_id', function ($dapil) {
                    if ($dapil->event) {
                        return $dapil->event->nama;
                    } else {
                        return 'Data Event tidak ada';
                    }
                })

                ->addColumn('action', function ($dapil) {
                    return '<a href="'.route('datamaster.dapil.show', $dapil->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Lihat</a><a href="'.route('datamaster.dapil.edit', $dapil->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('datamaster.dapil.delete', $dapil->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Delete</a>';
                })

            ->make(true);
    }



    public function show($id)
    {
      $dapil = Dapil::find($id);
        // dd($tabulasi);

        if (empty($dapil)) {
            flash('Dapil not found')->error();

            return redirect(route('datamaster.dapil.index'));
        }

        return view('layouts.data_master.dapil.show',compact('dapil'));


    }

    public function create()
    {

      $event = Event::pluck('nama','id')->all();

      $provinsi = Provinsi::pluck('nama','id')->all();
      // dd($provinsi);

      $kota = array();
      // dd($kota_kabupaten);

      $kecamatan = array();

      $kelurahan = array();
        return view('layouts.data_master.dapil.create', compact('provinsi','kota','kecamatan','kelurahan','event'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        // dd($request);
        $dapil = Dapil::create($input);

        flash('Data Calon created successfully')->success();
        return redirect(route('datamaster.dapil.show',$dapil));
    }



    public function edit ($id)
    {
        // $tabulasi = $this->findWithoutFail($id);
        $dapil = Dapil::find($id);
        // $event = Event::where('id', $dapil->event_id)->pluck('nama','id')->all();
        $event = Event::pluck('nama','id')->all();


        if (empty($dapil)) {
            flash('Data Dapil Tidak Ada');

            return redirect(route('datamaster.dapil.index'));
        }

        return view('layouts.data_master.dapil.edit', compact('dapil','event'));
    }



    public function update(Request $request,$id)
    {
        $dapil = Dapil::find($id);
            if (empty($dapil)) {

                flash('Dapil not found');

            return redirect(route('layouts.data_master.dapil.index'));
        }

            $dapil->nama            = $request->nama;
            $dapil->event_id          = $request->event_id;

            $dapil->update();


        flash('Data Dapil saved successfully')->success();
        return redirect(route('datamaster.dapil.show', $dapil));

    }

    public function destroy($id)
    {

    	$dapil = Dapil::findOrFail($id);
            if (empty($dapil)) {

                    flash('Dapil not found');

                return redirect(route('layouts.data_master.dapil.index'));
            }
        $dapil->delete();

        flash('Data Dapil deleted successfully')->success();
        return redirect(route('datamaster.dapil.index'));
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
