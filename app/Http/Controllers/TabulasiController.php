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
use App\Tabulasi;  
use App\Provinsi; 
use App\KotaKab; 
use App\Kecamatan; 
use App\Kelurahan; 
use Charts; 
use Flash; 
 
 
class TabulasiController extends Controller 
{ 
   /** 
     * Create a new controller instance. 
     * 
     * @return void 
     */ 
    public function __construct() 
    { 
        $this->middleware('guest'); 
    } 
 
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
    	 $tabulasi = Tabulasi::query();

	    // $dataTable = Datatables::eloquent($tabulasi);
	    // return $dataTable->make(true);

        return Datatables::eloquent($tabulasi)
            ->editColumn('provinsi_id', function ($tabulasi) {
                return $tabulasi->provinsi->nama_provinsi;              
            })
            ->editColumn('kota_kabupaten_id', function ($tabulasi) {
                return $tabulasi->kota_kabupaten->nama;
            })
            ->editColumn('kecamatan_id', function ($tabulasi) {
                return $tabulasi->kecamatan->nama;
            })
            ->editColumn('kelurahan_id', function ($tabulasi) {
                return $tabulasi->kelurahan->nama;
            })
            ->make(true);
    }
    public function data(Request $request)
    {
        // cek ajax request   
        if($request->ajax()){
            $tabulasi = Tabulasi::select('id', 'provinsi_id', 'kota_kabupaten_id', 'kecamatan_id', 'kelurahan_id')
                        ->get();
            return Datatables::of($tabulasi)
                    // tambah kolom untuk aksi edit dan hapus
                    ->addColumn('action', 
                    '<a href="#" title="Edit" class="btn-sm btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                    
                    <form style="display: inline">
                        <input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" value="{!! csrf_token() !!}">
                        <button class="btn-sm btn-danger" type="button" style="border: none"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                    </form>')
                    ->editColumn('provinsi_id', function ($tabulasi) {
                return $tabulasi->provinsi_id->nama_provinsi;              
            })
                    ->make(true);
        } else {
            exit("Not an AJAX request -_-");
        }
    }
 
    public function show($id) 
    { 
    	// $chart = Charts::multi('bar', 'material') 
        //     // Setup the chart settings 
        //     ->title("Hasil Data Suara") 
        //     // A dimension of 0 means it will take 100% of the space 
        //     ->dimensions(500, 300) // Width x Height 
        //     // This defines a preset of colors already done:) 
        //     ->template("material") 
        //     // You could always set them manually 
        //      ->colors(['#2196F3', '#F44336', '#FFC107']) 
        //     // Setup the diferent datasets (this is a multi chart) 
        //     ->dataset('Data Suara', [5,20,100]) 
        //     ->responsive(false) 
        //     // Setup what the values mean 
        //     ->labels(['Pasangan 1', 'Pasangan 2', 'Pasangan 3']); 
 
        $tabulasi = Tabulasi::find($id); 
        // dd($tabulasi);
 
        if (empty($tabulasi)) { 
            flash('Tabulasi not found')->error(); 
 
            return redirect(route('tabulasi.index')); 
        } 
 
        return view('layouts.tabulasi.show',compact('tabulasi')); 
 
 
    } 
 
    public function create() 
    { 	


        $provinsi = Provinsi::pluck('nama_provinsi','id')->all(); 
        // dd($provinsi);
 		
        $kota_kabupaten = array(); 
        // dd($kota_kabupaten);
 
        $kecamatan = array(); 
 
        $kelurahan = array();
        
        return view('layouts.tabulasi.create', compact('provinsi','kota_kabupaten','kecamatan','kelurahan')); 
    } 
 
    public function store(Request $request) 
    { 
 		


        $input = $request->all();
 
        $tabulasi = Tabulasi::create($input); 
        
        flash('Data Tabulasi created successfully.')->success(); 
        return redirect(route('tabulasi.show',$tabulasi)); 
    } 
 
     
 
    public function edit ($id) 
    { 
        $provinsi = Provinsi::pluck('nama_provinsi','id')->all(); 
        $kota_kabupaten = array(); 
        return view('layouts.tabulasi.create', compact('dokumen','provinsi','kota_kabupaten')); 
 
    } 
    public function update($id) 
    { 
        $provinsi = Provinsi::pluck('nama_provinsi','id')->all(); 
        $kota_kabupaten = array(); 
        return view('layouts.tabulasi.index', compact('dokumen','provinsi','kota_kabupaten','kecamatan','kelurahan')); 
         
    } 

    public function destroy( $id, Request $request ) 
    {

    	$tabulasis = Tabulasi::findOrFail( $id );

		    if ( $request->ajax() ) {
		        $product->delete( $request->all() );

		        return response(['msg' => 'Tabulasi deleted', 'status' => 'success']);
		    }
		    return response(['msg' => 'Failed deleting the Tabulasi', 'status' => 'failed']);
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