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
                    BUAT DATA ADMIN EVENT
                </h2>
            </div>

            <div class="box box-primary">

                <div class="box-body">
                    <div class="container">
                        <div class="body">
                            <div class="row clearfix">
                                {!! Form::open(['route' => 'monitoring.dataadminevent.store']) !!}

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-10">
                                            {!! Form::label('user_event', 'Pilih Event:') !!}
                                            <select class="form-control show-tick" name="event" id="tahun" placeholder="Role" >
                                                <option value=''>User Event</option>
                                                @foreach( $eventList as $key => $val )
                                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('nama', 'Nama:') !!}
                                                {{ Form::text('first_name',null, ['class' => 'form-control','placeholder' => 'Nama']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('email', 'Email:') !!}
                                                {{ Form::text('email',null, ['class' => 'form-control','placeholder' => 'Email']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('username', 'Username:') !!}
                                                {{ Form::text('username',null, ['class' => 'form-control','placeholder' => 'Username']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('phone', 'Nomor Handphone:') !!}
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => '+62']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('alamat', 'Alamat :') !!}
                                                {{ Form::text('alamat',null, ['class' => 'form-control','placeholder' => 'isi Alamat Lengkap']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('foto', 'Foto:') !!}
                                                {{ Form::text('foto',null, ['class' => 'form-control','placeholder' => 'Pilih Foto']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
                                    </div>
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

@endsection
