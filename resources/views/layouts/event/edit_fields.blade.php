        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('nama_event', 'Nama:') !!}
                    {!! Form::text('nama_event', $data_event->nama_event, ['class' => 'form-control']) !!}

                </div>                      
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('alamat', 'Alamat:') !!}
                    {!! Form::text('alamat', $datapjtps->alamat, ['class' => 'form-control']) !!}
                    
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('no_telpon', 'Nomor Telepon:') !!}
                    {!! Form::number('no_telpon', $datapjtps->no_telpon, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email', $datapjtps->email, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('list_id_tps', 'List Id TPS:') !!}
                    {!! Form::number('list_id_tps', $datapjtps->id_tps, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>                   
        
        <!-- END Content Create-->

        <!-- Modal -->
        <div class="modal-footer">
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
            <a href="{{ route('event.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Data Saksi</a>
        </div>