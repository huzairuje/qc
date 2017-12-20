<div class="body">
  <div class="form-group">
      <div class="row">
          <div class="col-md-4">
              <div class="form-line">
                  {!! Form::label('nama', 'Nama:') !!}
                  {{ Form::text('nama',null, ['class' => 'form-control','placeholder' => 'Nama']) }}
              </div>
          </div>
      </div>
  </div>

  <div class="form-group">
      <div class="row">
          <div class="col-md-4">
              <div class="form-line">
                  {!! Form::label('email', 'Email:') !!}
                  {{ Form::text('email',null, ['class' => 'form-control','placeholder' => 'Email']) }}
              </div>
          </div>
      </div>
  </div>

  <div class="form-group">
      <div class="row">
          <div class="col-md-4">
              <div class="form-line">
                  {!! Form::label('no_telpon', 'Nomor Telepon:') !!}
                  {{ Form::number('no_telpon',null, ['class' => 'form-control','placeholder' => 'Nomor Telepon']) }}
              </div>
          </div>
      </div>
  </div>

  <div class="form-group">
      <div class="row">
          <div class="col-md-4">
              <div class="form-line">
                  {!! Form::label('email', 'Email :') !!}
                  {{ Form::email('email',null, ['class' => 'form-control','placeholder' => 'example@example.com']) }}
              </div>
          </div>
      </div>
  </div>

  <div class="form-group">
      <div class="row">
          <div class="col-md-4">
              <div class="form-line">
                {!! Form::select('event_id', $event,null, ['class' => 'form-control','id' => 'event_id','placeholder' => 'Select Event']) !!}
              </div>
          </div>
      </div>
  </div>

  <div class="form-group">
      <div class="row">
          <div class="col-md-4">
              <div class="form-line">
                  {!! Form::label('foto', 'Foto :') !!}
                  <div id="wrapper">
                      <style type="text/css">.thumb-image{float:left;width:200px;position:relative;padding:5px;}</style>
                      <div id="image-holder">
                      </div>
                      <br>
                      {!! Form::file('foto', null, ['class' => 'form-control']) !!}
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="modal-footer">
      {!! Form::submit('Update', ['class' => 'btn btn-primary waves-effect']) !!}
      <a href="{{ route('datamaster.calon.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Kembali</a>
  </div>
</div>
