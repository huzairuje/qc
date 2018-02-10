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
                        ABSENSI
                    </h2>
                </div>
                @include('flash::message')
                {!! Form::open(['route' => 'absensi.saksi.create']) !!}
                <div class="box box-primary">
                    <div class="box-body">

                        <div class="row">
                            <div class="body">
                                <div class="col-md-9">
									<div class="form-group">
										<div class="form-line">
											{!! Form::label('first_name', 'Nama:') !!}
											{{ Form::text('first_name', $user->first_name.' '.$user->last_name , ['class' => 'form-control', 'readonly' => true]) }}
										</div>
									</div>
								</div>
                                <div class="switch col-sm-6">
                                    <label> Tidak Hadir
                                        {!! Form::checkbox( 'status', true, null,['checked']) !!}
                                    <span class="lever"></span>
                                    Hadir
                                    </label>
                                </div>
                                <div class="col-md-9">
									<div class="form-group">
										<div class="form-line">
											{!! Form::label('user_replacment_id', 'Pengganti Saksi:') !!} <i>Pilih Pengganti Saksi jika Saksi Terkait Berhalangan hadir </i>
                                            {!! Form::select('user_replacment_id', $data_saksi,null, ['class' => 'form-control', 'placeholder' => 'Pilih Pengganti Saksi']) !!}
										</div>
									</div>
								</div>
                                <div class="col-md-9">
									<div class="form-group">
										<div class="form-line">
											{!! Form::label('alasan', 'Alasan:') !!}
											<textarea rows="4" class="form-control no-resize" name="alasan" placeholder=""></textarea>
										</div>
									</div>
								</div>
                                <div class="col-sm-12">
                                @if($absensi)
								{!! Form::submit('ABSEN', ['class' => 'btn btn-primary waves-effect']) !!}
                                @else
                                <p> <i> Anda telah melakukan absensi pada hari ini. </i> </p>
                                @endif
                                </div>
                                

                               
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection

@section('extra-script')

@endsection
