@if (Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif --}}

<div class="form-group">
    {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    @if ($errors->has('name'))
        <span class="text-danger">{{ $errors->first('name') }}</span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
    @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('password', 'Password:', ['class' => 'control-label']) !!}
    <input type="password" name="password" class="form-control" id="password" >
    @if ($errors->has('password'))
        <span class="text-danger">{{ $errors->first('password') }}</span>
    @endif

</div>

