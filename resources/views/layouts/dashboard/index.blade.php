@extends('index')

@section('title')
Dashboard
@endsection

@section('extra-css')

@endsection

@section('content')
<div class="container-fluid">
	<div class="block-header">
		<h2>DASHBOARD</h2>
	</div>

	<div class="card">
		<div class="header">
			<h2>{!! Form::select('event_id', $event,null, ['class' => 'form-control','id' => 'event_id','placeholder' => '']) !!}</h2>

			</div>
			<div class="body">
				<div class="row clearfix">
					<div class="col-md-12">
							{!! $chart->render() !!}
					</div>
					<div class="col-md-12">
							{!! $chart->render() !!}
					</div>
					<div class="col-md-12">
							{!! $chart->render() !!}
					</div>


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


	@endsection
