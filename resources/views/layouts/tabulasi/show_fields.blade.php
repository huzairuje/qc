<div class="body">
    <div class="row clearfix">

<!-- Dokumen Field -->
<div class="form-group">
    {!! Form::label('dokumen_id', 'Dokumen :') !!}
    <p>{!! $tabulasi->dokumen_id !!}</p>
</div>

<div class="form-group">
    {!! Form::label('provinsi_id', 'Provinsi :') !!}
    <p>{!! $tabulasi->dokumen_id !!}</p>
</div>

<div class="form-group">
    {!! Form::label('kota_kabupaten_id', 'Kota/Kabupaten :') !!}
    <p>{!! $tabulasi->kota_kabupaten_id !!}</p>
</div>

<div class="form-group">
    {!! Form::label('kecamatan_id', 'Kecamatan :') !!}
    <p>{!! $tabulasi->kecamatan_id !!}</p>
</div>

<div class="form-group col-sm-12">
    <a href="{!! route('tabulasi.create') !!}" class="btn btn-default">Kembali</a>
</div>    
    </div>
</div>

