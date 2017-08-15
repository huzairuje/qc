<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-blue">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">LIHAT DATA</h4>
              {!! Charts::assets() !!}
        </div>
        <div class="modal-body">
            <div class="row clearfix">
                <!-- Content Create-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                                {!! Form::label('dokumen_id', 'Dokumen:') !!}
                                <label id="documentID"></label>
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
                    <div class="col-md-12">
                        {!! $chart->render() !!}                        
                    </div>
                    
                    <!-- END Content Create-->

                    <!-- Modal -->
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable( {
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal( {
                                header: function ( row ) {
                                    var data = row.data();
                                    return 'Details for '+data[0]+' '+data[1];
                                }
                            } ),
                            renderer: function ( api, rowIdx, columns ) {
                                var data = $.map( columns, function ( col, i ) {
                                    return '<tr>'+
                                            '<td>'+col.title+':'+'</td> '+
                                            '<td>'+col.data+'</td>'+
                                        '</tr>';
                                } ).join('');
             
                                return $('<table/>').append( data );
                            }
                        }
                    }
                } );
            } );
        </script>

</div>
</div>
</div>
</div>

