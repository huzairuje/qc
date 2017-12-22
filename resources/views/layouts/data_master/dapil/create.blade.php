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

								<div class="col-md-10">
									<div class="form-group">

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
											<select id="data" name="data[]" class="ui fluid search dropdown form-control show-tick" multiple>

											</select>
										</div>



										<!-- END Content Create-->

										<!-- Modal -->
										<div class="modal-footer">
											{!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
											<a href="{{ route('datamaster.dapil.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Dapil</a>
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
									$('#data').dropdown();

									var _url = '{{ route('datamaster.dapil.ajax') }}';

									$(document).on('change','#event_id',function(){
										var _val = $(this).val();
										getData(_val,_url);
									});

									function getData(val,url)
									{
										$.get(url,{'type':'get-data','event_id':val})
										.done(function(result) {
											var html = '';
											$('#data').selectpicker(html);

											$.each(result,function(key,value){
												html += '<option value="'+key+'">'+value+'</option>';
											});

											$('#data').html(html);
											$('#data').selectpicker('refresh');
										});
									}
								});
								</script>

								@endsection

							</div>
						</div>
