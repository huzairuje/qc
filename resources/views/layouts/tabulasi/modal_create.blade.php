<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-blue">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">CREATE DATA</h4>
        </div>
        <div class="modal-body">
            <div class="row clearfix">
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
                                {{ Form::select('kota_kabupaten_id', $kota_kabupaten,null, ['class' => 'form-control select-zone','id' => 'kota_kabupaten_id','placeholder' => 'Select Kota/Kabupaten']) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-line">
                                {{ Form::select('kecamatan_id', $kecamatan,null, ['class' => 'form-control select-zone','id' => 'kecamatan_id','placeholder' => 'Select Kecamatan']) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-line">
                                {{ Form::select('kelurahan_id', $kelurahan,null, ['class' => 'form-control select-zone','id' => 'kelurahan_id','placeholder' => 'Select Kelurahan']) }}
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
                    
                    <!-- END Content Create-->

                    <!-- Modal -->
        <div class="modal-footer">
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        {!! Form::close() !!}
</div>
</div>
    @section('extra-script')
    <script src="{{ asset('bsbmd/js/pages/tables/mindmup-editabletable.js') }}"></script>
    <script src="{{ asset('bsbmd/js/pages/tables/editable-table.js') }}"></script>
    <script src="{{ asset('bsbmd/js/pages/tables/numeric-input-example.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-browser/0.1.0/jquery.browser.min.js"></script>
    <script type="text/javascript" src="https://cloud.github.com/downloads/digitalBush/jquery.maskedinput/jquery.maskedinput-1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
    $(document).ready( function() {
        $('.select-zone').select2();
        var _url = '{{ route('tabulasi.ajax') }}';
            $(document).on('change','#provinsi_id',function(){

                var coba = $(this).val();
                $.get(_url,{'type':'get-city','provinsi_id':coba})
                .done(function(result) {
                    var html = '';
                    $.each(result,function(key,value){
                        html += '<option value="'+key+'">'+value+'</option>';
                    });

                    $('#kota_kabupaten_id').html(html);
                    
                });
            });
            $(document).on('change','#kota_kabupaten_id',function(){

                var coba = $(this).val();
                $.get(_url,{'type':'get-kecamatan','kota_kabupaten_id':coba})
                .done(function(result) {
                    var html = '';
                    $.each(result,function(key,value){
                        html += '<option value="'+key+'">'+value+'</option>';
                    });

                    $('#kecamatan_id').html(html);
                    
                });
            });

            $(document).on('change','#kecamatan_id',function(){

                var coba = $(this).val();
                $.get(_url,{'type':'get-kelurahan','kecamatan_id':coba})
                .done(function(result) {
                    var html = '';
                    $.each(result,function(key,value){
                        html += '<option value="'+key+'">'+value+'</option>';
                    });

                    $('#kelurahan_id').html(html);
                    
                });
            });
        });
    </script>
    

@endsection

</div>
</div>