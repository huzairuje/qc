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
use App\Models\Event;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\UserEvent;
use Sentinel;
use Charts;
use Flash;


class EventController extends Controller
{
    public function index()
    {
        return view('layouts.event.index');
    }

    public function create()
    {
        $provinsi = Provinsi::pluck('nama','id')->all();

        $kota = array();

        return view('layouts.event.create', compact('provinsi','kota'));
    }

    public function get_datatable()
    {
        $userEvents = UserEvent::all()->where('user_id', Sentinel::getUser()->id);
        foreach ($userEvents as $key => $userEvent) {
            $listEventId[$key] = $userEvent->event_id;
        }
        if(count($userEvents) != 0)
        {
            $data_event = Event::select(['id','nama','tahun','jenis','tingkat', 'lokasi', 'expired'])->whereIn('id', $listEventId);
        }
        else
        {
<<<<<<< HEAD
            $data_event = Event::select(['id','nama','tahun','jenis','tingkat', 'lokasi', 'expired']);
=======
            $data_event = Event::select(['id','nama','tahun','jenis','tingkat', 'provinsi', 'kabupaten_kota', 'dapil'])->where('id', 0);
>>>>>>> 68070a30006cc1848115d977ad07afbc34baa7f6
        }

        return Datatables::eloquent($data_event)->addColumn('action', function ($data_event) {
            return '<a href="'.route('event.show', $data_event->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Lihat</a><a href="'.route('event.edit', $data_event->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a><a href="'.route('event.delete', $data_event->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i>Delete</a>';
        })

        ->make(true);
    }

    public function store(Request $request)
    {
      if ($request->tingkat == 1){
        $request->merge(['lokasi' => $request->provinsi]);
      }
      else if ($request->tingkat == 2) {
        $request->merge(['lokasi' => $request->kabupaten_kota]);
      }
      else {
        $request->merge(['lokasi' => 0]);
      }

      $input = $request->all();
      dd($input);

       $data_event = Event::create($input);


       flash('Data Event created successfully')->success();
       return redirect(route('event.show',$data_event));
   }


   public function edit($id)
   {
    $userEvents = UserEvent::all()->where('user_id', Sentinel::getUser()->id);
    foreach ($userEvents as $key => $userEvent) {
        $listEventId[$key] = $userEvent->event_id;
    }

    $os = array("Mac", "NT", "Irix", "Linux");
    if (in_array($id, $listEventId)) {

        $data_event = Event::find($id);
        $provinsi = Provinsi::pluck('nama_provinsi','id')->all();
        $kota_kabupaten = KotaKab::where('provinsi_id', $data_event->provinsi_id)->pluck('nama','id')->all();

        if (empty($data_event)) {
            flash('Event Tidak Ada');

            return redirect(route('event.index'));
        }
        return view('layouts.event.edit', compact('data_event','provinsi','kota_kabupaten'));
    } else {
        flash('Event Tidak Ada');

        return redirect(route('event.index'));
    }

}
public function update(Request $request,$id)
{
    $data_event = Event::find($id);
    if (empty($data_event)) {

        flash('Event not found');

        return redirect(route('event.index'));
    }

    $data_event->nama       = $request->nama;
    $data_event->tahun       = $request->tahun;
    $data_event->jenis       = $request->jenis;
    $data_event->tingkat       = $request->tingkat;
    $data_event->provinsi       = $request->provinsi;
    $data_event->kabupaten_kota    = $request->kabupaten_kota;
    $data_event->dapil    = $request->dapil;
    $data_event->update();


    flash('Event saved successfully')->success();
    return redirect(route('event.show', $data_event));

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

            $data_event = Event::find($id);
        // dd($tabulasi);

            if (empty($data_event)) {
                flash('Event not found')->error();

                return redirect(route('event.index'));
            }

            return view('layouts.event.show',compact('data_event','chart'));


        }

        public function destroy($id)
        {

         $data_event = Event::findOrFail($id);
         if (empty($data_event)) {

            flash('Event not found');

            return redirect(route('event.index'));
        }
        $data_event->delete();

        flash('Data Saksi deleted successfully')->success();
        return redirect(route('event.index'));
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
            return Kota::where('provinsi_id',$request->provinsi_id)->orderBy('nama', 'ASC')->get()->pluck( 'nama', 'id' )->all();

            return $result;
            break;

            case 'get-kecamatan':
            return Kecamatan::where('kota_id', $request->kota_kabupaten_id)->orderBy('nama', 'ASC')->get()->pluck('nama', 'id')->all();
            break;

            default:
            return $result['status'] = false;
            break;
        }


    }
}
