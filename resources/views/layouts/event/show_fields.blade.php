<div class="body">
    {!! Charts::assets() !!}
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('nama', 'Nama Event :') !!}
                    {!! $data_event->nama !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('tahun', 'Tahun :') !!}
                    {!! $data_event->tahun !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('jenis', 'Jenis Event :') !!}
                    {{ $data_event->jenis->nama }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('tingkat', 'Tingkat Event :') !!}
                    {{ $data_event->tingkat->nama }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('lokasi', 'Lokasi:') !!}
                    {!! $result !!}
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <a href="{{ route('event.edit', $data_event->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Edit Data</a>
            <a href="{{ route('event.create')}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Create Data</a>
            <a href="{{ route('event.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Event</a>
            <a href="{{ route('event.delete', $data_event->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Delete Data</a>
        </div>
    </div>
</div>
