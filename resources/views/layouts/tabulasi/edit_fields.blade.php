<div class="body">
            <div class="row clearfix">
                <!-- Content Edit-->
                    <div class="col-md-12">
                            {!! Form::select('dokumen_id', ['C1' => 'C1', 'C2' => 'C2', 'C3' => 'C3', 'C3' => 'C3', 'C4' => 'C4'], null, ['class' => 'form-control show-tick'], ['placeholder' => 'Pilih Jenis Dokumen']); !!}
                    </div>
                    
                    <div class="col-md-12">
                        {!! Form::select('event_id', $event,null, ['class' => 'form-control','id' => 'event_id','placeholder' => '', 'disabled' => true]) !!}
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

                    <div class="col-md-12 temp">
                        @include('layouts.tabulasi.data', ['calon' => $calon, 'tps' => $tps, 'data_suara' => $data_suara])
                    </div>

                <!--    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                                <table id="data_suara" class="table table-bordered" style="cursor: pointer;">
                                    <thead>
                                      <tr class="bg-blue" style="color: white;">
                                        @for ($x = 1; $x <= 20; $x++)
                                            <th class="tg-yw4l">X{{ $x }}</th>
                                        @endfor
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @for ($y = 1; $y <= 20; $y++)
                                          <tr>
                                            @for ($x = 1; $x <= 20; $x++)
                                                <td class="tg-yw4l" tabindex="1">

                                                </td>
                                            @endfor
                                          </tr>
                                        @endfor

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div> -->


                    <!-- END Content Create-->

                    <!-- Modal -->
        <div class="modal-footer">
            {!! Form::submit('Update', ['class' => 'btn btn-primary waves-effect']) !!}
            <a href="{{ route('tabulasi.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Kembali</a>
        </div>
        {!! Form::close() !!}
</div>
</div>
@section('extra-script')
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
                                $('.temp').hide();
							}else {
								$('.result').hide();
							}
						});
					});
	    });
</script>
@endsection
