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
                    Detail User
                </h2>
            </div>

            <div class="box box-primary">

                <div class="box-body">
                    <div class="container">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <table style="width: 100%;">
                                        <tr>
                                            <th>
                                                Name
                                            </th>
                                            <td>
                                                {{ $user->first_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Email
                                            </th>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Username
                                            </th>
                                            <td>
                                                {{ $user->username }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Posisi
                                            </th>
                                            <td>
                                                {{ $user->roles()->first()->name }}
                                            </td>
                                        </tr>
                                    </table>
                                    @if($user->roles()->first()->id > Sentinel::getUser()->id)
                                    <a href="{{ route('usermanagement.edit', $user->id) }}" class="btn btn-success">Edit</a>
                                    @endif
                                </div>
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