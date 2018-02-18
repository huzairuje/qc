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
                    EDIT DATA ADMIN KECAMATAN
                </h2>
            </div>
            @include('flash::message')

            <div class="box box-primary">

                <div class="box-body">
                    <div class="container">
                        <div class="body">
                            <div class="row clearfix">
                                {!! Form::model($user, ['route' => ['monitoring.dataadminkecamatan.update', $user->id], 'files' => 'true' ,'method' => 'patch']) !!}

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
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
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('provinsi_id', 'Pilih Provinsi:') !!}
                                                {!! Form::select('provinsi_id', $provinsi,null, ['class' => 'form-control','id' => 'provinsi_id','placeholder' => 'Select Provinsi']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('kota_id', 'Pilih Kota/Kab:') !!}
                                                {{ Form::select('kota_id', $kota,null, ['class' => 'form-control','id' => 'kota_id','placeholder' => 'Select Kota/Kabupaten']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-line">
                                                {!! Form::label('kecamatan_id', 'Pilih Kecamatan:') !!}
                                                {{ Form::select('kecamatan_id', $kecamatan,null, ['class' => 'form-control','id' => 'kecamatan_id','placeholder' => 'Select Kecamatan']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                {!! Form::label('nama', 'Nama:') !!}
                                                {{ Form::text('first_name',null, ['class' => 'form-control','placeholder' => 'Nama']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                {!! Form::label('email', 'Email:') !!}
                                                {{ Form::text('email',null, ['class' => 'form-control','placeholder' => 'Email']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                {!! Form::label('email', 'Username:') !!}
                                                {{ Form::text('username',null, ['class' => 'form-control','placeholder' => 'Username']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                {!! Form::label('phone', 'Nomor Handphone:') !!}
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => '+62']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                {!! Form::label('alamat', 'Alamat:') !!}
                                                {{ Form::text('alamat', $data_kecamatan->alamat,null, ['class' => 'form-control','placeholder' => 'Isi Alamat']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-line">
                                                {!! Form::label('foto', 'Foto:') !!}
                                                {{ Form::text('foto', $data_kecamatan->foto,null, ['class' => 'form-control','placeholder' => 'pilih foto saksi']) }}
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

        var _url = '{{ route('monitoring.datasaksi.ajax') }}';
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
            
        });
</script>

@endsection
