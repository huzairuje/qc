@extends('index')

@section('title')

@endsection

@section('extra-css')

@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-line">
                            <div class="body">
                                <div class="row clearfix">
                                    @include('flash::message')
                                    <div class="header">
                                        <h2>
                                            <span>User Assign Management</span>
                                            <i class="material-icons">autorenew</i>
                                        </h2>

                                    </div>

                                    <table id="table-Dataevent" class="table table-striped">
                                        <thead>
                                            <tr style="background-color: lightblue">
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Didaftarkan Oleh</th>
                                                <th>Posisi</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($users as $user)
                                            <tr>
                                                <td>
                                                    {{ $user->first_name }}
                                                </td>
                                                <td>
                                                    {{ $user->email }}
                                                </td>
                                                <td>
                                                    {{ $user->parent->email or 'Developer' }}
                                                </td>
                                                <td>
                                                    {{ $user->roles()->first()->name }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('assignuser.show', $user->id ) }}" class="btn btn-xs btn-primary">
                                                        <i class="material-icons">search</i>Lihat
                                                    </a>
                                                    <!-- <a href="{{ route('assignuser.edit', $user->id ) }}" class="btn btn-xs btn-primary">
                                                        <i class="material-icons">search</i>Edit
                                                    </a> -->
                                                </td>
                                            </tr>
                                            @endforeach
                                        </thead>
                                    </table>
                                    {{ $users->links() }}
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
