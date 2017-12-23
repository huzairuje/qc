<div class="body">
  <div class="row clearfix">

    <div class="col-md-10">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('nama', 'Nama :') !!}
                {!! $approval->user->username !!}
            </div>
        </div>
    </div>

    <div class="col-md-10">
        <div class="form-group">
            <div class="form-line">
                {!! Form::label('nama', 'Provinsi:') !!}
                {!! $approval->event->nama !!}
            </div>
        </div>
    </div>
      <div class="col-md-10">
          <div class="form-group">
              <div class="form-line">
                  {!! Form::label('nama', 'Provinsi:') !!}
                  {!! $approval->kelurahan->kecamatan->kota->provinsi->nama !!}
              </div>
          </div>
      </div>

      <div class="col-md-10">
          <div class="form-group">
              <div class="form-line">
                  {!! Form::label('nama', 'Kota/Kabupaten:') !!}
                  {!! $approval->kelurahan->kecamatan->kota->nama !!}
              </div>
          </div>
      </div>

      <div class="col-md-10">
          <div class="form-group">
              <div class="form-line">
                  {!! Form::label('nama', 'Kecamatan:') !!}
                  {!! $approval->kelurahan->kecamatan->nama !!}
              </div>
          </div>
      </div>

      <div class="col-md-10">
          <div class="form-group">
              <div class="form-line">
                  {!! Form::label('nama', 'Kelurahan:') !!}
                  {!! $approval->kelurahan->nama !!}
              </div>
          </div>
      </div>

      <div class="col-md-12">
          <div class="form-group">
              <div class="form-line">
                <div class="col-md-12">
                  {!! Form::label('nomor', 'Nomor TPS:') !!}
                  {!! $approval->tps->nomor !!}
                </div>
              </div>
            </div>
          </div>

          <div class="switch col-sm-6">
                <label>Belum di Approve
                @if(isset($approval) && $approval->is_approved)
                    <input disabled type="checkbox" name="is_approved" value="false">
                @else
                    <input disabled type="checkbox" name="is_approved" value="true">
                @endif
                <span class="lever"></span>
                Sudah di Approve
              </label>
            </div>
</body>
