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
					EDIT DATA DAPIL (Daerah Pemilihan)
				</h2>
			</div>

			<div class="box box-primary">

				<div class="box-body">
					<div class="row">
						<div class="body">
							<div class="row clearfix">
								{!! Form::model($dapil, ['route' => ['datamaster.dapil.update', $dapil->id], 'method' => 'patch']) !!}

								@include('layouts.data_master.dapil.edit_fields')

								{!! Form::close() !!}



							</div>
						</div>
					</div>


				</div>
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
					$('#data').val({{ $currentDataList }});
					$('#data').selectpicker('refresh');
				});
			}

			getData({{ $dapil->event_id }},_url);
		});
	</script>
	@endsection
