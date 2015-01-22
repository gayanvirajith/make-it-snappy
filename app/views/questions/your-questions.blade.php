@extends('layouts.default')

@section('content')
  <h1>{{ ucfirst($username)}} Questions</h1>

  @if (!$questions)
    <p>You have not posted any questions yet.</p>
  @else
    <ul>
    @foreach($questions as $question) 
      <li>
        {{{ Str::limit($question->question) }}} -
        {{ ($question->solved) ? ("(Soved)") : ("") }}
        {{ link_to_route('editQuestion', 'Edit', array($question->id) )}}
        {{ link_to_route('question', 'View', array($question->id) )}}
      </li>
    @endforeach
    </ul>
    {{ $questions->links() }}
  @endif

@stop