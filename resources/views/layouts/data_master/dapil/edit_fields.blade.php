<div class="body">
            <div class="row clearfix">
                <!-- Content Edit-->
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-line">
                        {!! Form::label('nama', 'Nama Dapil:') !!}

                        {!! Form::text('nama', $dapil->nama, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                <!-- Email Field -->
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-line">
                            {!! Form::label('event_id', 'Event:') !!}
                            {!! Form::select('event_id', $event, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>




                    <!-- END Content Create-->

                    <!-- Modal -->
        <div class="modal-footer">
            {!! Form::submit('Update', ['class' => 'btn btn-primary waves-effect']) !!}
            <a href="{{ route('datamaster.dapil.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Kembali</a>
        </div>
        {!! Form::close() !!}
</div>
</div>
