<div class="body">
{!! Charts::assets() !!}
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('nama_event', 'Nama Event:') !!}
                    {!! $data_event->nama_event !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('provinsi_id', 'Provinsi:') !!}
                    {!! $data_event->provinsi_id !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('kota_kabupaten_id', 'Kota/Kabupaten:') !!}
                    {!! $data_event->kota_kabupaten_id !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('dapil', 'Daerah Pemilihan/Dapil:') !!}
                    {!! $data_event->dapil !!}
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
            <a href="{{ route('event.edit', $data_event->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Edit Data</a>
            <a href="{{ route('event.create')}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Create Data</a>
            <a href="{{ route('event.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Tabulasi</a>
            <a href="{{ route('event.delete', $data_event->id)}}" type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Delete Data</a>
        </div>    
    </div>
</div>

