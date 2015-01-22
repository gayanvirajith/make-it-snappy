@extends('layouts.default')

@section('content')
  <h1>Edit Your Question</h1>

  @if ($errors->has())
    <ul id="form-errors">
      {{ $errors->first('solved', '<li>:message</li>') }}
      {{ $errors->first('question', '<li>:message</li>') }}
    </ul>
  @endif

  {{ Form::model($question, array('route' => ['updateQuestion', $question->id], 'method' => 'PUT' )) }}

    <p>
      {{ Form::label('question', 'Question') }} <br/>
      {{ Form::text('question') }}
    </p>

    <p>
      {{ Form::label('solved', 'Solved') }}
      {{ Form::checkbox('solved')}}
    </p>

    <p>
      {{ Form::submit('Update Question') }}
    </p>
    
  {{ Form::close() }}
@stop