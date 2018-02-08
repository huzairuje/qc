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
                                    @if($data_calon->has_wakil)
                                    {{ $data_calon->nama . ' - ' . $data_calon->wakil->nama }}
                                    @else
                                    {{ $data_calon->nama }}
                                    @endif
                                </td>
                                @foreach($tps as $data)
                                     @if(!empty($data_suara))
                                    <td class="tg-yw4l" tabindex="1">
                                    <input name="tabulasi[{{ $data_calon->id }}][{{ $data }}]" type="number" style="border:none" value="{{ $data_suara[''.$data_calon->id.''][$data] }}">
                                    </td>
                                    @else
                                    <td class="tg-yw4l" tabindex="1">
                                    <input name="tabulasi[{{ $data_calon->id }}][{{ $data }}]" type="number" style="border:none" value="0">
                                    </td>
                                    @endif
                                @endforeach
                              </tr>
                            @endforeach
                          @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12 images-table">
            <div class="form-group">
                <div class="form-line" style="overflow-x: scroll;">
                    <table id="data_suara" class="table table-bordered" style="cursor: pointer;">
                        <thead>
                          <tr class="bg-blue" style="color: white;">
                            <th class="tg-yw4l">TPS</th>
                            @for($i = 1;$i <= 22; $i++)
                              <th class="tg-yw4l">{{$i}}</th>
                            @endfor
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($tps_all as $data)
                                <tr class="tg-yw4l">
                                  <td>{{ $data->nomor }}</td>
                                  @for($i = 1;$i <= 22; $i++)
                                    <td>
                                        @php
                                            $saved = $data->images()->where('event_id', '=', $tabulasi->event->id)->get();
                                        @endphp
                                      <a href="{{ array_key_exists($i-1, $saved->toArray()) ? asset($data->images()->get()[$i-1]['foto']) : 'javascript:void(0)' }}"><i class="material-icons md-icon placeholder" style="color: {{ $data->images()->get()->count() >= $i ? '#000000' : '#BDBDBD' }};">photo</i></a>
                                    </td>
                                  @endfor
                                </tr>
                            @endforeach
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
