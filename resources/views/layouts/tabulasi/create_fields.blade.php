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
        <div class="col-md-6">
            <div class="form-group">
            	<div class="form-line">
					<table id="tableTabulasi" class="table table-bordered" style="cursor: pointer;">
					    <thead>
					      <tr>
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



					<table id="mainTable" class="table table-striped" style="cursor: pointer;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Cost</th>
                                        <th>Profit</th>
                                        <th>Fun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td tabindex="1">gg\</td>
                                        <td tabindex="1">100</td>
                                        <td tabindex="1">200</td>
                                        <td tabindex="1">0</td>
                                    </tr>
                                    <tr>
                                        <td tabindex="1">Bike</td>
                                        <td tabindex="1">330</td>
                                        <td tabindex="1">240</td>
                                        <td tabindex="1">1</td>
                                    </tr>
                                    <tr>
                                        <td tabindex="1">Plane</td>
                                        <td tabindex="1">430</td>
                                        <td tabindex="1">540</td>
                                        <td tabindex="1">3</td>
                                    </tr>
                                    <tr>
                                        <td tabindex="1">Yacht</td>
                                        <td tabindex="1">100</td>
                                        <td tabindex="1">200</td>
                                        <td tabindex="1">0</td>
                                    </tr>
                                    <tr>
                                        <td tabindex="1">Segway</td>
                                        <td tabindex="1">330</td>
                                        <td tabindex="1">240</td>
                                        <td tabindex="1">1</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><strong>TOTAL</strong></th>
                                        <th>1290</th>
                                        <th>1420</th>
                                        <th>5</th>
                                    </tr>
                                </tfoot>
                            </table>

				</div>
			</div>
		</div>	
    </div>
</div>

