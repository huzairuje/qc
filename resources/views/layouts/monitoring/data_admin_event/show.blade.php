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
                        SHOW DATA ADMIN EVENT
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
                                                {!! $data_event->first_name !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!! Form::label('last_login', 'Terakhir Login:') !!}
                                                {!! $data_event->last_login !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!! Form::label('phone', 'Nomor Telepon:') !!}
                                                {!! $data_event->phone !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!! Form::label('email', 'Email:') !!}
                                                {!! $data_event->email !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!! Form::label('foto', 'Foto:') !!}
                                                {!! $data_event->foto !!}
                                            </div>
                                        </div>
                                    </div>

                            <div class="modal-footer">
                                        <a href="{{ route('monitoring.dataadminevent.edit', $data_event->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Edit Data</a>
                                        <a href="{{ route('monitoring.dataadminevent.create')}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Create Data</a>
                                        <a href="{{ route('monitoring.dataadminevent')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Data Admin Provinsi </a>
                                        <a href="{{ route('monitoring.dataadminevent.delete', $data_event->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Delete Data</a>
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
