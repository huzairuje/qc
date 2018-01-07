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
                        SHOW LOGIN TERAKHIR
                    </h2>
                </div>
                @include('flash::message')
                <div class="box box-primary">

                    <div class="box-body">

                        <div class="row">
                          <div class="body">
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="form-line">
                                              {!! Form::label('nama', 'Nama:') !!}
                                              {!! $loginterakhir->username !!}
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="form-line">
                                              {!! Form::label('email', 'Email:') !!}
                                              {!! $loginterakhir->email !!}
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="form-line">
                                              {!! Form::label('phone', 'Nomor Telepon:') !!}
                                              {!! $loginterakhir->phone !!}
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="form-line">
                                              {!! Form::label('loginterakhir', 'Login Terakhir :') !!}
                                              {!! $loginterakhir->last_login !!}
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="modal-footer">
                                  <a href="{{ route('monitoring.loginterakhir', $loginterakhir->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Kembali</a>
                                  <a href="{{ route('monitoring.loginterakhir', $loginterakhir->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Index Login Terakhir</a>
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
