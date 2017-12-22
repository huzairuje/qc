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

								<div class="col-md-4">
									{!! Form::label('tahun', 'Tahun Event:') !!}
									<select class="form-control show-tick" name="tahun" id="tahun" placeholder="Pilih Jenis Event" >
										<option value=''>Pilih Tahun Event</option>
										<option value='2018'>2018</option>
										<option value='2019'>2019</option>
										<option value='2020'>2020</option>
										<option value='2021'>2021</option>
										<option value='2022'>2022</option>
										<option value='2023'>2023</option>
										<option value='2024'>2024</option>
										<option value='2025'>2025</option>
										<option value='2026'>2026</option>
										<option value='2027'>2027</option>
										<option value='2030'>2030</option>
										<option value='2031'>2031</option>
										<option value='2032'>2032</option>
										<option value='2033'>2033</option>
										<option value='2034'>2034</option>
										<option value='2035'>2035</option>
										<option value='2036'>2036</option>
										<option value='2037'>2037</option>
									</select>
								</div>
								<div class="col-md-9">
									<div class="form-group">
										<div class="form-line">
											{!! Form::label('expired', 'Tanggal Kadaluarsa Event:') !!}
											{{ Form::date('expired',null, ['class' => 'form-control','placeholder' => 'Isi Nama Event Dengan Lengkap']) }}
										</div>
									</div>
								</div>

								<div class="col-md-10">
									<div class="form-group">
										<div class="form-line">
											{!! Form::label('nama', 'Nama Event:') !!}
											{{ Form::text('nama',null, ['class' => 'form-control','placeholder' => 'Isi Nama Event Dengan Lengkap']) }}
										</div>
									</div>
								</div>

								<div class="col-md-8">
									{!! Form::select('jenis_id', $jenis,null, ['class' => 'form-control','id' => 'jenis','placeholder' => 'Pilih Jenis']) !!}
								</div>

								<div class="col-md-8 tingkat-form-container">
									{!! Form::select('tingkat_id', $tingkat,null, ['class' => 'form-control','id' => 'tingkat','placeholder' => 'Pilih Tingkat']) !!}
								</div>

								<div class="provinsi col-md-8 provinsi-form-container">
									{!! Form::select('provinsi', $provinsi,null, ['class' => 'form-control','id' => 'provinsi_id','placeholder' => 'Pilih Provinsi']) !!}
								</div>

								<div class="kabupaten col-md-8 kota-form-container">
									{{ Form::select('kota', $kota,null, ['class' => 'form-control','id' => 'kota_id','placeholder' => 'Pilih Kota/Kabupaten']) }}

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
						var _url = '{{ route('event.ajax') }}';

						$('.tingkat-form-container').hide();
						$('.provinsi-form-container').hide();
						$('.kota-form-container').hide();

						$(document).on('change','#jenis',function(){
							var _val = $(this).val();
							if(_val == 4 || _val == 5){
								$('.tingkat-form-container').show();
							}
							else {
								$('.tingkat-form-container').hide();
								$('.provinsi-form-container').hide();
								$('.kota-form-container').hide();
							}
						});

						$(document).on('change','#tingkat',function(){
							var _val = $(this).val();
							if(_val == 2){
								$('.provinsi-form-container').show();
								$('.kota-form-container').hide();
							}
							else if(_val == 3){
								$('.provinsi-form-container').show();
								$('.kota-form-container').show();
							}
							else {
								$('.provinsi-form-container').hide();
								$('.kota-form-container').hide();
							}
						});

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

					});
					</script>


					@endsection

				</div>
			</div>
