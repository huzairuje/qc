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
                        SHOW DATA ADMIN KECAMATAN
                    </h2>
                </div>
                @include('flash::message')
                <div class="box box-primary">

                    <div class="box-body">

                        <div class="row">

                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!! Form::label('nama', 'Nama:') !!}
                                                {!! $data_kecamatan->first_name !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!! Form::label('last_login', 'Terakhir Login:') !!}
                                                {!! $data_kecamatan->last_login !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!! Form::label('phone', 'Nomor Telepon:') !!}
                                                {!! $data_kecamatan->phone !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!! Form::label('email', 'Email:') !!}
                                                {!! $data_kecamatan->email !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!! Form::label('foto', 'Foto:') !!}
                                                {!! $data_kecamatan->foto !!}
                                            </div>
                                        </div>
                                    </div>

                            <div class="modal-footer">
                                        <a href="{{ route('monitoring.dataadminkecamatan.edit', $data_kecamatan->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Edit Data</a>
                                        <a href="{{ route('monitoring.dataadminkecamatan.create')}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Create Data</a>
                                        <a href="{{ route('monitoring.dataadminkecamatan')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Data Admin Kecamatan </a>
                                        <a href="{{ route('monitoring.dataadminkecamatan.delete', $data_kecamatan->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Delete Data</a>
                                    </div>
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

@endsection
