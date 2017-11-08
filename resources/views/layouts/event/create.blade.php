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
                        Create Event
                    </h2>
                </div>
                
                <div class="box box-primary">

		            <div class="box-body">
		                <div class="row">
        <div class="body">
            <div class="row clearfix">
                <!-- Content Create-->
                {!! Form::open(['route' => 'event.store']) !!}

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                            {!! Form::label('nama_event', 'Nama Event:') !!}
                                {{ Form::text('nama_event',null, ['class' => 'form-control','placeholder' => 'Isi Nama Event Dengan Lengkap']) }}	
                            </div>
                        </div>					
                    </div>
                    <div class="col-md-6">
                            {!! Form::select('tahun_event', ['2016' => '2016', '2017' => '2017', '2018' => '2018', '2019' => '2019', '2020' => '2020', '2021' => '2021', '2022' => '2022', '2023' => '2023', '2024' => '2024', '2025' => '2025', '2026' => '2026', '2027' => '2027', '2028' => '2028', '2029' => '2029', '2030' => '2030', ], null, ['class' => 'form-control show-tick'], ['placeholder' => 'Pilih Jenis Dokumen']); !!}                       
                    </div>
                    <div class="col-md-6">
                            {!! Form::select('jenis_event', ['PILKADA' => 'PILKADA  (Pemilihan Kepala Daerah)', 'PILEG' => 'PILEG  (Pemilihan Legislatif)', 'PILPRES ' => 'PILPRES (Pemilihan Presiden dan Wakil Presiden)'], null, ['class' => 'form-control show-tick'], ['placeholder' => 'Pilih Jenis Event']); !!}                       
                    </div>

                    <div class="col-md-6">

                           {!! Form::select('provinsi_id', $provinsi,null, ['class' => 'form-control','id' => 'provinsi_id','placeholder' => 'Select Provinsi']) !!}     
                    </div>
        
                    <div class="col-md-6">
                            {{ Form::select('kota_kabupaten_id', $kota_kabupaten,null, ['class' => 'form-control','id' => 'kota_kabupaten_id','placeholder' => 'Select Kota/Kabupaten']) }}
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-line">
                            {!! Form::label('dapil', 'Dapil:') !!}
                            {{ Form::text('dapil',null, ['class' => 'form-control','placeholder' => 'Isi Dapil']) }}
                            </div>
                        </div>    
                    </div>

        <div class="modal-footer">
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
            <a href="{{ route('event.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Event</a>
        </div>
        {!! Form::close() !!}
</div>
</div>
@endsection
@section('extra-script')
<script src="{{ asset('bsbmd/js/pages/tables/mindmup-editabletable.js') }}"></script>
<script src="{{ asset('bsbmd/js/pages/tables/editable-table.js') }}"></script>
<script src="{{ asset('bsbmd/js/pages/tables/numeric-input-example.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-browser/0.1.0/jquery.browser.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-browser/0.1.0/jquery.browser.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready( function() {
        // select2

        var _url = '{{ route('event.ajax') }}';

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
                    $('#dapil').selectpicker(html);
	                $.each(result,function(key,value){
	                    html += '<option value="'+key+'">'+value+'</option>';
	                });

	                $('#dapil').html(html);
                    $('#dapil').selectpicker('refresh');
	                
	            });
	        });

	    });
</script>
    

@endsection

</div>
</div>