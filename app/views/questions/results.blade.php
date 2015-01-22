@extends('layouts.default')

@section('content')
  <h1>Search Results</h1>

  @if (!count($questions))
    <p>Nothing found, please try a different search.</p>
  @else 
    <ul>
      @foreach($questions as $question)
        <li>
          {{ link_to_route('question', $question->question, array($question->id)) }}
          by {{ ucfirst($question->user->username )}}
        </li>
      @endforeach 
    </ul>

    {{ $questions->links() }}
  @endif
@stop