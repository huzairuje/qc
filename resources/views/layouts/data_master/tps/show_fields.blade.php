<div class="body">
  <div class="row clearfix">


      <div class="col-md-10">
          <div class="form-group">
              <div class="form-line">
                  {!! Form::label('nama', 'Provinsi:') !!}
                  {!! $tps->kelurahan->kecamatan->kota->provinsi->nama !!}
              </div>
          </div>
      </div>

      <div class="col-md-10">
          <div class="form-group">
              <div class="form-line">
                  {!! Form::label('nama', 'Kota/Kabupaten:') !!}
                  {!! $tps->kelurahan->kecamatan->kota->nama !!}
              </div>
          </div>
      </div>

      <div class="col-md-10">
          <div class="form-group">
              <div class="form-line">
                  {!! Form::label('nama', 'Kecamatan:') !!}
                  {!! $tps->kelurahan->kecamatan->nama !!}
              </div>
          </div>
      </div>

      <div class="col-md-10">
          <div class="form-group">
              <div class="form-line">
                  {!! Form::label('nama', 'Kelurahan:') !!}
                  {!! $tps->kelurahan->nama !!}
              </div>
          </div>
      </div>

      <div class="col-md-12">
          <div class="form-group">
              <div class="form-line">
                <div class="col-md-12">
                  {!! Form::label('nomor', 'Nomor TPS:') !!}
                  {!! $tps->nomor !!}
                </div>
              </div>
            </div>
          </div>
</body>
