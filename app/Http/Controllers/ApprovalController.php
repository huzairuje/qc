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
use App\Models\Approval;
use App\Models\Event;
use App\Models\User;
use App\Models\UserManagement;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Charts;
use Flash;

class ApprovalController extends Controller
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

      return view('layouts.approval.index');

  }
  public function get_datatable()
  {
      $approval = Approval::select(['id','user_id', 'event_id', 'kelurahan_id', 'tps_id', 'is_approved']);

      return Datatables::eloquent($approval)
          ->editColumn('user_id', function ($approval) {
              if ($approval->user_id) {
                  return $approval->user->username ? $approval->user->username : 'Undefined';
              } else {
                  return 'Nama Saksi tidak ada';
              }
          })
          ->editColumn('event_id', function ($approval) {
              if ($approval->event_id) {
                  return $approval->event->nama;
              } else {
                  return 'Nama Event Tidak Ada';
              }
          })
          ->editColumn('is_approved', function ($approval) {
              if ($approval->is_approved == 'true' ) {
                  return 'diapprove';
              } else {
                  return 'belum diapprove';
              }
          })

          ->addColumn('provinsi', function ($approval) {
              return $approval->kelurahan->kecamatan->kota->provinsi && $approval->kelurahan->kecamatan->kota->provinsi->nama ? $approval->kelurahan->kecamatan->kota->provinsi->nama : 'Undefined';
          })
          ->addColumn('kota', function ($approval) {
              return $approval->kelurahan->kecamatan->kota && $approval->kelurahan->kecamatan->kota->nama ? $approval->kelurahan->kecamatan->kota->nama : 'Undefined';
          })
          ->addColumn('kecamatan', function ($approval) {
              return $approval->kelurahan->kecamatan && $approval->kelurahan->kecamatan->nama ? $approval->kelurahan->kecamatan->nama : 'Undefined';
          })
          ->editColumn('kelurahan_id', function ($approval) {
              return $approval->kelurahan && $approval->kelurahan->nama ? $approval->kelurahan->nama : 'Undefined';
          })
          ->addColumn('action', function ($approval) {
          return '<a href="'.route('approval.show', $approval->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Lihat</a><a href="'.route('approval.edit', $approval->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('approval.delete', $approval->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Delete</a>';
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

      $approval = Approval::find($id);
      // dd($tabulasi);

      if (empty($approval)) {
          flash('Approval not found')->error();

          return redirect(route('approval.index'));
      }

      return view('layouts.approval.show',compact('approval','chart'));


  }

  public function create()
  {
      $saksi = User::pluck('username','id')->all();
      $event = Event::pluck('nama','id')->all();
      $tps = Tps::pluck('nomor','id')->all();
      $provinsi = Provinsi::pluck('nama','id')->all();
      // dd($provinsi);

      $kota = array();
      // dd($kota_kabupaten);

      $kecamatan = array();

      $kelurahan = array();

      return view('layouts.approval.create', compact('saksi','event','tps','event','provinsi','kota','kecamatan','kelurahan'));
  }

  public function store(Request $request)
  {
      $input = $request->all();

      $approval = Approval::create($input);

      flash('Data Approval created successfully')->success();
      return redirect(route('approval.show',compact('approval')));
  }



  public function edit ($id)
  {
      $approval = Approval::find($id);
      $event = Event::pluck('nama','id')->all();
      $provinsi = Provinsi::pluck('nama','id')->all();
      $kota = Kota::where('provinsi_id', $approval->provinsi_id)->pluck('nama','id')->all();
      $kecamatan = Kecamatan::where('kota_id', $approval->kota_id)->pluck('nama','id')->all();
      $kelurahan = Kelurahan::where('kecamatan_id', $approval->kecamatan_id)->pluck('nama','id')->all();
      $tps = Tps::pluck('nomor','id')->all();
      $user = User::pluck('username','id')->all();


      if (empty($approval)) {
          flash('Data Approval Tidak Ada');

          return redirect(route('approval.index'));
      }

      return view('layouts.approval.edit', compact('user','event','approval', 'provinsi','kota','kecamatan','kelurahan','tps'));
  }



  public function update(Request $request,$id)
  {
      $approval = Approval::find($id);
          if (empty($approval)) {

              flash('Absensi not found');

          return redirect(route('layouts.approval.index'));
      }

          $approval->user_id               = $request->user_id;
          $approval->event_id                = $request->event_id;
          $approval->kelurahan_id                = $request->kelurahan_id;
          $approval->tps_id                = $request->tps_id;
          $approval->is_approved                = $request->is_approved;
          // $absensi->user_replacement_id   = $request->user_replacement_id;

          $approval->update();


      flash('Data Approval saved successfully')->success();
      return redirect(route('approval.show', $approval));

  }

  public function destroy($id)
  {

    $approval = Approval::findOrFail($id);
          if (empty($approval)) {

                  flash('Approval not found');

              return redirect(route('layouts.approval.index'));
          }
      $approval->delete();

      flash('Data Approval deleted successfully')->success();
      return redirect(route('approval.index'));
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

        case 'get-tps':
        $result = Tps::where('kelurahan_id', $request->kelurahan_id)->orderBy('nomor', 'ASC')->get()->pluck('nomor', 'kelurahan_id')->all();
        return $result;
        break;

        default:
        return $result['status'] = false;
        break;
    }
}
}
