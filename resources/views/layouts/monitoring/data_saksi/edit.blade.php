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

                                {!! Form::model($data_saksi, ['route' => ['monitoring.datasaksi.update', $data_saksi->id], 'method' => 'patch']) !!}

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


@endsection