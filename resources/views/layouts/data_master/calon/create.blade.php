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
                    CREATE DATA CALON
                </h2>
            </div>

            <div class="box box-primary">

                <div class="box-body">
                    <div class="container">
                        <div class="body">
                            <div class="row clearfix">
                                {!! Form::open(['route' => 'datamaster.calon.store','files' => true]) !!}

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                {!! Form::label('nama', 'Nama:') !!}
                                                {{ Form::text('nama',null, ['class' => 'form-control','placeholder' => 'Nama']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                {!! Form::label('alamat', 'Alamat:') !!}
                                                {{ Form::text('alamat',null, ['class' => 'form-control','placeholder' => 'Alamat Lengkap']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                {!! Form::label('no_telpon', 'Nomor Telepon:') !!}
                                                {{ Form::number('no_telpon',null, ['class' => 'form-control','placeholder' => 'Nomor Telepon']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                {!! Form::label('email', 'Email :') !!}
                                                {{ Form::email('email',null, ['class' => 'form-control','placeholder' => 'example@example.com']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                <select id="dapil_id" name="dapil_id" class="forrm-control" placeholder="Pilih Dapil">
                                                    @foreach($listDapil as $dapil)
                                                    <option value="{{ $dapil->id }}">{{ $dapil->event->nama . ' ' . $dapil->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                {!! Form::select('partai_id', $partai,null, ['class' => 'form-control','id' => 'partai_id','placeholder' => 'Pilih Partai']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                {!! Form::label('foto', 'Foto :') !!}
                                                <div id="wrapper">
                                                    <style type="text/css">.thumb-image{float:left;width:200px;position:relative;padding:5px;}</style>
                                                    <div id="image-holder">
                                                    </div>
                                                    <br>
                                                    {!! Form::file('foto', null, ['class' => 'form-control']) !!}
                                                </div>
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

@endsection
