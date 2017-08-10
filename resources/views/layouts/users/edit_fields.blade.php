<!-- Nama Field -->
<div class="col-md-12">
    <div class="form-group">
        <div class="form-line">
        {!! Form::label('nama', 'Nama:') !!}
         
        {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<!-- Email Field -->
<div class="col-md-12">
    <div class="form-group">
        <div class="form-line">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<!-- Password Field -->
<div class="col-md-12">
    <div class="form-group">
        <div class="form-line">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<!-- Password Confirmation Field -->
<div class="col-md-12">
    <div class="form-group">
        <div class="form-line">
    {!! Form::label('password', 'Konfirmasi Password:') !!}
    {!! Form::password('Confirm_password', ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('dashboard') !!}" class="btn btn-default">Batal</a>
</div>
