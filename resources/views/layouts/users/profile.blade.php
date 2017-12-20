@extends('index')

@section('title')


@endsection

@section('extra-css')

@endsection

@section('content')
    <div class="container-fluid">
            <div class="block-header">

            </div>
            <!-- Body Copy -->

            <!-- #END# Body Copy -->
            <!-- Headings -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>
                                {{ $user->name }}'s Profile
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                @include('flash::message')
                            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch', 'files' => true]) !!}
                                @include('layouts.users.edit_fields')
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Headings -->

        </div>
@endsection
