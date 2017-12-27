<div class="body">
    <div class="row clearfix">

        <!-- Content Create-->
        {!! Form::open(['route' => 'event.store']) !!}

        <div class="col-md-4">
            {!! Form::label('tahun', 'Tahun Event:') !!}
            <select class="form-control show-tick" name="tahun" id="tahun" placeholder="Pilih Jenis Event" >
                <option value=''>Pilih Tahun Event</option>
                <option value='2018'>2018</option>
                <option value='2019'>2019</option>
                <option value='2020'>2020</option>
                <option value='2021'>2021</option>
                <option value='2022'>2022</option>
                <option value='2023'>2023</option>
                <option value='2024'>2024</option>
                <option value='2025'>2025</option>
                <option value='2026'>2026</option>
                <option value='2027'>2027</option>
                <option value='2030'>2030</option>
                <option value='2031'>2031</option>
                <option value='2032'>2032</option>
                <option value='2033'>2033</option>
                <option value='2034'>2034</option>
                <option value='2035'>2035</option>
                <option value='2036'>2036</option>
                <option value='2037'>2037</option>
            </select>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('expired', 'Tanggal Kadaluarsa Event:') !!}
                    {{ Form::date('expired',null, ['class' => 'form-control','placeholder' => 'Isi Nama Event Dengan Lengkap']) }}
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <div class="form-group">
                <div class="form-line">
                    {!! Form::label('nama', 'Nama Event:') !!}
                    {{ Form::text('nama',null, ['class' => 'form-control','placeholder' => 'Isi Nama Event Dengan Lengkap']) }}
                </div>
            </div>
        </div>

        <div class="col-md-8">
            {!! Form::select('jenis_id', $jenis,null, ['class' => 'form-control','id' => 'jenis','placeholder' => 'Pilih Jenis']) !!}
        </div>

        <div class="col-md-8 tingkat-form-container">
            {!! Form::select('tingkat_id', $tingkat,null, ['class' => 'form-control','id' => 'tingkat','placeholder' => 'Pilih Tingkat']) !!}
        </div>

        <div class="provinsi col-md-8 provinsi-form-container">
            {!! Form::select('provinsi', $provinsi,null, ['class' => 'form-control','id' => 'provinsi_id','placeholder' => 'Pilih Provinsi']) !!}
        </div>

        <div class="kabupaten col-md-8 kota-form-container">
            {{ Form::select('kota', $kota,null, ['class' => 'form-control','id' => 'kota_id','placeholder' => 'Pilih Kota/Kabupaten']) }}

        </div>


    </div>

    <div class="modal-footer">
        {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
        <a href="{{ route('event.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Event</a>
    </div>
    {!! Form::close() !!}
</div>
