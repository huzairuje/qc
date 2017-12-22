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
                        BUAT DATA TABULASI
                    </h2>
                </div>

                <div class="box box-primary">

		            <div class="box-body">
		                <div class="row">
        <div class="body">
            <div class="row clearfix">
                <!-- Content Create-->
                {!! Form::model($partai, ['route' => ['datamaster.partai.update', $partai->id], 'method' => 'patch','files' => true]) !!}


                    <div class="col-md-4">
                        <div class="form-line">
                            {!! Form::label('nomor', 'Nomor Urut Partai :') !!}
                            {{ Form::number('nomor',null, ['class' => 'form-control','placeholder' => 'Isi Nomor TPS']) }}
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-line">
                            {!! Form::label('nama', 'Nama Partai :') !!}
                            {{ Form::text('nama',null, ['class' => 'form-control','placeholder' => 'Isi Nomor TPS']) }}
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-line">
                            {!! Form::label('foto', 'Foto Partai :') !!}
                            {{ Form::file('foto',null, ['class' => 'form-control','placeholder' => 'Isi Nomor TPS']) }}
                        </div>

                    </div>


                    <!-- END Content Create-->

                    <!-- Modal -->
        <div class="modal-footer">
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
            <a href="{{ route('datamaster.TPS.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index TPS</a>
        </div>
        {!! Form::close() !!}
</div>
</div>
@endsection
@section('extra-script')
<script src="{{ asset('bsbmd/js/pages/tables/mindmup-editabletable.js') }}"></script>
<script src="{{ asset('bsbmd/js/pages/tables/editable-table.js') }}"></script>
<script src="{{ asset('bsbmd/js/pages/tables/numeric-input-example.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-browser/0.1.0/jquery.browser.min.js"></script>
<script type="text/javascript" src="https://cloud.github.com/downloads/digitalBush/jquery.maskedinput/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-browser/0.1.0/jquery.browser.min.js"></script>
<script type="text/javascript" src="https://cloud.github.com/downloads/digitalBush/jquery.maskedinput/jquery.maskedinput-1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

@endsection

</div>
</div>
