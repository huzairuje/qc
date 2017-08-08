<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-blue">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">CREATE DATA</h4>
        </div>
        <div class="modal-body">
            <div class="row clearfix">
                <div class="card">
                <!-- Content Create-->
                {!! Form::open(['route' => 'tabulasi.store']) !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                            

                                {{ Form::select('dokumen_id', $dokumen,null, ['class' => 'form-control select-zone','id' => 'dokumen_id','placeholder' => 'Select Dokumen']) }}
                            </div>
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-line">
                                {{ Form::select('provinsi_id', $provinsi,null, ['class' => 'form-control select-zone','id' => 'provinsi_id','placeholder' => 'Select Provinsi']) }}
                            </div>
                        </div>
                    </div>
        
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-line">
                                {!! Form::text('kota_kabupaten_id', null, ['class' => 'form-control', 'placeholder' => 'Pilih Kota/Kabupaten']); !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-line">
                                {!! Form::text('kecamatan_id', null, ['class' => 'form-control' , 'placeholder' => 'Pilih Kecamatan']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-line">
                                {!! Form::text('kelurahan_id', null, ['class' => 'form-control', 'placeholder' => 'Pilih Kelurahan']); !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                                <table id="tableTabulasi" class="table table-bordered" style="cursor: pointer;">
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
                    
                    <!-- END Content Create-->

                    <!-- Modal -->
        <div class="modal-footer">
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
</div>
</div>