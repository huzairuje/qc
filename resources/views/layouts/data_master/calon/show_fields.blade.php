<div class="body">
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-line">
                    {!! Form::label('nama', 'Nama:') !!}
                    {!! $calon->nama !!}
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-line">
                    {!! Form::label('alamat', 'Alamat:') !!}
                    {!! $calon->alamat !!}
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-line">
                    {!! Form::label('no_telpon', 'Nomor Telepon:') !!}
                    {!! $calon->no_telpon !!}
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-line">
                    {!! Form::label('email', 'Email :') !!}
                    {!! $calon->email !!}
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-line">
                    {!! Form::label('event_id', 'Event :') !!}
                    {!! $calon->dapil->event->nama !!}
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-line">
                    {!! Form::label('foto', 'Foto :') !!}
                    {!! $calon->foto !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <a href="{{ route('datamaster.calon.edit', $calon->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Edit Data</a>
        <a href="{{ route('datamaster.calon.create')}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Create Data</a>
        <a href="{{ route('datamaster.calon.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Calon</a>
        <a href="{{ route('datamaster.calon.delete', $calon->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Delete Data</a>
    </div>
</div>
