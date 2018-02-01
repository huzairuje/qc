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
                    BUAT DATA KORSAK (KOORDINATOR SAKSI)
                </h2>
            </div>

            <div class="box box-primary">

                <div class="box-body">
                    <div class="container">
                        <div class="body">
                            <div class="row clearfix">
                                {!! Form::open(['route' => 'monitoring.datapjtps.store']) !!}

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-10">
                                            {!! Form::label('user_event', 'Pilih Event Korsak:') !!}
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
                                                {!! Form::label('provinsi_id', 'Pilih Provinsi Korsak:') !!}
                                                {!! Form::select('provinsi_id', $provinsi,null, ['class' => 'form-control','id' => 'provinsi_id','placeholder' => 'Select Provinsi']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('kota_id', 'Pilih Kota/Kab Korsak:') !!}
                                                {{ Form::select('kota_id', $kota,null, ['class' => 'form-control','id' => 'kota_id','placeholder' => 'Select Kota/Kabupaten']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('kecamatan_id', 'Pilih Kecamatan Korsak:') !!}
                                                {{ Form::select('kecamatan_id', $kecamatan,null, ['class' => 'form-control','id' => 'kecamatan_id','placeholder' => 'Select Kecamatan']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('kelurahan_id', 'Pilih Kelurahan Korsak:') !!}
                                                {{ Form::select('kelurahan_id', $kelurahan,null, ['class' => 'form-control','id' => 'kelurahan_id','placeholder' => 'Select Kelurahan']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('tps_id', 'Pilih Nomor TPS:') !!}
                                                {{ Form::select('tps_id', $tps,null, ['class' => 'form-control','id' => 'tps_id','placeholder' => 'Select TPS']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('nama', 'Nama Korsak:') !!}
                                                {{ Form::text('first_name',null, ['class' => 'form-control','placeholder' => 'Nama']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('email', 'Email Korsak:') !!}
                                                {{ Form::text('email',null, ['class' => 'form-control','placeholder' => 'Email']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('username', 'Username Korsak:') !!}
                                                {{ Form::text('username',null, ['class' => 'form-control','placeholder' => 'Username']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('phone', 'Nomor Handphone Korsak:') !!}
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => '+62']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('alamat', 'Alamat Korsak:') !!}
                                                {{ Form::text('alamat',null, ['class' => 'form-control','placeholder' => 'isi Alamat Lengkap']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('foto', 'Foto Korsak:') !!}
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
<script type="text/javascript">
    $(document).ready( function() {
        // select2

        var _url = '{{ route('monitoring.datapjtps.ajax') }}';
                // var _url_new = '{{ route('tabulasi.ajax') }}';

        $(document).on('change','#provinsi_id',function(){
            var _val = $(this).val();
            $.get(_url,{'type':'get-city','provinsi_id':_val})
            .done(function(result) {
                var html = '';
                $('#kota_id').selectpicker(html);

                $.each(result,function(key,value){
                    html += '<option value="'+key+'">'+value+'</option>';
                });

                $('#kota_id').html(html);
                $('#kota_id').selectpicker('refresh');
            });
        });



            $(document).on('change','#kota_id',function(){


                var coba = $(this).val();
                $.get(_url,{'type':'get-kecamatan','kota_id':coba})
                .done(function(result) {
                    var html = '';
                    $('#kecamatan_id').selectpicker(html);
                    $.each(result,function(key,value){
                        html += '<option value="'+key+'">'+value+'</option>';
                    });

                    $('#kecamatan_id').html(html);
                    $('#kecamatan_id').selectpicker('refresh');

                });
            });

            $(document).on('change','#kecamatan_id',function(){

                var coba = $(this).val();
                $.get(_url,{'type':'get-kelurahan','kecamatan_id':coba})
                .done(function(result) {
                    var html = '';
                    $('#kelurahan_id').selectpicker(html);
                    $.each(result,function(key,value){
                        html += '<option value="'+key+'">'+value+'</option>';
                    });

                    $('#kelurahan_id').html(html);
                    $('#kelurahan_id').selectpicker('refresh');
                });
            });

            $(document).on('change','#kelurahan_id',function(){

                var coba = $(this).val();
                $.get(_url,{'type':'get-tps','kelurahan_id':coba})
                .done(function(result) {
                    var html = '';
                    $('#tps_id').selectpicker(html);
                    $.each(result,function(key,value){
                        html += '<option value="'+key+'">'+value+'</option>';
                    });

                    $('#tps_id').html(html);
                    $('#tps_id').selectpicker('refresh');
                });
            });
            
        });
</script>

@endsection
