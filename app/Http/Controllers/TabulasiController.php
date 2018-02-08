<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
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
use App\Models\Tabulasi;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Event;
use App\Models\Tps;
use App\Models\Dapil;
use App\Models\Calon;
use Charts;
use Flash;


class TabulasiController extends Controller
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

    public function quickCount()
    {
        return view('layouts.tabulasi.quick_count');

    }

    public function index()
    {
        return view('layouts.tabulasi.index');

    }
    public function get_datatable()
    {
         // $tabulasi = Tabulasi::query();
        $tabulasi = Tabulasi::select(['id','dokumen', 'provinsi_id', 'kota_id', 'kecamatan_id', 'kelurahan_id','data_suara']);
        // $dataTable = Datatables::eloquent($tabulasi);
        // return $dataTable->make(true);

        return Datatables::eloquent($tabulasi)

            ->editColumn('provinsi_id', function ($tabulasi) {
                if ($tabulasi->provinsi) {
                    return $tabulasi->provinsi->nama;
                } else {
                    return 'Data PROVINSI tidak ada';
                }
            })
            ->editColumn('kota_id', function ($tabulasi) {
                if ($tabulasi->kota) {
                    return $tabulasi->kota->nama;
                } else {
                    return 'Data KOTA/KABUPATEN tidak ada';
                }
            })
            ->editColumn('kecamatan_id', function ($tabulasi) {
                if ($tabulasi->kecamatan) {
                    return $tabulasi->kecamatan->nama;
                } else {
                    return 'Data KECAMATAN tidak ada';
                }
            })
            ->editColumn('kelurahan_id', function ($tabulasi) {
                if ($tabulasi->kecamatan) {
                    return $tabulasi->kelurahan->nama;
                } else {
                    return 'Data KELURAHAN tidak ada';
                }
            })
            ->editColumn('data_suara', function ($tabulasi) {
                if ($tabulasi->data_suara) {
                    return 'Data SUARA ada';
                } else {
                    return 'Data SUARA tidak ada';
                }
            })
            ->addColumn('action', function ($tabulasi) {
            return '<a href="'.route('tabulasi.show', $tabulasi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i>Lihat</a><a href="'.route('tabulasi.edit', $tabulasi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('tabulasi.delete', $tabulasi->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
        })

            ->make(true);
    }



    public function show($id)
    {
       
       
       $tabulasi = Tabulasi::find($id);
       dd($tabulasi);
       // $eventchart = Event::chart()->where("event.id", $event_id)->get()->toJson();
        // dd($tabulasi);
       // case 'get-tps-calon':

       //    $result['status'] = false;
        $tps = Tps::where('kelurahan_id', $tabulasi->kelurahan_id)->orderBy('nomor', 'ASC')->pluck('nomor', 'id')->all();
        // dd($tps);

        // if ($request->event_id) {
        $dapil = Dapil::where('event_id',$tabulasi->event_id)->pluck('id')->all();

          // if ($dapil) {
        // $calon = array();
        $calon = Calon::whereIn('dapil_id',$dapil)->get();
          // }
        $eventchart = Event::chart()->where("event.id", $tabulasi->event_id)->get()->toJson();
        // dd($eventchart);

          // $result['status'] = true;
        // }

        // $result['html'] = view('layouts.tabulasi.data',compact('calon','tps'))->render();
        // return $result;
        // break;

        if (empty($tabulasi)) {
            flash('Tabulasi not found')->error();

            return redirect(route('tabulasi.index'));
        }

        return view('layouts.tabulasi.show',compact('tabulasi','tps','dapil','calon','eventchart'));


    }

    public function create()
    {


        $provinsi = Provinsi::pluck('nama','id')->all();
        // dd($provinsi);

        $kota = array();
        // dd($kota_kabupaten);

        $kecamatan = array();

        $kelurahan = array();

        $event = Event::dropdown();

        return view('layouts.tabulasi.create', compact('provinsi','kota','kecamatan','kelurahan','event'));
    }

    public function store(Request $request)
    {
      $v = $this->validate($request,[
        'dokumen' => 'required',
         // 'tingkat_id' => 'required',
         'provinsi_id' => 'required',
         'kota_id' => 'required',
         'kecamatan_id' => 'required',
         'kelurahan_id' => 'required',
         'event_id' => 'required',
          ]);


        $input = $request->all();
        // dd($request);

        if ($request->tabulasi) {
          $input['data_suara'] = json_encode($request->tabulasi);
        }
        $tabulasi = Tabulasi::create($input);
        // dd($tabulasi);

        flash('Data Tabulasi created successfully')->success();
        return redirect(route('tabulasi.show',$tabulasi));
    }



    public function edit ($id)
    {
        // $tabulasi = $this->findWithoutFail($id);
        $tabulasi = Tabulasi::find($id);
        $provinsi = Provinsi::pluck('nama','id')->all();
        $kota = Kota::where('provinsi_id', $tabulasi->provinsi_id)->pluck('nama','id')->all();
        $kecamatan = Kecamatan::where('kota_id', $tabulasi->kota_id)->pluck('nama','id')->all();
        $kelurahan = Kelurahan::where('kecamatan_id', $tabulasi->kecamatan_id)->pluck('nama','id')->all();
        $event = Event::dropdown();
        // dd($event);
        $data_suara = (array) json_decode($tabulasi->data_suara, true);

        // dd($data_suara);
          $tps = Tps::where('kelurahan_id', $tabulasi->kelurahan_id)->orderBy('nomor', 'ASC')->pluck('nomor', 'id')->all();

          $calon = array();
          if ($tabulasi->event_id) {
            $dapil = Dapil::where('event_id',$tabulasi->event_id)->pluck('id')->all();

            if ($dapil) {
              $calon = Calon::whereIn('dapil_id',$dapil)->get();
            }
          }

        if (empty($tabulasi)) {
            flash('Data Tabulasi Tidak Ada');

            return redirect(route('tabulasi.index'));
        }

        return view('layouts.tabulasi.edit', compact('tabulasi','provinsi','kota','kecamatan','kelurahan','event', 'calon','tps', 'data_suara'));
    }



    public function update(Request $request,$id)
    {
        $tabulasi = Tabulasi::find($id);
        if ($request->tabulasi) {
            $data_suara = json_encode($request->tabulasi);
          }
            if (empty($tabulasi)) {

                flash('Tabulasi not found');

            return redirect(route('layouts.tabulasi.index'));
        }

            $tabulasi->dokumen       = $request->dokumen_id;
            $tabulasi->provinsi_id       = $request->provinsi_id;
            $tabulasi->kota_id    = $request->kota_id;
            $tabulasi->kelurahan_id    = $request->kelurahan_id;
            $tabulasi->data_suara    = $data_suara;

            $tabulasi->save();
       


        flash('Data Tabulasi saved successfully')->success();
        return redirect(route('tabulasi.show', $tabulasi));

    }

    public function destroy($id)
    {

    	$tabulasi = Tabulasi::findOrFail($id);
            if (empty($tabulasi)) {

                    flash('Tabulasi not found');

                return redirect(route('layouts.tabulasi.index'));
            }
        $tabulasi->delete();

        flash('Data Tabulasi deleted successfully')->success();
        return redirect(route('tabulasi.index'));
	}

  // public function ajaxChart($id)
  // {
  //   $tabulasi = Tabulasi::find($id);
  //     $event = Event::chart()->where("event.id", $tabulasi->event_id)->get();
  //       {
  //       return response()->json($event);
  //       }
  // }

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

          case 'get-tps-calon':

          $result['status'] = false;
          $tps = Tps::where('kelurahan_id', $request->kelurahan_id)->orderBy('nomor', 'ASC')->pluck('nomor', 'id')->all();

          $calon = array();
          if ($request->event_id) {
            $dapil = Dapil::where('event_id',$request->event_id)->pluck('id')->all();

            if ($dapil) {
              $calon = Calon::whereIn('dapil_id',$dapil)->get();
            }

            $result['status'] = true;
          }

          $result['html'] = view('layouts.tabulasi.data',compact('calon','tps'))->render();
          return $result;
          break;

          default:
          return $result['status'] = false;
          break;


      }
  }




}
