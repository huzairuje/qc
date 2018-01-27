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
                            {!! Form::select('dokumen', ['C1' => 'C1', 'C2' => 'C2', 'C3' => 'C3', 'C3' => 'C3', 'C4' => 'C4'], null, ['class' => 'form-control show-tick'], ['placeholder' => 'Pilih Jenis Dokumen']); !!}

                    </div>

										<div class="col-md-12">
											{!! Form::select('event_id', $event,null, ['class' => 'form-control','id' => 'event_id','placeholder' => '']) !!}
										</div>

                    <div class="col-md-6">
                           {!! Form::select('provinsi_id', $provinsi,null, ['class' => 'form-control','id' => 'provinsi_id','placeholder' => 'Select Provinsi']) !!}
                    </div>

                    <div class="col-md-6">
                                {{ Form::select('kota_id', $kota,null, ['class' => 'form-control','id' => 'kota_id','placeholder' => 'Select Kota/Kabupaten']) }}
                    </div>

                    <div class="col-md-6">
                                {{ Form::select('kecamatan_id', $kecamatan,null, ['class' => 'form-control','id' => 'kecamatan_id','placeholder' => 'Select Kecamatan']) }}
                    </div>


                    <div class="col-md-6">
                                {{ Form::select('kelurahan_id', $kelurahan,null, ['class' => 'form-control','id' => 'kelurahan_id','placeholder' => 'Select Kelurahan']) }}
                    </div>

                    <div class="col-md-12 result" style="display:none;">

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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-browser/0.1.0/jquery.browser.min.js"></script>
<!-- <script type="text/javascript" src="https://cloud.github.com/downloads/digitalBush/jquery.maskedinput/jquery.maskedinput-1.3.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-browser/0.1.0/jquery.browser.min.js"></script>
<!-- <script type="text/javascript" src="https://cloud.github.com/downloads/digitalBush/jquery.maskedinput/jquery.maskedinput-1.3.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready( function() {
        // select2

        var _url = '{{ route('datamaster.TPS.ajax') }}';
				var _url_new = '{{ route('tabulasi.ajax') }}';

        $(document).on('change','#provinsi_id',function(){
            var _val = $(this).val();
            $.get(_url,{'type':'get-city','provinsi_id':_val})
            .done(function(result) {
                var html = '';
                $('#kota_id').selectpicker(html);

                $.each(result,function(key,value){
                    html += '<option value="'+key+'">'+value+'</option>';
                });

                $('#kota_id').html(html);
                $('#kota_id').selectpicker('refresh');
            });
        });



	        $(document).on('change','#kota_id',function(){


	            var coba = $(this).val();
	            $.get(_url,{'type':'get-kecamatan','kota_id':coba})
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

									var kelurahan = $('#kelurahan_id').val();
									var event_id = $('#event_id').val();
                  // get tps
									$.get(_url_new,{'type':'get-tps-calon','kelurahan_id':kelurahan,'event_id':event_id})
			            .done(function(result_tps) {
										if (result_tps.status) {
											$('.result').html(result_tps.html);
											$('.result').show();
										}else {
											$('.result').hide();
										}
									});
	            });
	        });

					$(document).on('change','#kelurahan_id',function(){
						var kelurahan = $(this).val();
						var event_id = $('#event_id').val();
						// get tps
						$.get(_url_new,{'type':'get-tps-calon','kelurahan_id':kelurahan,'event_id':event_id})
						.done(function(result_tps) {
							if (result_tps.status) {
								$('.result').html(result_tps.html);
								$('.result').show();
							}else {
								$('.result').hide();
							}
						});
					});
	    });
</script>


@endsection

</div>
</div>
