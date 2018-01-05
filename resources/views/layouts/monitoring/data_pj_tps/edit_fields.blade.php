<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <div class="form-line">
                {!! Form::label('nama', 'Nama:') !!}
                {{ Form::text('first_name',null, ['class' => 'form-control','placeholder' => 'Nama']) }}
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <div class="form-line">
                {!! Form::label('email', 'Email:') !!}
                {{ Form::text('email',null, ['class' => 'form-control','placeholder' => 'Email']) }}
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <div class="form-line">
                {!! Form::label('email', 'Username:') !!}
                {{ Form::text('username',null, ['class' => 'form-control','placeholder' => 'Username']) }}
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <div class="form-line">
                {!! Form::label('phone', 'Nomor Handphone:') !!}
                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => '+62']) }}
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <select class="form-control show-tick" name="event" id="tahun" placeholder="Role" >
                <option value=''>User Event</option>
                @foreach( $eventList as $key => $val )
                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="form-line">
        {!! Form::submit('Simpan', ['class' => 'btn btn-primary waves-effect']) !!}
    </div>
</div>
