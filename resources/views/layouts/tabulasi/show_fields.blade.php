<div class="body">
{!! Charts::assets() !!}
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('dokumen_id', 'Dokumen:') !!}
                    {!! $tabulasi->dokumen_id !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('provinsi_id', 'Provinsi:') !!}
                    {!! $tabulasi->provinsi_id !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('kota_kabupaten_id', 'Kota/Kabupaten:') !!}
                    {!! $tabulasi->kota_kabupaten_id !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('kecamatan_id', 'Kecamatan:') !!}
                    {!! $tabulasi->kecamatan_id !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('kelurahan_id', 'Kelurahan:') !!}
                    {!! $tabulasi->kelurahan_id !!}
                </div>
            </div>
        </div>

        <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                                <table id="data_suara" class="table table-bordered" style="cursor: pointer;">
                                    <thead>
                                      <tr class="bg-blue" style="color: white;">
                                        @for ($x = 1; $x <= 20; $x++)
                                            <th class="tg-yw4l">X{{ $x }}</th>
                                        @endfor
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @for ($y = 1; $y <= 20; $y++)
                                          <tr>
                                            @for ($x = 1; $x <= 20; $x++)
                                                <td class="tg-yw4l" tabindex="1">
                                                    
                                                </td>
                                            @endfor
                                          </tr>
                                        @endfor
                                      
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        {!! $chart->render() !!}                        
                    </div>
                    <div class="col-md-12">
                        {!! $chart->render() !!}                        
                    </div>
                    <div class="col-md-12">
                        {!! $chart->render() !!}                        
                    </div>


<div class="modal-footer">
            <a href="{{ route('tabulasi.edit', $tabulasi->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Edit Data</a>
            <a href="{{ route('tabulasi.create')}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Create Data</a>
            <a href="{{ route('tabulasi.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Tabulasi</a>
            <a href="{{ route('tabulasi.delete', $tabulasi->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Delete Data</a>
        </div>    
    </div>
</div>

