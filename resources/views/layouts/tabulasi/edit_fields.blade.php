<div class="body">
            <div class="row clearfix">
                <!-- Content Edit-->
                    <div class="col-md-12">
                            {!! Form::select('dokumen_id', ['C1' => 'C1', 'C2' => 'C2', 'C3' => 'C3', 'C3' => 'C3', 'C4' => 'C4'], null, ['class' => 'form-control show-tick'], ['placeholder' => 'Pilih Jenis Dokumen']); !!}
                    </div>
                    
                    <div class="col-md-12">
                        {!! Form::select('event_id', $event,null, ['class' => 'form-control','id' => 'event_id','placeholder' => '', 'disabled' => true]) !!}
                        {{ Form::hidden('event_id',$tabulasi->event->id, ['class' => 'form-control','placeholder' => 'Nama']) }}
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

                    <div class="col-md-12 images-table">
                        <div class="form-group">
                            <div class="form-line" style="overflow-x: scroll;">
                                <table id="data_suara" class="table table-bordered" style="cursor: pointer;">
                                    <thead>
                                      <tr class="bg-blue" style="color: white;">
                                        <th class="tg-yw4l">TPS</th>
                                        @for($i = 1;$i <= 22; $i++)
                                          <th class="tg-yw4l">{{$i}}</th>
                                        @endfor
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tps_all as $data)
                                            <tr class="tg-yw4l">
                                              <td>{{ $data->nomor }}</td>
                                              @for($i = 1;$i <= 22; $i++)
                                                <td>
                                                    @php
                                                        $saved = $data->images()->where('event_id', '=', $tabulasi->event_id)->get();
                                                    @endphp
                                                  <i class="material-icons md-icon placeholder" style="color: {{ $saved->count() >= $i ? '#000000' : '#BDBDBD' }};">photo</i>
                                                  <input class="hidden upload" type="file" name="images[{{ $data->id }}][]">
                                                  @if (array_key_exists($i-1, $saved->toArray()))
                                                    <input type="hidden" name="old_images[{{$data->id}}][]" value="{{ $data->images()->get()[$i-1]['foto'] }}">
                                                  @endif
                                                </td>
                                              @endfor
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>


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

                    $('.hidden').hide();
                    $(document).on("click", ".placeholder", function() {
                        $(this).next().click();
                    });

                    $(document).on("change", ".upload", function(){
                        $(this).prev().css("color", "black");
                        $(this).next().remove();
                    });
	    });
</script>
@endsection
