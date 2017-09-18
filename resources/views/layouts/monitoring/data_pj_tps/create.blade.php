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
                        BUAT DATA KORSAK
                    </h2>
                </div>
                
                <div class="box box-primary">

		            <div class="box-body">
		                <div class="row">
        <div class="body">
            <div class="row clearfix">
                <!-- Content Create-->
                {!! Form::open(['route' => 'monitoring.datasaksi.store']) !!}

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                                {!! Form::label('nama', 'Nama:') !!}
                                {{ Form::text('nama',null, ['class' => 'form-control','placeholder' => 'Isi Nama Lengkap']) }}   
                            </div> 						
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                                {!! Form::label('alamat', 'Alamat:') !!}
                                {!! Form::text('alamat', null, ['class' => 'form-control','placeholder' => 'Isi Alamat Lengkap']); !!}
                            </div>
                        </div>
                    </div>
        
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                                {!! Form::label('no_telpon', 'Nomor Telepon:') !!}
                                {{ Form::number('no_telpon', null, ['class' => 'form-control','placeholder' => 'Isi Nomor Telepon']) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                                {!! Form::label('email', 'Email:') !!}
                                {{ Form::email('email', null, ['class' => 'form-control','placeholder' => 'Isi Email']) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                                {!! Form::label('id_tps', 'Id TPS:') !!}
                                {{ Form::number('id_tps', null, ['class' => 'form-control', 'placeholder' => 'Isi ID TPS']) }}
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                                {!! Form::label('foto', 'Foto:') !!}
                                {{ Form::text('foto',null, ['class' => 'form-control','placeholder' => 'Foto Data Saksi']) }}
                            </div>    
                        </div>
                    </div>                    
                    
                    <!-- END Content Create-->

                    <!-- Modal -->
        <div class="modal-footer">
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
            <a href="{{ route('monitoring.datasaksi')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Data Saksi</a>
        </div>
        {!! Form::close() !!}
</div>
</div>
@endsection
@section('extra-script')

    

@endsection

</div>
</div>