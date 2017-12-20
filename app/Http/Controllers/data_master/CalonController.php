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
use App\Models\Calon;
use App\Models\Event;

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
        $calon = Calon::select(['id','nama', 'dapil_id', 'no_telpon', 'email', 'tipe', 'partai_id','nomor','alamat', 'foto']);
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($calon)

            ->editColumn('event_id', function ($calon) {
                if ($calon->event) {
                    return $calon->event->nama;
                } else {
                    return 'Data Event tidak ada';
                }
            })

            ->addColumn('action', function ($calon) {
            return '<a href="'.route('datamaster.calon.show', $calon->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Lihat</a><a href="'.route('datamaster.calon.edit', $calon->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('datamaster.calon.delete', $calon->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Delete</a>';
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

        $calon = Calon::find($id);
        // dd($tabulasi);

        if (empty($calon)) {
            flash('Calon not found')->error();

            return redirect(route('datamaster.calon.index'));
        }

        return view('layouts.data_master.calon.show',compact('calon','chart'));


    }

    public function create()
    {
        $event = Event::pluck('nama','id')->all();

        return view('layouts.data_master.calon.create', compact('event'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $calon = Calon::create($input);

        flash('Data Calon created successfully')->success();
        return redirect(route('datamaster.calon.show',$calon));
    }



    public function edit ($id)
    {
        // $tabulasi = $this->findWithoutFail($id);
        $calon = Calon::find($id);
        $event = Event::where('id', $calon->event_id)->pluck('nama','id')->all();

        if (empty($calon)) {
            flash('Data Calon Tidak Ada');

            return redirect(route('calon.index'));
        }

        return view('layouts.data_master.calon.edit', compact('calon','event'));
    }



    public function update(Request $request,$id)
    {
        $calon = Calon::find($id);
            if (empty($calon)) {

                flash('Calon not found');

            return redirect(route('layouts.data_master.calon.index'));
        }

            $calon->nama            = $request->nama;
            $calon->alamat          = $request->alamat;
            $calon->no_telpon       = $request->no_telpon;
            $calon->email           = $request->email;
            $calon->event_id        = $request->event_id;
            $calon->list_dapil_id   = $request->list_dapil_id;
            $calon->foto            = $request->foto;

            $calon->update();


        flash('Data Calon saved successfully')->success();
        return redirect(route('datamaster.calon.show', $calon));

    }

    public function destroy($id)
    {

    	$calon = Calon::findOrFail($id);
            if (empty($calon)) {

                    flash('Calon not found');

                return redirect(route('layouts.data_master.calon.index'));
            }
        $calon->delete();

        flash('Data Calon deleted successfully')->success();
        return redirect(route('datamaster.calon.index'));
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
