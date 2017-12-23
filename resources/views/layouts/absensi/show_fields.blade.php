<div class="body">
    <div class="row clearfix">
      <div class="col-md-10">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('nama', 'Nama Saksi:') !!}
                    {!! $absensi->user->username !!}
                </div>
            </div>
        </div>

          <div class="switch col-sm-6">
                <label> Tidak Hadir
                @if(isset($absensi) && $absensi->status)
                    <input disabled type="checkbox" name="status" value="false">
                @else
                    <input disabled type="checkbox" name="status" value="true">
                @endif
                <span class="lever"></span>
                Hadir
              </label>
            </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                  <div class="col-md-12">
                    {!! Form::label('alasan', 'Alasan Ketidakhadiran:') !!}
                    {!! $absensi->alasan !!}
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
                <a href="{{ route('absensi.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Absensi</a>
            </div>
  </body>
