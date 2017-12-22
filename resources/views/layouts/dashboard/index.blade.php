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
		<div class="body bg-light-blue">
			<ul>
				@foreach($events as $event)
				<li>
					{{ $event->nama . ' ' . $event->tahun }}
					<ul>
						@foreach($event->dapil as $dapil)
						<li>
							{{ $dapil->nama }}
							<ul>
								@foreach($dapil->dapil_lokasi as $lokasi)
								<li>
									{{ $lokasi->lokasi->nama }}
									@if(isset($lokasi->lokasi->kelurahan))
									<ul>
										@foreach($lokasi->lokasi->kelurahan as $kelurahan)
										<li>
											{{ $kelurahan->nama }}
											<ul>
												@foreach($kelurahan->tps as $tps)
												<li>
													{{ $tps->id }}
													{{ $tps->kelurahan->nama }}
													<ul>
														@foreach($tps->suara as $suara)
														<li>
															{{ $suara->calon->nama }}
															{{ $suara->jumlah }}
														</li>
														@endforeach
													</ul>
												</li>
												@endforeach
											</ul>
										</li>
										@endforeach
									</ul>
									@elseif(isset($lokasi->lokasi->kecamatan))
									<ul>
										@foreach($lokasi->lokasi->kecamatan as $kecamatan)
										<li>
											{{ $kecamatan->nama }}
											<ul>
												@foreach($kecamatan->kelurahan as $kelurahan)
												<li>
													{{ $kelurahan->nama }}
													<ul>
														@foreach($kelurahan->tps as $tps)
														<li>
															{{ $tps->id }}
															<ul>
																@foreach($tps->suara as $suara)
																<li>
																	{{ $suara->calon->nama }}
																	{{ $suara->jumlah }}
																</li>
																@endforeach
															</ul>
														</li>
														@endforeach
													</ul>
												</li>
												@endforeach
											</ul>
										</li>
										@endforeach
									</ul>
									@elseif(isset($lokasi->lokasi->kota))
									<ul>
										@foreach($lokasi->lokasi->kota as $kota)
										<li>
											{{ $kota->nama }}
											<ul>
												@foreach($kota->kecamatan as $kecamatan)
												<li>
													{{ $kecamatan->nama }}
													<ul>
														@foreach($kecamatan->kelurahan as $kelurahan)
														<li>
															{{ $kelurahan->nama }}
															@if(count($kelurahan->tps) > 0)
															<ul>
																@foreach($kelurahan->tps as $tps)
																<li>
																	Tps : {{ $tps->id }}
																	<ul>
																		@foreach($tps->suara as $suara)
																		<li>
																			{{ $suara->calon->nama }}
																			{{ $suara->jumlah }}
																		</li>
																		@endforeach
																	</ul>
																</li>
																@endforeach
															</ul>
															@endif
														</li>
														@endforeach
													</ul>
												</li>
												@endforeach
											</ul>
										</li>
										@endforeach
									</ul>
									@endif
								</li>
								@endforeach
							</ul>
							<p>calon</p>
							<ul>
								@foreach($dapil->calon as $calon)
								<li>
									{{ $calon->nama }}
									{{ $calon->suara->sum('jumlah') }}
									@if($calon->has_wakil)
									<ul>
										@foreach($calon->wakil as $wakil)
										<li>
											{{ $wakil->nama }}
										</li>
										@endforeach
									</ul>
									@endif
								</li>
								@endforeach
							</ul>
						</li>
						@endforeach
					</ul>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="card">
		<div class="header">
			<h2>
				Hasil Hitung TPS (Form C1) Provinsi Dki Jakarta</h2>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="material-icons">more_vert</i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li><a href="javascript:void(0);" class="waves-effect waves-block">Data Terbesar</a></li>
							<li><a href="javascript:void(0);" class="waves-effect waves-block">Data Terkecil</a></li>
							<li><a href="javascript:void(0);" class="waves-effect waves-block">Something else here</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="body">
				<div class="row clearfix">
					<div class="col-md-7">

					</div>

					<div class="col-md-5">
						Dashboard


					</div>
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


		<!-- CPU Usage -->
		<div class="row clearfix">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="body">
					</div>
				</div>
			</div>
		</div>
		<!-- #END# CPU Usage -->

	</div>
	@endsection

	@section('extra-script')
	{{Html::script('bsbmd/plugins/jquery-countto/jquery.countTo.js')}}
	{{Html::script('bsbmd/plugins/raphael/raphael.min.js')}}
	{{Html::script('bsbmd/plugins/morrisjs/morris.js')}}
	{{Html::script('bsbmd/plugins/chartjs/Chart.bundle.js')}}
	{{Html::script('bsbmd/plugins/flot-charts/jquery.flot.js')}}
	{{Html::script('bsbmd/plugins/flot-charts/jquery.flot.resize.js')}}
	{{Html::script('bsbmd/plugins/flot-charts/jquery.flot.pie.js')}}
	{{Html::script('bsbmd/plugins/flot-charts/jquery.flot.categories.js')}}
	{{Html::script('bsbmd/plugins/flot-charts/jquery.flot.time.js')}}
	{{Html::script('bsbmd/plugins/jquery-sparkline/jquery.sparkline.js')}}

	@endsection
