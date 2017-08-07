<div class="body">
    <div class="row clearfix">

        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    {{ Form::select('dokumen_id', $dokumen,null, ['class' => 'form-control select-zone','id' => 'dokumen_id','placeholder' => 'Select Dokumen']) }}
				</div>
            </div>
        </div>
    	
    	<div class="col-md-6">
            <div class="form-group">
                    {{ Form::select('provinsi_id', $provinsi, null, ['class' => 'form-control', 'placeholder' => 'Pilih Provinsi']) }}
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

        <!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    
</div>	
    </div>
</div>

