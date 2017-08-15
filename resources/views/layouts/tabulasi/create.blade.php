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
                        BUAT DATA TABULASI
                    </h2>
                </div>
                
                <div class="box box-primary">

		            <div class="box-body">
		                <div class="row">
        <div class="body">
            <div class="row clearfix">
                <!-- Content Create-->
                {!! Form::open(['route' => 'tabulasi.store']) !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                            {!! Form::select('dokumen_id', ['C1' => 'C1', 'C2' => 'C2', 'C3' => 'C3', 'C3' => 'C3', 'C4' => 'C4'], null, ['class' => 'form-control'], ['placeholder' => 'Pilih Jenis Dokumen']); !!}
                            </div>
    						
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-line">
                                {{ Form::select('provinsi_id', $provinsi,null, ['class' => 'form-control select-zone','id' => 'provinsi_id','placeholder' => 'Select Provinsi']) }}
                            </div>
                        </div>
                    </div>
        
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-line">
                                {{ Form::select('kota_kabupaten_id', $kota_kabupaten,null, ['class' => 'form-control select-zone','id' => 'kota_kabupaten_id','placeholder' => 'Select Kota/Kabupaten']) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-line">
                                {{ Form::select('kecamatan_id', $kecamatan,null, ['class' => 'form-control select-zone','id' => 'kecamatan_id','placeholder' => 'Select Kecamatan']) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-line">
                                {{ Form::select('kelurahan_id', $kelurahan,null, ['class' => 'form-control select-zone','id' => 'kelurahan_id','placeholder' => 'Select Kelurahan']) }}
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- END Content Create-->

                    <!-- Modal -->
        <div class="modal-footer">
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<script type="text/javascript" src="https://cloud.github.com/downloads/digitalBush/jquery.maskedinput/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-browser/0.1.0/jquery.browser.min.js"></script>
<script type="text/javascript" src="https://cloud.github.com/downloads/digitalBush/jquery.maskedinput/jquery.maskedinput-1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready( function() {
        // select2
        $('.select-zone').select2();

        var _url = '{{ route('tabulasi.ajax') }}';
        $(document).on('change','#provinsi',function(){
            var _val = $(this).val();
            $.get(_url,{'type':'get-city','provinsi_id':_val})
            .done(function(result) {
                var html = '';
                $.each(result,function(key,value){
                    html += '<option value="'+key+'">'+value+'</option>';
                });

                $('#kota_kabupaten').html(html);
                $('#kota_kabupaten').select2("destroy").select2();
            });
        });

	        $(document).on('change','#kota_kabupaten',function(){

	            var coba = $(this).val();
	            $.get(_url,{'type':'get-kecamatan','kota_kabupaten_id':coba})
	            .done(function(result) {
	                var html = '';
	                $.each(result,function(key,value){
	                    html += '<option value="'+key+'">'+value+'</option>';
	                });

	                $('#kecamatan').html(html);
                    $('#kecamatan').select2("destroy").select2();
	                
	            });
	        });

	        $(document).on('change','#kecamatan_id',function(){

	            var coba = $(this).val();
	            $.get(_url,{'type':'get-kelurahan','kecamatan_id':coba})
	            .done(function(result) {
	                var html = '';
	                $.each(result,function(key,value){
	                    html += '<option value="'+key+'">'+value+'</option>';
	                });

	                $('#kelurahan').html(html);
                    $('#kelurahan').select2("destroy").select2();
	                
	            });
	        });
	    });
</script>
    

@endsection

</div>
</div>