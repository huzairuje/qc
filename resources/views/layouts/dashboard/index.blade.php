@extends('index')

@section('title')
Dashboard
@endsection

@section('extra-css')
{!! Charts::assets() !!}
@endsection

@section('content')
<div class="container-fluid">
	<div class="block-header">
		<h2>DASHBOARD</h2>
	</div>

	<div class="card">
		<div class="header">
			<h2>
				<select id="event_id" class="form-control">
					@foreach ($event as $key => $ev)
					<option value="{!! $key !!}" data>{!! $ev !!}</option>
					@endforeach
				</select>
			</h2>

			</div>
			<div class="body">
				<div class="row clearfix">
					<div class="col-md-12 panel-body">
	                   <canvas id="canvas" height="280" width="600">
	                   	
	                   </canvas>



				</div>
			</div>

			<div class="card">
				<div class="header">
					<h2>
						Pemilih dan pengguna hak pilih<i class="material-icons">supervisor_account</i>
					</h2>
				</div>
				<div class="body">
					<div class="row clearfix">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-hover dashboard-task-infos">
									<thead>
										<tr>
											<th></th>
											<th>Laki-Laki</th>
											<th>Perempuan</th>
											<th>Total</th>

										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>Pemilih</b></td>
											<td>3.500.400</td>
											<td>4.500.032</td>
											<td>8.000.432</td>

										</tr>
										<tr>
											<td><b>Pengguna Hak Pilih</b></td>
											<td>Pasangan B</td>
											<td><span class="label bg-blue">To Do</span></td>
											<td>John Doe</td>
										</tr>
										<tr>
											<td><b>Partisipasi</b></td>
											<td>Pasangan C</td>
											<td><span class="label bg-light-blue">On Hold</span></td>
											<td>John Doe</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>




		<!-- CPU Usage -->

		<!-- #END# CPU Usage -->

	</div>
	@endsection

	@section('extra-script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
    
    <script type="text/javascript">
    $(document).ready(function(){
    	var event_id = $("#event_id").val();
    	ajaxChart(event_id);
    });

    $(document).on("change", "#event_id", function(){
    	var event_id = $("#event_id").val();
    	ajaxChart(event_id);
	});

	function ajaxChart(event_id = null){
		$.ajax({
			url: "{{ route('dashboard.ajax') }}",
			type: "POST",
			data:{
				"_token": "{{ csrf_token() }}",
				'event_id': event_id
			},
			success: function(data) {
				var calon_nama = [];
				var jumlah_suara = [];
				var event_nama = [];

				for(var i in data) {
					calon_nama.push(data[i].calon_nama);
					jumlah_suara.push(data[i].jumlah_suara);
				}
					event_nama.push(data[i].event_nama);

				var chartdata = {
					labels: calon_nama,
					datasets : [
						{
							label: event_nama,
							backgroundColor: 'rgba(200, 200, 200, 0.75)',
							borderColor: 'rgba(200, 200, 200, 0.75)',
							hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
							hoverBorderColor: 'rgba(200, 200, 200, 1)',
							data: jumlah_suara
						}
					]
				};

				var ctx = $("#canvas");

				var barGraph = new Chart(ctx, {
					type: 'bar',
					data: chartdata
				});
			},
			error: function(data) {
				console.log(data);
			}
		});
	}
</script>

	@endsection
