<div class="body">
{!! Charts::assets() !!}
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('nama', 'Nama:') !!}
                    {!! $data_saksi->first_name !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('no_telpon', 'Nomor Telepon:') !!}
                    {!! $data_saksi->phone !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('email', 'Email:') !!}
                    {!! $data_saksi->email !!}
                </div>
            </div>
        </div>


<div class="modal-footer">
            <a href="{{ route('monitoring.datasaksi.edit', $data_saksi->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Edit Data</a>
            <a href="{{ route('monitoring.datasaksi.create')}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Create Data</a>
            <a href="{{ route('monitoring.datasaksi')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Data Saksi</a>
            <a href="{{ route('monitoring.datasaksi.delete', $data_saksi->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Delete Data</a>
        </div>
    </div>
</div>
