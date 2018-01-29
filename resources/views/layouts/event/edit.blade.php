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
                    EDIT DATA EVENT
                </h2>
            </div>
            @include('flash::message')
            <div class="box box-primary">

                <div class="box-body">

                    <div class="row">
                        {!! Form::model($event, ['route' => ['event.update', $event->id], 'method' => 'patch']) !!}

                        @include('layouts.event.edit_fields')

                        {!! Form::close() !!}



                    </div>
                </div>
            </div>


        </div>
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
    $('#tahun').val({{ $event->tahun }});
    $('#expired').val('<?php echo $event->expired; ?>');
    @if( $event->tingkat_id == 1 )
    $('.provinsi-form-container').hide();
    $('.kota-form-container').hide();
    @elseif( $event->tingkat_id == 2 )
    $('#provinsi_id').val({{ $event->loasi_id }});
    $('.kota-form-container').hide();
    @else
    $.get(_url,{'type':'get-city','provinsi_id':{{ $event->kota->provinsi_id }}}).done(function(result) {
        var html = '';
        $('#kota_id').selectpicker(html);

        $.each(result,function(key,value){
            html += '<option value="'+key+'">'+value+'</option>';
        });

        $('#kota_id').html(html);
        $('#kota_id').val({{ $event->lokasi }});
        $('#kota_id').selectpicker('refresh');
    });
    $('#provinsi_id').val({{ $event->kota->provinsi_id }});
    @endif

    @if($event->tingkat_id == 1)
    $('.tingkat-form-container').hide();
    @endif

    $(document).on('change','#jenis',function(){
        var _val = $(this).val();
        if(_val == 4 || _val == 5){
            $('.tingkat-form-container').show();
        }
        else {
            $('.tingkat-form-container').hide();
            $('.provinsi-form-container').hide();
            $('.kota-form-container').hide();
        }
    });

    $(document).on('change','#tingkat',function(){
        var _val = $(this).val();
        if(_val == 2){
            $('.provinsi-form-container').show();
            $('.kota-form-container').hide();
        }
        else if(_val == 3){
            $('.provinsi-form-container').show();
            $('.kota-form-container').show();
        }
        else {
            $('.provinsi-form-container').hide();
            $('.kota-form-container').hide();
        }
    });

    $(document).on('change','#provinsi_id',function(){
        var _val = $(this).val();

        $.get(_url,{'type':'get-city','provinsi_id':_val}).done(function(result) {
            var html = '';
            $('#kota_id').selectpicker(html);

            $.each(result,function(key,value){
                html += '<option value="'+key+'">'+value+'</option>';
            });

            $('#kota_id').html(html);
            $('#kota_id').selectpicker('refresh');
        });
    });

});
</script>

@endsection
