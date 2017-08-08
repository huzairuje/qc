







{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch', 'files' => true]) !!}
                    @include('users.edit_fields')
                {!! Form::close() !!}