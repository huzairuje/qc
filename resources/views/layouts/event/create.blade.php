@extends('index')

@section('title')

@endsection

@section('extra-css')

@endsection

@section('content')

	<div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-blue">
                    <h2>
                        Create Event
                    </h2>
                </div>

                <div class="box box-primary">

		            <div class="box-body">
		                <div class="row">
        <div class="body">
            <div class="row clearfix">

                <!-- Content Create-->
                {!! Form::open(['route' => 'event.store']) !!}

                    <div class="col-md-4">
											{!! Form::label('tahun', 'Tahun Event:') !!}
                        <select class="form-control show-tick" name="tahun" id="tahun" placeholder="Pilih Tahun" >
                            <option value=''>Pilih Tahun</option><option value='2017'>2017</option>
                            <option value='2018'>2018</option><option value='2019'>2019</option>
                            <option value='2020'>2020</option><option value='2021'>2021</option>
                            <option value='2022'>2022</option><option value='2023'>2023</option>
                            <option value='2024'>2024</option><option value='2025'>2025</option>
                            <option value='2026'>2026</option><option value='2027'>2027</option>
                            <option value='2028'>2028</option><option value='2029'>2029</option>
                            <option value='2030'>2030</option>
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
                        <select class="form-control show-tick" name="jenis" id="jenis" placeholder="Pilih Jenis Event" >
                            <option value=''>Pilih Jenis Event</option>
                            <option value='PILKADA'>PILKADA (Pemilihan Kepala Daerah)</option>
                            <option value='PILEG'>PILEG (Pemilihan Legislatif)</option>
                            <option value='PILPRES'>PILPRES (Pemilihan Presiden)</option>
                        </select>
                    </div>
                    <div class="col-md-8 select-tingkat">
                        <select class="form-control show-tick" name="tingkat" id="tingkat" placeholder="Pilih Tingkat Event" ></select>
                    </div>


                    <div class="provinsi col-md-8">
                           {!! Form::select('provinsi', $provinsi,null, ['class' => 'form-control','id' => 'provinsi_id','placeholder' => 'Select Provinsi']) !!}
                    </div>

                    <div class="kabupaten col-md-8">
                            {{ Form::select('kabupaten_kota', $kota,null, ['class' => 'form-control','id' => 'kota_kabupaten_id','placeholder' => 'Select Kota/Kabupaten']) }}

                    </div>


            </div>

        <div class="modal-footer">
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
            <a href="{{ route('event.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Index Event</a>
        </div>
        {!! Form::close() !!}
</div>
</div>
@endsection
@section('extra-script')
<script src="{{ asset('bsbmd/js/pages/tables/mindmup-editabletable.js') }}"></script>
<script src="{{ asset('bsbmd/js/pages/tables/editable-table.js') }}"></script>
<script src="{{ asset('bsbmd/js/pages/tables/numeric-input-example.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-browser/0.1.0/jquery.browser.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-browser/0.1.0/jquery.browser.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script type="text/javascript">
    $(document).ready( function() {
        var _url = '{{ route('event.ajax') }}';
        // select2
        $(document).on('change','#jenis',function(){
            var _val = $(this).val();
            $(".select-tingkat").html('<select class="form-control show-tick" name="tingkat" id="tingkat" placeholder="Pilih Tingkat Event" ></select>');

                var html = '';
                $('#tingkat').selectpicker(html);

            if (_val == 'PILKADA'){
                var html = '';
                html += '<option value="">Pilih Tingkat PILKADA</option>';
                html += '<option value="1">PILKADA Tingkat Provinsi</option>';
                html += '<option value="2">PILKADA Tingkat Kota/Kabupaten</option>';
                $('#tingkat').html(html);
                $('#tingkat').selectpicker('refresh');
            }
            else if (_val == 'PILEG'){
                var html = '';
                html += '<option value="">Pilih Tingkat PILEG</option>';
								html += '<option value="0">PILEG DPR (Nasional)</option>';
                html += '<option value="0">PILEG DPD (Nasional)</option>';
                html += '<option value="1">PILEG DPRD Provinsi (Provinsi)</option>';
                html += '<option value="2">PILEG DPRD Kota/Kabupaten (Kota/Kabupaten)</option>';
                $('#tingkat').html(html);
                $('#tingkat').selectpicker('refresh');
            }

            else {
                $('#provinsi_id').selectpicker('destroy');
                $('#provinsi_id').remove();
                $('#kota_kabupaten_id').selectpicker('destroy');
                $('#kota_kabupaten_id').remove();
                $('#tingkat').selectpicker('destroy');
                $('#tingkat').remove();
            }
        });


        $(document).on('change','#tingkat',function(){
            var _val = $(this).val();
            $("#provinsi_id").html();

            var html = '';
            $('#provinsi_id').selectpicker(html);

            if (_val == '1' ){
                $('#kota_kabupaten_id').selectpicker('destroy');
                $('#kota_kabupaten_id').remove();
                if (_val == '1' ){
                    $('.provinsi').html('<select class="form-control show-tick" name="provinsi" id="provinsi_id" placeholder="Pilih Jenis Event" ></select>');
                    getProvincy(_url);

                }

            }
            else if (_val == '2' ){
                var html = '';
                var _val = $(this).val();
                getProvincy(_url);
                if (_val == '2' ){
                    $('.kabupaten').html('<select class="form-control show-tick" name="kabupaten_kota" id="kota_kabupaten_id" placeholder="Pilih Jenis Event" ></select>');
                }
            }
            else {
								$('#kota_kabupaten_id').selectpicker('destroy');
								$('#kota_kabupaten_id').remove();
                $('#provinsi_id').selectpicker('destroy');
                $('#provinsi_id').remove();
            }

        });

        $(document).on('change','#provinsi_id',function(){
            var _val = $(this).val();
            getCity(_val,_url);
        });

	        $(document).on('change','#kota_kabupaten_id',function(){

	            var coba = $(this).val();
	            $.get(_url,{'type':'get-kecamatan','kota_kabupaten_id':coba})
	            .done(function(result) {
	                var html = '';
                    $('#dapil').selectpicker(html);
	                $.each(result,function(key,value){
	                    html += '<option value="'+key+'">'+value+'</option>';
	                });

	                $('#dapil').html(html);
                    $('#dapil').selectpicker('refresh');

	            });
	        });


	    });

            function getCity(val,url)
            {
                $.get(url,{'type':'get-city','provinsi_id':val})
            .done(function(result) {
                var html = '';
                $('#kota_kabupaten_id').selectpicker(html);

                $.each(result,function(key,value){
                    html += '<option value="'+key+'">'+value+'</option>';
                });

                $('#kota_kabupaten_id').html(html);
                $('#kota_kabupaten_id').selectpicker('refresh');
            });
            }

            function getProvincy(url)
            {
                $.get(url,{'type':'get-provincy'})
            .done(function(result) {

                var html = '';
                $('#provinsi_id').selectpicker(html);

                $.each(result,function(key,value){
                    html += '<option value="'+key+'">'+value+'</option>';
                });

                $('#provinsi_id').html(html);
                $('#provinsi_id').selectpicker('refresh');
            });
            }
</script>


@endsection

</div>
</div>
