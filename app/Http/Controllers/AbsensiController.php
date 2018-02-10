<?php

namespace App\Http\Controllers;

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
use App\Models\Tps;
use App\Models\Absensi;
use App\Models\Event;
use App\Models\User;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Charts;
use Flash;
use Sentinel;

class AbsensiController extends Controller
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

      return view('layouts.absensi.index');

  }
  public function get_datatable()
  {
      $absensi = Absensi::select(['id','user_id', 'status', 'alasan', 'user_replacement_id']);

      return Datatables::eloquent($absensi)
          ->editColumn('user_id', function ($absensi) {
              if ($absensi->user_id) {
                  return $absensi->user->username ? $absensi->user->username : 'Undefined';
              } else {
                  return 'Nama Saksi tidak ada';
              }
          })
          ->editColumn('status', function ($absensi) {
              if ($absensi->status == 'true' ) {
                  return 'HADIR';
              } else {
                  return 'TIDAK HADIR';
              }
          })
          // ->addColumn('provinsi', function ($tps) {
          //     return $tps->kelurahan->kecamatan->kota->provinsi->nama ? $tps->kelurahan->kecamatan->kota->provinsi->nama : 'Undefined';
          // })
          // ->addColumn('kota', function ($tps) {
          //     return $tps->kelurahan->kecamatan->kota->nama ? $tps->kelurahan->kecamatan->kota->nama : 'Undefined';
          // })
          // ->addColumn('kecamatan', function ($tps) {
          //     return $tps->kelurahan->kecamatan->nama ? $tps->kelurahan->kecamatan->nama : 'Undefined';
          // })
          // ->editColumn('kelurahan_id', function ($tps) {
          //     return $tps->kelurahan->nama ? $tps->kelurahan->nama : 'Undefined';
          // })
          ->addColumn('action', function ($absensi) {
          return '<a href="'.route('absensi.show', $absensi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i>Lihat</a><a href="'.route('absensi.edit', $absensi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('absensi.delete', $absensi->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
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

      $absensi = Absensi::find($id);
      // dd($tabulasi);

      if (empty($absensi)) {
          flash('Absensi not found')->error();

          return redirect(route('absensi.index'));
      }

      return view('layouts.absensi.show',compact('absensi','chart'));


  }

  // public function create()
  // {
  //   $provinsi = Provinsi::pluck('nama','id')->all();
  //     // dd($provinsi);
  //
  //     $kota = array();
  //     // dd($kota_kabupaten);
  //
  //     $kecamatan = array();
  //
  //     $kelurahan = array();
  //
  //     return view('layouts.data_master.tps.create', compact('provinsi','kota','kecamatan','kelurahan'));
  // }
  //
  // public function store(Request $request)
  // {
  //     $input = $request->all();
  //
  //     $tps = Tps::create($input);
  //
  //     flash('Data TPS created successfully')->success();
  //     return redirect(route('datamaster.TPS.show',$tps));
  // }



  public function edit ($id)
  {
      // $tabulasi = $this->findWithoutFail($id);
      $absensi = Absensi::find($id);
      // $kehadiran = Absensi::select('status');

      // $provinsi = Provinsi::pluck('nama','id')->all();
      // $kota = Kota::where('provinsi_id', $tps->provinsi_id)->pluck('nama','id')->all();
      // $kecamatan = Kecamatan::where('kota_id', $tps->kota_id)->pluck('nama','id')->all();
      // $kelurahan = Kelurahan::where('kecamatan_id', $tps->kecamatan_id)->pluck('nama','id')->all();
      // dd($kota_kabupaten);

      if (empty($absensi)) {
          flash('Data Absensi Tidak Ada');

          return redirect(route('absensi.index'));
      }

      return view('layouts.absensi.edit', compact('absensi', 'kehadiran'));
  }



  public function update(Request $request,$id)
  {
      $absensi = Absensi::find($id);
          if (empty($absensi)) {

              flash('Absensi not found');

          return redirect(route('layouts.absensi.index'));
      }

          $absensi->user_id               = $request->user_id;
          $absensi->status                = $request->status;
          $absensi->alasan                = $request->alasan;
          // $absensi->user_replacement_id   = $request->user_replacement_id;

          $absensi->update();


      flash('Data Absensi saved successfully')->success();
      return redirect(route('absensi.show', $absensi));

  }

  public function destroy($id)
  {

    $absensi = Absensi::findOrFail($id);
          if (empty($absensi)) {

                  flash('Absensi not found');

              return redirect(route('layouts.absensi.index'));
          }
      $absensi->delete();

      flash('Data Absensi deleted successfully')->success();
      return redirect(route('absensi.index'));
}

/**
 * Menampilkan Data saksi
 *
 * @param int $id
 * @return void
 */
public function showSaksi( $id )
{
    $user = Sentinel::getUser();
    $data_saksi = Sentinel::findRoleById(7)->users()->with('roles')->pluck('first_name', 'id');
    $absensi = true;
    $getAbsen = Absensi::where('user_id', $id)->orderBy('created_at', 'DESC')->first();
    if ($getAbsen) {
        $absensi = date('Y-m-d', strtotime($getAbsen->created_at)) == date('Y-m-d') ? false : true;
    }
    
    return view('layouts.absensi.absen_saksi', compact('user', 'data_saksi', 'absensi'));
}

/**
 * Menambahkan data absen
 *
 * @param Request $request
 * @return void
 */
public function createAbsen( Request $request )
{
    DB::beginTransaction();
    try{
        $user_id = \Sentinel::getUser()->id;
        $request->merge( ['user_id' => $user_id] );
        // dd($request->all());
        Absensi::create( $request->all() );
        DB::commit();
        flash('Data Absensi successfully')->success();
        return redirect()->route('absensi.saksi.show', $user_id);
    } catch (\Exception $e) {
        flash('Data Absensi Failed')->warning();
        return redirect()->back();
    }
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
