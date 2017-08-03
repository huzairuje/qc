<div class="body">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    <input type="select" id="name" class="form-control" placeholder="Dokumen*" value="">
				</div>
            </div>
        </div>
    	
    	<div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    <input type="select" id="name" class="form-control" placeholder="Provinsi*" value="">
				</div>
            </div>
        </div>
    
		<div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    <input type="select" id="name" class="form-control" placeholder="Kota/Kabupaten*" value="">
				</div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    <input type="select" id="name" class="form-control" placeholder="Kecamatan*" value="">
				</div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    <input type="select" id="name" class="form-control" placeholder="Kelurahan*" value="">
				</div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    <div class="header">
                        <h3>
                            Dokumen C1
                        </h3>
                        <small>
                            Daerah  DKI JAKARTA, JAKARTA TIMUR, MAKASSAR, HALIM PERDANA KUSUMA
                        </small>
                    </div>
                    <div class="body">
                     <!-- Cart 1-->
                        <div class="row clearfix">
                            <div class="col-md-12">
                                
                                    {!! $chart_penggunaan_suara->render() !!}
                                
                            </div>
                        </div>
                    <!-- #END# Cart 1-->  
                    <br/>
                    <!-- Cart 2-->
                        <div class="row clearfix">
                            <div class="col-md-12">
                                
                                    {!! $chart_jumlah_suara->render() !!}
                                
                            </div>
                        </div>

                    <!-- #END# Cart 2-->  
                    <br/>
                    <!-- Cart 3-->
                        <div class="row clearfix">
                            <div class="col-md-12">
                           
                                
                                    {!! $chart_total_calon->render() !!}
                                
                            </div>
                        </div>

                    <!-- #END# Cart 3-->
                    </div>  
                </div>
            </div>    
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    <button href="" type="button" class="btn btn-danger waves-effect">DOWNLOAD</button>
                    <br>
                    <br>
                    
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
    </div>
</div>

