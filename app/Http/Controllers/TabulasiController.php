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
use App\Models\TpsFoto;
use App\Models\Suara;
use App\Models\UserEvent;
use Sentinel;
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
      $userEvents = UserEvent::all()->where('user_id', Sentinel::getUser()->id);
        foreach ($userEvents as $key => $userEvent) {
            $listEventId[$key] = $userEvent->event_id;
        }

        if(count($userEvents) != 0)
        {
            $tabulasi = Tabulasi::select(['id','dokumen', 'provinsi_id', 'kota_id', 'kecamatan_id', 'kelurahan_id','data_suara','event_id'])->whereIn('event_id', $listEventId);
          
        }
        else
        {
            $tabulasi = Tabulasi::select(['id','dokumen', 'provinsi_id', 'kota_id', 'kecamatan_id', 'kelurahan_id','data_suara','event_id'])->where('event_id', 0);
        }

        // $tabulasi = Tabulasi::select(['id','dokumen', 'provinsi_id', 'kota_id', 'kecamatan_id', 'kelurahan_id','data_suara','event_id']);

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
            ->addColumn('event_id', function($tabulasi) {
              return $tabulasi->event && $tabulasi->event->nama ? $tabulasi->event->nama : 'Tidak Ada';
            })

            ->addColumn('action', function ($tabulasi) {
            return '<a href="'.route('tabulasi.show', $tabulasi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i>Lihat</a><a href="'.route('tabulasi.edit', $tabulasi->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('tabulasi.delete', $tabulasi->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
        })

            ->make(true);
    }



    public function show($id)
    {
       $tabulasi = Tabulasi::find($id);
       $cek_user = \Sentinel::getUser()->roles[0]->slug;
          if ($cek_user == 'saksi') {
              $tps_all = Tps::where('saksi_tps.kelurahan_id', $tabulasi->kelurahan_id)
              ->where('saksi_tps.user_id', '=', \Sentinel::getUser()->id)
              ->join('saksi_tps', 'saksi_tps.tps_id','=','tps.id')
              ->get();
          } else {
            $tps_all = Tps::where('kelurahan_id', $tabulasi->kelurahan_id)->get();
          }
     //  dd($tabulasi);
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
          // $result['status'] = true;
        // }

        // $result['html'] = view('layouts.tabulasi.data',compact('calon','tps'))->render();
        // return $result;
        // break;

        if (empty($tabulasi)) {
            flash('Tabulasi not found')->error();

            return redirect(route('tabulasi.index'));
        }

        return view('layouts.tabulasi.show',compact('tabulasi','tps','dapil','calon','eventchart', 'data_suara', 'tps_all' ));


    }

    public function create()
    {


        $provinsi = Provinsi::pluck('nama','id')->all();
        // dd($provinsi);

        $kota = array();
        // dd($kota_kabupaten);

        $kecamatan = array();

        $kelurahan = array();

        // $event = ;

        $logged_user = Sentinel::getUser();
        $logged_user_role = $logged_user->role_user->role->slug;
        switch ($logged_user_role) {
            case 'admin-pusat':
                $event = Event::pluck('nama', 'id')->all();
                break;
            default:
                $userEvents = UserEvent::where('user_id', Sentinel::getUser()->id)->first();
                $event = $userEvents->events()->pluck('nama', 'id')->all(); 
                break;
        }


        // $event = Event::pluck('nama', 'id')->all();


        return view('layouts.tabulasi.create', compact('provinsi','kota','kecamatan','kelurahan','event'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $v = $this->validate($request,[
                'dokumen' => 'required',
                 // 'tingkat_id' => 'required',
                 'provinsi_id' => 'required',
                 'kota_id' => 'required',
                 'kecamatan_id' => 'required',
                 'kelurahan_id' => 'required|unique:tabulasi,kelurahan_id,NULL,id,event_id,'.$request->event_id,
                 'event_id' => 'required',
        
                  ],
                  [
                    'kelurahan_id' => 'Tabulasi untuk kelurahan ini sudah terdaftar.'
                  ]);
        
        
                $input = $request->all();
                // dd($input);
        
                if ($request->tabulasi) {
                  $input['data_suara'] = json_encode($request->tabulasi);
                }
                $tabulasi = Tabulasi::create($input);
                // dd($tabulasi);
        
                if ($request->images) {
                  foreach ($request->images as $tps => $images) {
                    if ($images) {
                      foreach ($images as $key => $image) {
                        if ($request->file('images')[$tps][$key]->isValid()) {
                          $pathname = check_dir('images');
                          $filename = time() . number_random(10) . '.' . $request->file('images')[$tps][$key]->getClientOriginalExtension();
                          $uploaded = $request->file('images')[$tps][$key]->move($pathname, $filename);
                          $url = $uploaded->getPathName();
        
                          TpsFoto::create([
                            'tps_id' => $tps,
                            'foto' => $url,
                            'event_id' => $request->event_id
                          ]);
        
                          // insert to tabel suara so home dashboard graphic can see the data trough this
                          // Suara::create([
                          //   'tps_id' => $tps,
                          //   'calon_id' => $
                          // ]);
                        }
                      }
                    }
                  } 
                }
            DB::commit();

            flash('Data Tabulasi created successfully')->success();
            return redirect(route('tabulasi.show',$tabulasi));
        } catch(\Exception $e) {
            DB::rollback();
            flash($e->getMessage())->error();
            return redirect()->back();
        }
      
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
        $cek_user = \Sentinel::getUser()->roles[0]->slug;
        if ($cek_user == 'saksi') {
            $tps_all = Tps::where('saksi_tps.kelurahan_id', $tabulasi->kelurahan_id)
            ->where('saksi_tps.user_id', '=', \Sentinel::getUser()->id)
            ->join('saksi_tps', 'saksi_tps.tps_id','=','tps.id')
            ->get();
        } else {
          $tps_all = Tps::where('kelurahan_id', $tabulasi->kelurahan_id)->get();
        }

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

        return view('layouts.tabulasi.edit', compact('tabulasi','provinsi','kota','kecamatan','kelurahan','event', 'calon','tps', 'data_suara', 'tps_all'));
    }



    public function update(Request $request,$id)
    {
        // dd($request->all());

        $tabulasi = Tabulasi::find($id);
        if ($request->tabulasi) {
            $data_suara = json_encode($request->tabulasi);
          }
            if (empty($tabulasi)) {

                flash('Tabulasi not found');

            return redirect(route('layouts.tabulasi.index'));
        }

            // $tabulasi->dokumen       = $request->dokumen_id;
            // $tabulasi->provinsi_id       = $request->provinsi_id;
            // $tabulasi->kota_id    = $request->kota_id;
            // $tabulasi->kecamatan_id    = $request->kecamatan_id;
            // $tabulasi->kelurahan_id    = $request->kelurahan_id;
            // $tabulasi->data_suara    = $data_suara;

            // $tabulasi->save();

            if ($request->old_images) {
              foreach ($request->old_images as $tps => $images) {
                if ($images) {
                  TpsFoto::where("tps_id", "=", $tps)->delete();
                  foreach ($images as $key => $image) {
                    TpsFoto::create([
                      'tps_id' => $tps,
                      'foto' => $image,
                      'event_id' => $request->event_id

                    ]);
                  }
                }
              }
            }

            // reinsert photo
            if ($request->images) {
              foreach ($request->images as $tps => $images) {
                if ($images) {
                  foreach ($images as $key => $image) {
                    if ($request->file('images')[$tps][$key]->isValid()) {
                      $pathname = check_dir('images');
                      $filename = time() . number_random(10) . '.' . $request->file('images')[$tps][$key]->getClientOriginalExtension();
                      $uploaded = $request->file('images')[$tps][$key]->move($pathname, $filename);
                      $url = $uploaded->getPathName();

                      TpsFoto::create([
                        'tps_id' => $tps,
                        'foto' => $url,
                        'event_id' => $request->event_id

                      ]);
                    }
                  }
                }
              } 
            }
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
          $cek_user = \Sentinel::getUser()->roles[0]->slug;
          if ($cek_user == 'saksi') {
              $tps_ids = Tps::where('saksi_tps.kelurahan_id', $request->kelurahan_id)
              ->where('saksi_tps.user_id', '=', \Sentinel::getUser()->id)
              ->join('saksi_tps', 'saksi_tps.tps_id','=','tps.id')
              ->get();
          } else {
            $tps_ids = Tps::where('kelurahan_id', $request->kelurahan_id)->get();
          }

          $calon = array();
          if ($request->event_id) {
            $dapil = Dapil::where('event_id',$request->event_id)->pluck('id')->all();

            if ($dapil) {
              $calon = Calon::whereIn('dapil_id',$dapil)->get();
            }

            $result['status'] = true;
          }

          $result['html'] = view('layouts.tabulasi.data',compact('calon','tps'))->render();
          $result['table'] = view('layouts.tabulasi.images', compact('tps', 'tps_ids'))->render();
          return $result;
          break;

          default:
          return $result['status'] = false;
          break;


      }
  }




}
