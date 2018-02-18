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
                        EDIT DATA SAKSI
                    </h2>
                </div>
                @include('flash::message')
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="container">
                            <div class="body">
                                <div class="row clearfix">

                                {!! Form::model($user, ['route' => ['monitoring.datasaksi.update', $user->id],'files' => 'true' ,'method' => 'patch']) !!}

                                    @include('layouts.monitoring.data_saksi.edit_fields')

                                {!! Form::close() !!}
                                    


                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
        </div>
    </div>
</div>
                
@endsection

@section('extra-script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready( function() {
        // select2

        var _url = '{{ route('monitoring.datasaksi.ajax') }}';
                // var _url_new = '{{ route('tabulasi.ajax') }}';

        $(document).on('change','#provinsi_id',function(){
            var _val = $(this).val();
            $.get(_url,{'type':'get-city','provinsi_id':_val})
            .done(function(result) {
                var html = '';
                $('#kota_id').selectpicker(html);

                $.each(result,function(key,value){
                    html += '<option value="'+key+'">'+value+'</option>';
                });

                $('#kota_id').html(html);
                $('#kota_id').selectpicker('refresh');
            });
        });



            $(document).on('change','#kota_id',function(){


                var coba = $(this).val();
                $.get(_url,{'type':'get-kecamatan','kota_id':coba})
                .done(function(result) {
                    var html = '';
                    $('#kecamatan_id').selectpicker(html);
                    $.each(result,function(key,value){
                        html += '<option value="'+key+'">'+value+'</option>';
                    });

                    $('#kecamatan_id').html(html);
                    $('#kecamatan_id').selectpicker('refresh');

                });
            });

            $(document).on('change','#kecamatan_id',function(){

                var coba = $(this).val();
                $.get(_url,{'type':'get-kelurahan','kecamatan_id':coba})
                .done(function(result) {
                    var html = '';
                    $('#kelurahan_id').selectpicker(html);
                    $.each(result,function(key,value){
                        html += '<option value="'+key+'">'+value+'</option>';
                    });

                    $('#kelurahan_id').html(html);
                    $('#kelurahan_id').selectpicker('refresh');
                });
            });

            $(document).on('change','#kelurahan_id',function(){

                var coba = $(this).val();
                $.get(_url,{'type':'get-tps','kelurahan_id':coba})
                .done(function(result) {
                    var html = '';
                    $('#tps_id').selectpicker(html);
                    $.each(result,function(key,value){
                        html += '<option value="'+key+'">'+value+'</option>';
                    });

                    $('#tps_id').html(html);
                    $('#tps_id').selectpicker('refresh');
                });
            });
            
        });
</script>

@endsection