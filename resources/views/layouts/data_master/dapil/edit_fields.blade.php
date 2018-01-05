

<div class="col-md-10">
    <div class="form-group">

        <div class="col-md-12">
            {!! Form::label('event_id', 'Pilih Event:') !!}
            {!! Form::select('event_id', $event,null, ['class' => 'form-control', 'id' => 'event_id', 'placeholder' => 'Pilih Event']); !!}
        </div>

        <div class="col-md-10">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('nama', 'Nama Dapil:') !!}
                    {{ Form::text('nama',null, ['class' => 'form-control','placeholder' => 'Isi Nama Event Dengan Lengkap']) }}
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <select id="data" name="data[]" class="ui fluid search dropdown form-control show-tick" multiple>

            </select>
        </div>



        <!-- END Content Create-->

        <!-- Modal -->
        <div class="modal-footer">
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
            <a href="{{ route('datamaster.dapil.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Dapil</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>
