<div class="body">
{!! Charts::assets() !!}
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('nama_event', 'Nama Event:') !!}
                    {!! $data_event->nama_event !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('provinsi_id', 'Provinsi:') !!}
                    {!! $data_event->provinsi_id !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('kota_kabupaten_id', 'Kota/Kabupaten:') !!}
                    {!! $data_event->kota_kabupaten_id !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('dapil', 'Daerah Pemilihan/Dapil:') !!}
                    {!! $data_event->dapil !!}
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

