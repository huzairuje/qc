@extends('index')

@section('title')

@endsection

@section('extra-css')

@endsection

@section('content')

	<div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-blue">
                    <h2>
                        BUAT DATA DAPIL (Daerah Pemilihan)
                    </h2>
                </div>

                <div class="box box-primary">

		            <div class="box-body">
		                <div class="row">
        <div class="body">
            <div class="row clearfix">
                <!-- Content Create-->
                {!! Form::open(['route' => 'datamaster.dapil.store']) !!}

                    <div class="col-md-12">
												{!! Form::label('event_id', 'Pilih Event:') !!}
												{!! Form::select('event_id', $event,null, ['class' => 'form-control', 'id' => 'event_id', 'placeholder' => 'Pilih Event']); !!}
										</div>

										<div class="col-md-10">
                        <div class="form-group">
                            <div class="form-line">
                            		{!! Form::label('nama', 'Nama Dapil:') !!}
                                {{ Form::text('nama',null, ['class' => 'form-control','placeholder' => 'Isi Nama Event Dengan Lengkap']) }}
                            </div>
                        </div>
                    </div>
										<div class="col-md-10">
											<select class="form-control show-tick" name="tahun" id="tahun" placeholder="Pilih Tahun" >
													<option value=''>Pilih Tahun</option><option value='2017'>2017</option>
													<option value='2018'>2018</option><option value='2019'>2019</option>
													<option value='2020'>2020</option><option value='2021'>2021</option>
													<option value='2022'>2022</option><option value='2023'>2023</option>
													<option value='2024'>2024</option><option value='2025'>2025</option>
													<option value='2026'>2026</option><option value='2027'>2027</option>
													<option value='2028'>2028</option><option value='2029'>2029</option>
													<option value='2030'>2030</option>
											</select>
										</div>



                    <!-- END Content Create-->

                    <!-- Modal -->
        <div class="modal-footer">
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
            <a href="{{ route('tabulasi.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Tabulasi</a>
        </div>
        {!! Form::close() !!}
</div>
</div>
@endsection
@section('extra-script')
<script src="{{ asset('bsbmd/js/pages/tables/mindmup-editabletable.js') }}"></script>
<script src="{{ asset('bsbmd/js/pages/tables/editable-table.js') }}"></script>
<script src="{{ asset('bsbmd/js/pages/tables/numeric-input-example.js') }}"></script>
<script src="{{ asset('js/taginput/jquery.dropdown.js') }}"></script>
<script src="{{ asset('js/taginput/jquery.dropdown.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-browser/0.1.0/jquery.browser.min.js"></script>
<script type="text/javascript" src="https://cloud.github.com/downloads/digitalBush/jquery.maskedinput/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-browser/0.1.0/jquery.browser.min.js"></script>
<script type="text/javascript" src="https://cloud.github.com/downloads/digitalBush/jquery.maskedinput/jquery.maskedinput-1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready( function() {
        // select2

        var _url = '{{ route('tabulasi.ajax') }}';

        $(document).on('change','#provinsi_id',function(){
            var _val = $(this).val();
            $.get(_url,{'type':'get-city','provinsi_id':_val})
            .done(function(result) {
                var html = '';
                $('#kota_kabupaten_id').selectpicker(html);

                $.each(result,function(key,value){
                    html += '<option value="'+key+'">'+value+'</option>';
                });

                $('#kota_kabupaten_id').html(html);
                $('#kota_kabupaten_id').selectpicker('refresh');
            });
        });

	        $(document).on('change','#kota_kabupaten_id',function(){

	            var coba = $(this).val();
	            $.get(_url,{'type':'get-kecamatan','kota_kabupaten_id':coba})
	            .done(function(result) {
	                var html = '';
                    $('#kecamatan_id').selectpicker(html);
	                $.each(result,function(key,value){
	                    html += '<option value="'+key+'">'+value+'</option>';
	                });

	                $('#kecamatan_id').html(html);
                    $('#kecamatan_id').selectpicker('refresh');

	            });
	        });

	        $(document).on('change','#kecamatan_id',function(){

	            var coba = $(this).val();
	            $.get(_url,{'type':'get-kelurahan','kecamatan_id':coba})
	            .done(function(result) {
	                var html = '';
                    $('#kelurahan_id').selectpicker(html);
	                $.each(result,function(key,value){
	                    html += '<option value="'+key+'">'+value+'</option>';
	                });

	                $('#kelurahan_id').html(html);
	                $('#kelurahan_id').selectpicker('refresh');
	            });
	        });
	    });
</script>
<script type="text/javascript">
$('#tahun').dropdown({

// read only
readOnly: false,

multipleMode: 'label',


// the maximum number of options allowed to be selected
limitCount: Infinity,

// search field
input: '<input type="text" maxLength="20" placeholder="Search">',

// dynamic data here
data: [],

// is search able?
searchable: true,

// when there's no result
searchNoData: '<li style="color:#ddd">No Results</li>',

// callback
choice: function () {}

var Random = Mock.Random;
var json1 = Mock.mock({
	"data|10-50": [{
		name: function () {
			return Random.name(true)
		},
		"id|+1": 1,
		"disabled|1-2": true,
		groupName: 'Group Name',
		"groupId|1-4": 1,
		"selected": false
	}]
});

$('.dropdown-mul-1').dropdown({
	data: json1.data,
	limitCount: 40,
	multipleMode: 'label',
	choice: function () {
		// console.log(arguments,this);
	}
});

var json2 = Mock.mock({
	"data|10000-10000": [{
		name: function () {
			return Random.name(true)
		},
		"id|+1": 1,
		"disabled": false,
		groupName: 'Group Name',
		"groupId|1-4": 1,
		"selected": false
	}]
});

$('.dropdown-mul-2').dropdown({
	limitCount: 5,
	searchable: false
});

$('.dropdown-sin-1').dropdown({
	readOnly: true,
	input: '<input type="text" maxLength="20" placeholder="Search">'
});

$('.dropdown-sin-2').dropdown({
	data: json2.data,
	input: '<input type="text" maxLength="20" placeholder="Search">'
});
});
</script>

@endsection

</div>
</div>
