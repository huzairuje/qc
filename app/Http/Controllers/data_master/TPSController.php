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
use App\Models\TPS;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Charts;
use Flash;

class TPSController extends Controller
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

        return view('layouts.data_master.tps.index');

    }
    public function get_datatable()
    {
         // $tabulasi = Tabulasi::query();
        $tps = Tps::select(['id','nomor', 'kelurahan_id']);
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($tps)


            ->editColumn('nomor', function ($tps) {
                if ($tps->nomor) {
                    return $tps->nomor;
                } else {
                    return 'Nomor TPS tidak ada';
                }
            })
            ->editColumn('kelurahan_id', function ($tps) {
                if ($tps->kelurahan) {
                    return $tps->kelurahan->nama;
                } else {
                    return 'Data KELURAHAN tidak ada';
                }
            })
            ->addColumn('action', function ($tps) {
            return '<a href="'.route('datamaster.TPS.show', $tps->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Lihat</a><a href="'.route('datamaster.TPS.edit', $tps->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('datamaster.TPS.delete', $tps->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Delete</a>';
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

        $tps = Tps::find($id);
        // dd($tabulasi);

        if (empty($tps)) {
            flash('TPS not found')->error();

            return redirect(route('datamaster.tps.index'));
        }

        return view('layouts.data_master.tps.show',compact('tps','chart'));


    }

    public function create()
    {
      $provinsi = Provinsi::pluck('nama','id')->all();
        // dd($provinsi);

        $kota = array();
        // dd($kota_kabupaten);

        $kecamatan = array();

        $kelurahan = array();

        return view('layouts.data_master.tps.create', compact('provinsi','kota','kecamatan','kelurahan'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $tps = Tps::create($input);

        flash('Data TPS created successfully')->success();
        return redirect(route('datamaster.TPS.show',$tps));
    }



    public function edit ($id)
    {
        // $tabulasi = $this->findWithoutFail($id);
        $tps = Tps::find($id);
        $provinsi = Provinsi::pluck('nama','id')->all();
        $kota = Kota::where('provinsi_id', $tps->provinsi_id)->pluck('nama','id')->all();
        $kecamatan = Kecamatan::where('kota_id', $tps->kota_id)->pluck('nama','id')->all();
        $kelurahan = Kelurahan::where('kecamatan_id', $tps->kecamatan_id)->pluck('nama','id')->all();
        // dd($kota_kabupaten);

        if (empty($tps)) {
            flash('Data TPS Tidak Ada');

            return redirect(route('datamaster.tps.index'));
        }

        return view('layouts.data_master.tps.edit', compact('tps','provinsi','kota','kecamatan','kelurahan'));
    }



    public function update(Request $request,$id)
    {
        $tps = Tps::find($id);
            if (empty($tps)) {

                flash('TPS not found');

            return redirect(route('layouts.tabulasi.index'));
        }

            $tps->nomor           = $request->nomor;
            $tps->kelurahan_id    = $request->kelurahan_id;

            $tps->update();


        flash('Data TPS saved successfully')->success();
        return redirect(route('datamaster.TPS.show', $tps));

    }

    public function destroy($id)
    {

    	$tps = Tps::findOrFail($id);
            if (empty($tps)) {

                    flash('TPS not found');

                return redirect(route('layouts.data_master.tps.index'));
            }
        $tps->delete();

        flash('Data TPS deleted successfully')->success();
        return redirect(route('datamaster.tps.index'));
	}

  public function ajax(Request $request)
  {
      $type = $request->type;
      switch ($type) {
          case 'get-provincy':
          $result = Provinsi::get()->pluck( 'nama', 'id' )->all();
          return $result;
          break;

          case 'get-city':
          $result = Kota::where('provinsi_id',$request->provinsi_id)->orderBy('nama', 'ASC')->get()->pluck( 'nama', 'id' )->all();
          return $result;
          break;

          case 'get-kecamatan':
          $result = Kecamatan::where('kota_id', $request->kota_id)->orderBy('nama', 'ASC')->get()->pluck('nama', 'id')->all();
          return $result;
          break;

          case 'get-kelurahan':
          $result = Kelurahan::where('kecamatan_id', $request->kecamatan_id)->orderBy('nama', 'ASC')->get()->pluck('nama', 'id')->all();
          return $result;
          break;

          default:
          return $result['status'] = false;
          break;
      }
  }
}
