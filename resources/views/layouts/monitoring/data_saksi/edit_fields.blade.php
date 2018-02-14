        <div class="form-group">
            <div class="row">
                <div class="col-md-10">
                    {!! Form::label('user_event', 'Pilih Event Saksi:') !!}
                    <select class="form-control show-tick" name="event" id="tahun" placeholder="Role" >
                        <option value=''>User Event</option>
                        @foreach( $eventList as $key => $val )
                        <option value="{{ $val->id }}">{{ $val->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-line">
                        {!! Form::label('provinsi_id', 'Pilih Provinsi Saksi:') !!}
                        {!! Form::select('provinsi_id', $provinsi,null, ['class' => 'form-control','id' => 'provinsi_id','placeholder' => 'Select Provinsi']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-line">
                        {!! Form::label('kota_id', 'Pilih Kota/Kab Saksi:') !!}
                        {{ Form::select('kota_id', $kota,null, ['class' => 'form-control','id' => 'kota_id','placeholder' => 'Select Kota/Kabupaten']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-line">
                        {!! Form::label('kecamatan_id', 'Pilih Kecamatan Saksi:') !!}
                        {{ Form::select('kecamatan_id', $kecamatan,null, ['class' => 'form-control','id' => 'kecamatan_id','placeholder' => 'Select Kecamatan']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-line">
                        {!! Form::label('kelurahan_id', 'Pilih Kelurahan Saksi:') !!}
                        {{ Form::select('kelurahan_id', $kelurahan,null, ['class' => 'form-control','id' => 'kelurahan_id','placeholder' => 'Select Kelurahan']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-line">
                        {!! Form::label('tps_id', 'Pilih Nomor TPS:') !!}
                        {{ Form::select('tps_id', $tps,null, ['class' => 'form-control','id' => 'tps_id','placeholder' => 'Select TPS']) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-line">
                    {!! Form::label('nama', 'Username:') !!}
                    {!! Form::text('nama', $data_saksi->username, ['class' => 'form-control']) !!}
                    </div>
                </div> 						
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-line">
                    {!! Form::label('alamat', 'Alamat:') !!}
                    {!! Form::text('alamat', $data_saksi->saksitps->alamat, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-line">
                    {!! Form::label('no_telpon', 'Nomor Telepon:') !!}
                    {!! Form::text('phone', $data_saksi->phone, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-line">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email', $data_saksi->email, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>


   <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                <div class="form-line">
                {!! Form::label('foto', 'Foto:') !!}
                {!! Form::text('foto', $data_saksi->saksitps->foto, ['class' => 'form-control']) !!}
                </div>    
            </div>
        </div>
    </div>                    
        
        <!-- END Content Create-->

        <!-- Modal -->
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-line">
                    {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
                    <a href="{{ route('monitoring.datasaksi')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Data Saksi</a>
                    </div>
                </div>
            </div>
        </div>