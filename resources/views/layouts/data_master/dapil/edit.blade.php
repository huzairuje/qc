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
				getData(_val,_url,null);
			});

			getData({{ $dapil->event_id }},_url,'{!! $currentDataList !!}');

			function getData(val,url,dataList=null)
			{
				$.get(url,{'type':'get-data','event_id':val})
				.done(function(result) {
					console.log(result)
					var html = '';
					var checked = '';

					if(dataList == null){
						if (result.jenis === 'select_all') {
							checked = 'checked';
						}

						$.each(result.data,function(key,value){
							html += '<div class="col-md-4 dapil-checkboxes">'+
									'<p><input type="checkbox"  name="data[]" value="'+key+'" class="filled-in"'+checked+'/>'+
									'<label for="filled-in-box">'+value+'</label></p>'+
									'</div>';
											
						});
					}else{
						selected = JSON.parse(dataList);	
						console.log(selected)
						console.log(result.data)
						$.each(result.data,function(key,value){
							var checked = '';
							$.each(selected,function(objk,prop){
								if (prop == key) {
									checked = 'checked';
								}
							});
							html += '<div class="col-md-4 dapil-checkboxes">'+
									'<p><input type="checkbox"  name="data[]" value="'+key+'" class="filled-in"'+checked+'/>'+
									'<label for="filled-in-box">'+value+'</label></p>'+
									'</div>';
						});
					}


					$("#dapil").html(html);
				});
			}
		});

		$(document).on("click", ".dapil-checkboxes", function() {
			var checkbox = $(this).find("input");
			var checked = checkbox.attr('checked');
			if (checkbox.is(":checked")) {
				checkbox.removeAttr("checked");
			} else {
				checkbox.prop("checked", true);
			}
		});

	</script>
	@endsection
