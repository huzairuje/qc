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
                        EDIT DATA CALON
                    </h2>
                </div>
                @include('flash::message')
                <div class="box box-primary">

                    <div class="box-body">

                        <div class="row">
                                {!! Form::model($calon, ['route' => ['datamaster.calon.update', $calon->id], 'method' => 'patch']) !!}

                                    @include('layouts.data_master.calon.edit_fields')

                                {!! Form::close() !!}
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection

@section('extra-script')
<script>$(document).ready( function() {
    var _url = '{{ route('datamaster.calon.ajax') }}';

    $('.nama-form-container').hide();

    $('#event_id').val({{ $calon->dapil->event_id }});

    $.get(_url,{'type':'get-dapil','event_id':{{ $calon->dapil->event_id }}}).done(function(result) {
        var html = '';
        $('#dapil_id').selectpicker(html);

        $.each(result,function(key,value){
            html += '<option value="'+key+'">'+value+'</option>';
        });

        $('#dapil_id').html(html);
        $('#dapil_id').val({{ $calon->dapil_id }});
        $('#dapil_id').selectpicker('refresh');
    });

    $(document).on('change','#tipe',function(){
        var _val = $(this).val();
        if(_val == 0){
            $('.nama-form-container').hide();
        }
        else {
            $('.nama-form-container').show();
        }
    });

    $(document).on('change','#event_id',function(){
        var _val = $(this).val();
        $.get(_url,{'type':'get-dapil','event_id':_val}).done(function(result) {
            var html = '';
            $('#dapil_id').selectpicker(html);

            $.each(result,function(key,value){
                html += '<option value="'+key+'">'+value+'</option>';
            });

            $('#dapil_id').html(html);
            $('#dapil_id').selectpicker('refresh');
        });
    });
});
</script>

@endsection
