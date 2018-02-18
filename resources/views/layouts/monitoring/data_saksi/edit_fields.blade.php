<div class="form-group">
    <div class="row">
        <div class="col-md-8">
            <div class="form-line">
                {!! Form::label('user_event', 'Pilih Event Saksi:') !!}
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
                {!! Form::label('provinsi_id', 'Pilih Provinsi Saksi:') !!}
                {!! Form::select('provinsi_id', $provinsi,null, ['class' => 'form-control','id' => 'provinsi_id','placeholder' => 'Select Provinsi']) !!}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-8">
            <div class="form-line">
                {!! Form::label('kota_id', 'Pilih Kota/Kab Saksi:') !!}
                {{ Form::select('kota_id', $kota,null, ['class' => 'form-control','id' => 'kota_id','placeholder' => 'Select Kota/Kabupaten']) }}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-8">
            <div class="form-line">
                {!! Form::label('kecamatan_id', 'Pilih Kecamatan Saksi:') !!}
                {{ Form::select('kecamatan_id', $kecamatan,null, ['class' => 'form-control','id' => 'kecamatan_id','placeholder' => 'Select Kecamatan']) }}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-8">
            <div class="form-line">
                {!! Form::label('kelurahan_id', 'Pilih Kelurahan Saksi:') !!}
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
                {!! Form::label('alamat', 'Alamat Saksi:') !!}
                {{ Form::text('alamat', $saksi_tps->alamat,null, ['class' => 'form-control','placeholder' => 'Isi Alamat']) }}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <div class="form-line">
                {!! Form::label('foto', 'Foto Saksi:') !!}
                {{ Form::text('foto', $saksi_tps->foto,null, ['class' => 'form-control','placeholder' => 'pilih foto saksi']) }}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
    </div>
</div>
