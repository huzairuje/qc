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
                        SHOW TABULASI
                    </h2>
                </div>
                @include('flash::message')
                <div class="box box-primary">

                    <div class="box-body">
                        
                        <div class="row">

                                    @include('layouts.tabulasi.show_fields')


                        </div>
                    </div>
                </div>    
                
                
            </div>
        </div>
    </div>
                
@endsection

@section('extra-script')

@endsection