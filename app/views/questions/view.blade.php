@extends('layouts.default')

@section('content')
  <h1>{{ ucfirst($question->user->username )}} asks: </h1>

  <p>
    {{{ $question->question }}}
  </p>

  <div id="answers">
    <h2>Answers</h2>

    @if (!$question->answers)
      <p>This question has not been answered yet.</p>
    @else
      <ul>
        @foreach($question->answers as $answer)
          <li>
            {{{ $answer->answer }}} by {{{ ucfirst($answer->user->username ) }}}
          </li>
        @endforeach
      </ul>
    @endif
  </div><!-- end answer -->
  
  <div id="post-answer">
    <h2>Answer this Question</h2>

    @if (!Auth::check())
      <p>Please login to post an answer for this question.</p>
    @else

      @if ($errors->has())
        <ul id="form-errors">
          {{ $errors->first('answer', '<li>:message</li>') }}
        </ul>
      @endif

      {{ Form::open(array('route' => 'answer')) }}
        {{ Form::hidden('question_id', $question->id )}}
        <p>
          {{ Form::label('answer', 'Answer') }} <br />
          {{ Form::text('answer') }}
          {{ Form::submit('Post Answer') }}
        </p>
      {{ Form::close() }}
    @endif
  </div><!-- end answer -->
@stop