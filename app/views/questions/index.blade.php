@extends('layouts.default')

@section('content')
  <div id="ask">
    <h1>{{ Lang::get('messages.ask_a_question')}}</h1>

    @if (Auth::check())
      @if ($errors->has()) 
        
        <p>{{ Lang::get('messages.the_following_errors_have_occured') }}</p>
        
        <ul id="form-errors">
          {{ $errors->first('question', '<li>:message</li>') }}
        </ul>

      @endif

      {{ Form::open(array('route' => 'ask')) }}
        <p>
          {{ Form::label('question', 'Question') }} <br />
          {{ Form::text('question') }}

          {{ Form::submit('Ask a Question') }}
        </p>
      {{ Form::close() }}

    @else 
      <p>{{ Lang::get('messages.please_login_to_ask_or_answer_questions') }}</p>
    @endif
  </div> <!-- ends ask -->  

  <div id="questions">
    <h2>Unsolved Questions</h2>

    @if(!$questions) 
      <p>No questions have been asked.</p>
    @else
      <ul>
        @foreach($questions as $question)
          <li>
            {{ link_to_route('question', Str::limit($question->question, 35), array($question->id))  }} 
            by {{ ucfirst($question->user->username) }} 
            ({{ count($question->answers) }} {{ Str::plural('Answer', count($question->answers)) }})
          </li>
        @endforeach
      </ul>  

      {{ $questions->links() }}
    @endif
  </div>
@stop