<div class="body">
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-line">
                    {!! Form::label('tipe', 'Tipe:') !!}
                    <select id="tipe" name="tipe" class="form-control show-tick">
                        <option value="0">Partai</option>
                        <option value="1">Angota</option>
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

    <div class="form-group nama-form-container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-line">
                    {!! Form::label('nama', 'Nama:') !!}
                    {{ Form::text('nama',null, ['class' => 'form-control','placeholder' => 'Nama']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="form-group nama-form-container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-line">
                    {!! Form::label('nomor', 'Nomor Urut:') !!}
                    {{ Form::text('nomor',null, ['class' => 'form-control','placeholder' => 'Nomor Urut']) }}
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
                    {!! Form::label('event', 'Pilih Event:') !!}
                    <br />
                    <select id="event_id" name="event" class="forrm-control show-tick">
                        <option value="">Pilih Event</option>
                        @foreach($listEvent as $event)
                        <option value="{{ $event->id }}">{{ $event->nama }}</option>
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
                    {!! Form::label('dapil_id', 'Pilih Dapil:') !!}
                    {{ Form::select('dapil_id', $dapil, ['class' => 'form-control','id' => 'dapil','placeholder' => 'Pilih Dapil']) }}
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

    <div class="modal-footer">
        {!! Form::submit('Update', ['class' => 'btn btn-primary waves-effect']) !!}
        <a href="{{ route('datamaster.calon.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Kembali</a>
    </div>
</div>
