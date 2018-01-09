<div class="body">
{!! Charts::assets() !!}
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('nama', 'Nama:') !!}
                    {!! $datapjtps->first_name !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('last_login', 'Terakhir Login:') !!}
                    {!! $datapjtps->last_login !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('phone', 'Nomor Telepon:') !!}
                    {!! $datapjtps->phone !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('email', 'Email:') !!}
                    {!! $datapjtps->email !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('list_id_tps', 'List Id TPS:') !!}
                    {!! $datapjtps->list_id_tps !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('foto', 'Foto:') !!}
                    {!! $datapjtps->foto !!}
                </div>
            </div>
        </div>

<div class="modal-footer">
            <a href="{{ route('monitoring.datapjtps.edit', $datapjtps->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Edit Data</a>
            <a href="{{ route('monitoring.datapjtps.create')}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Create Data</a>
            <a href="{{ route('monitoring.datapjtps')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Data Saksi</a>
            <a href="{{ route('monitoring.datapjtps.delete', $datapjtps->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Delete Data</a>
        </div>
    </div>
</div>
