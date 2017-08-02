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
                        INPUT TABULASI
                    </h2>
                </div>
                
                <div class="box box-primary">

                    <div class="box-body">
                        <div class="row">
                           
                                @include('layouts.tabulasi.index_fields')

                        </div>
                    </div>
                </div>    
                
                
            </div>
        </div>
    </div>
                
@endsection

@section('extra-script')

<script src="{{ asset('bsbmd/js/tables/editable-table.js') }}"></script>
<script src="{{ asset('bsbmd/js/tables/jquery-datatable.js') }}"></script>

@endsection