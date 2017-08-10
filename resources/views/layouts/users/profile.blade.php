@extends('index')

@section('title')

    
@endsection

@section('extra-css')

@endsection

@section('content')
    <section class="content-header">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <h1>
            {{ $user->name }}'s Profile
        </h1>
    </section>
    <div class="content">
        <div class="row clearfix">
            <div class="box box-primary">
                <div class="card">
                <div class="box-body">
                    
                        <div class="row" style="padding-left: 20px">
                        @include('flash::message')
                            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch', 'files' => true]) !!}
                                @include('layouts.users.edit_fields')
                            {!! Form::close() !!}
                        </div>
                        
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection
