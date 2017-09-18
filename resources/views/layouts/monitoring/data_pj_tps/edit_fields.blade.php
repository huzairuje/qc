        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('nama', 'Nama:') !!}
                    {!! Form::text('nama', $data_saksi->nama, ['class' => 'form-control']) !!}

                </div> 						
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('alamat', 'Alamat:') !!}
                    {!! Form::text('alamat', $data_saksi->alamat, ['class' => 'form-control']) !!}
                    
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('no_telpon', 'Nomor Telepon:') !!}
                    {!! Form::number('no_telpon', $data_saksi->no_telpon, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email', $data_saksi->email, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('id_tps', 'Id TPS:') !!}
                    {!! Form::number('id_tps', $data_saksi->id_tps, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('foto', 'Foto:') !!}
                    {!! Form::text('foto', $data_saksi->foto, ['class' => 'form-control']) !!}
                </div>    
            </div>
        </div>                    
        
        <!-- END Content Create-->

        <!-- Modal -->
        <div class="modal-footer">
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
            <a href="{{ route('monitoring.datasaksi')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Data Saksi</a>
        </div>