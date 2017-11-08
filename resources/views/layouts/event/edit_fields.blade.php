<div class="body">
            <div class="row clearfix">
                <!-- Content Edit-->
                    <div class="col-md-12">
                            {!! Form::label('nama_event', 'Nama:') !!}
                            {!! Form::text('nama_event', $data_event->nama_event, ['class' => 'form-control']) !!}                          
                    </div>
                    <div class="col-md-6">
                           {!! Form::select('tahun_event', ['2016' => '2016', '2017' => '2017', '2018' => '2018', '2019' => '2019', '2020' => '2020', '2021' => '2021', '2022' => '2022', '2023' => '2023', '2024' => '2024', '2025' => '2025', '2026' => '2026', '2027' => '2027', '2028' => '2028', '2029' => '2029', '2030' => '2030', ], null, ['class' => 'form-control show-tick'], ['placeholder' => 'Pilih Jenis Dokumen']); !!}     
                    </div>
                    <div class="col-md-6">
                        {!! Form::select('jenis_event', ['PILKADA' => 'PILKADA  (Pemilihan Kepala Daerah)', 'PILEG' => 'PILEG  (Pemilihan Legislatif)', 'PILPRES ' => 'PILPRES (Pemilihan Presiden dan Wakil Presiden)'], null, ['class' => 'form-control show-tick'], ['placeholder' => 'Pilih Jenis Event']); !!} 
                    </div>

                    <div class="col-md-6">
                           {!! Form::select('provinsi_id', $provinsi,null, ['class' => 'form-control','id' => 'provinsi_id','placeholder' => 'Select Provinsi']) !!}     
                    </div>
        
                    <div class="col-md-6">
                                {{ Form::select('kota_kabupaten_id', $kota_kabupaten,null, ['class' => 'form-control','id' => 'kota_kabupaten_id','placeholder' => 'Select Kota/Kabupaten']) }}
                    </div>
                    
                    
                    <!-- END Content Create-->

                    <!-- Modal -->
        <div class="modal-footer">
            {!! Form::submit('Update', ['class' => 'btn btn-primary waves-effect']) !!}
            <a href="{{ route('tabulasi.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Kembali</a>
        </div>
        {!! Form::close() !!}
</div>
</div>        