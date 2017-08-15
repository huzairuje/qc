<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
use App\Http\Requests; 
use DB;
use Yajra\Datatables\Facades\Datatables;
use Yajra\Datatables\Facades\Datatables\Editor;
use Yajra\Datatables\Facades\Datatables\Field;
use Yajra\Datatables\Facades\Datatables\Format;
use Yajra\Datatables\Facades\Datatables\Mjoin;
use Yajra\Datatables\Facades\Datatables\Options;
use Yajra\Datatables\Facades\Datatables\Upload;
use Yajra\Datatables\Facades\Datatables\Validate;
use App\Tabulasi; 
use App\Dokumen; 
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

        
 
 
        // // $tabulasis = Tabulasi::get(); 
        // // dd($tabulasis);
        // // $tabulasis = DB::table('tabulasi')->simplePaginate(15);
        // $tabulasis = Tabulasi::paginate(50);
 		
        // $dokumen = Dokumen::pluck('tipe_dokumen','id')->all(); 
         
        // $provinsi = Provinsi::pluck('nama_provinsi','id')->all(); 
 
        // $kota_kabupaten = array(); 
 
        // $kecamatan = array(); 
 
        // $kelurahan = array(); 
 		
 		return view('layouts.tabulasi.index');
        // return view('layouts.tabulasi.index',  compact('chart','tabulasis','dokumen','provinsi','kota_kabupaten','kecamatan','kelurahan')); 
 
    } 
    public function get_datatable()
    {
        // $dokumen = Tabulasi::join('dokumen', 'dokumen.id', '=', 'tabulasi.dokumen_id')->select(['dokumen.id', 'dokumen.tipe_dokumen']);
            // join it with drawing table
            
            //select columns for new virtual table. ID columns must be renamed, because they have the same title
            
    	// $kota_kabupaten = KotaKab::query();
    	// $kecamatan = Kecamatan::query();
    	// $kelurahan = Kelurahan::query();

    	// $dokumen = Tabulasi::query('dokumen.id', '=', 'dokumen_id')->select(['dokumen.id', 'dokumen.tipe_dokumen']);

   
    	$tabulasi = Tabulasi::query();
    	// $tabulasi = Tabulasi::query('dokumen')->where('dokumen_id.*')->value('dokumen_id');
	    $dataTable = Datatables::eloquent($tabulasi);
	    // $dataTable->where('id', 5);

	    return $dataTable->make(true);
    }

    // 	$dokumen = Tabulasi::with('dokumen_id')->select('tipe_dokumen.*')->join('dokumen');
    // 	dd($dokumen);
    // 	$provinsi = Tabulasi::with('provinsi_id')->select('nama_provinsi.*')->join('provinsi')->where('id');
    // 	$kota_kabupaten = Tabulasi::with('kota_kabupaten_id')->select('nama.*')->join('kota_kabupaten')->where('id');
    // 	$kecamatan = Tabulasi::with('kecamatan_id')->select('nama.*')->join('kecamatan')->where('id');
    // 	$kelurahan = Tabulasi::with('kelurahan_id')->select('nama.*')->join('kelurahan')->where('id');

    // 	return Datatables::eloquent(Tabulasi::query())->make(true);
    // }
 
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
        $provinsi_id = $request->input('nama_provinsi');
        $kota_kabupaten_id = $request->input('nama');
        $kecamatan_id = $request->input('nama');
        $kelurahan_id = $request->input('nama');
 
        $tabulasi = Tabulasi::create($input); 
        
        flash('Data Tabulasi updated successfully.')->success(); 
        return redirect(route('tabulasi.index', compact('dokumen', 'provinsi', 'kota_kabupaten','kecamatan','kelurahan'))); 
    } 
 
     
 
    public function edit ($id) 
    { 
        $dokumen = Dokumen::pluck('tipe_dokumen','id')->all(); 
        $provinsi = Provinsi::pluck('nama_provinsi','id')->all(); 
        $kota_kabupaten = array(); 
        return view('layouts.tabulasi.create', compact('dokumen','provinsi','kota_kabupaten')); 
 
    } 
    public function update($id) 
    { 
        $dokumen = Dokumen::pluck('tipe_dokumen','id')->all(); 
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
                 return KotaKab::where('provinsi_id',$request->provinsi_id->nama_provinsi)->orderBy('nama', 'ASC')->get()->pluck( 'nama', 'id' )->all(); 
 
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