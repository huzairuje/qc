<div class="body">
{!! Charts::assets() !!}
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('nama', 'Nama:') !!}
                    {!! $data_korsak->first_name !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('last_login', 'Terakhir Login:') !!}
                    {!! $data_korsak->last_login !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('phone', 'Nomor Telepon:') !!}
                    {!! $data_korsak->phone !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('email', 'Email:') !!}
                    {!! $data_korsak->email !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('foto', 'Alamat:') !!}
                    {!! $data_korsak->korsaktps->alamat !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('foto', 'Foto:') !!}
                    {!! $data_korsak->korsaktps->foto !!}
                </div>
            </div>
        </div>

<div class="modal-footer">
            <a href="{{ route('monitoring.datapjtps.edit', $data_korsak->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Edit Data</a>
            <a href="{{ route('monitoring.datapjtps.create')}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Create Data</a>
            <a href="{{ route('monitoring.datapjtps')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Data Korsak</a>
            <a href="{{ route('monitoring.datapjtps.delete', $data_korsak->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Delete Data</a>
        </div>
    </div>
</div>
