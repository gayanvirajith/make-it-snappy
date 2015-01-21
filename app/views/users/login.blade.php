@extends('layouts.default')

@section('content')
  <h1>Login</h1>
  
  @if ($errors->has())
    <p>The following errors have occurred.</p>
    <ul id="form-errors">
      {{ $errors->first('username', '<li>:message</li>') }}
      {{ $errors->first('password', '<li>:message</li>') }}
    </ul>
  @endif

  {{ Form::open(array('route' => 'auth')) }}

    <p>
      {{ Form::label('username', 'Username') }}<br/>
      {{ Form::text('username', null) }}
    </p>

    <p>
      {{ Form::label('password', 'Password')}}<br/>
      {{ Form::password('password')}}
    </p>

    <p>
      {{ Form::submit('Login') }}
    </p>
    
  {{ Form::close() }}

@stop