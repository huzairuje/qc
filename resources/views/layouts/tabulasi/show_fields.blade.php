<div class="body">

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('dokumen_id', 'Dokumen:') !!}
                    {!! $tabulasi->dokumen !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('provinsi_id', 'Provinsi:') !!}
                    {!! $tabulasi->event->nama !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('provinsi_id', 'Provinsi:') !!}
                    {!! $tabulasi->provinsi->nama !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('kota_kabupaten_id', 'Kota/Kabupaten:') !!}
                    {!! $tabulasi->kota->nama !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('kecamatan_id', 'Kecamatan:') !!}
                    {!! $tabulasi->kecamatan->nama !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('kelurahan_id', 'Kelurahan:') !!}
                    {!! $tabulasi->kelurahan->nama !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">

                </div>
            </div>        
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line" style="overflow-x: scroll;">
                    <table id="data_suara" class="table table-bordered" style="cursor: pointer;">
                        <thead>
                          <tr class="bg-blue" style="color: white;">
                            <th class="tg-yw4l">Calon</th>
                            @foreach($tps as $data)
                                <th class="tg-yw4l">X{{ $data }}</th>
                            @endforeach
                          </tr>
                        </thead>
                        <tbody>
                          @if($calon)
                            @foreach($calon as $data_calon)
                              <tr>
                                <td class="tg-yw4l" tabindex="1">
                                  {{ $data_calon->nama }}
                                </td>
                                @foreach($tps as $data)
                                    <td class="tg-yw4l" tabindex="1">
                                      <input name="tabulasi[{{ $data_calon->id }}][{{ $data }}]" type="number" style="border:none" value="0">
                                    </td>
                                @endforeach
                              </tr>
                            @endforeach
                          @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
                    


        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    <a href="{{ route('tabulasi.edit', $tabulasi->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Edit Data</a>
                    <a href="{{ route('tabulasi.create')}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Create Data</a>
                    <a href="{{ route('tabulasi.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Tabulasi</a>
                    <a href="{{ route('tabulasi.delete', $tabulasi->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Delete Data</a>
                </div>
            </div>        
        </div>
        
    </div>
</div>
