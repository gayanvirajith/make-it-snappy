@extends('layouts.default')

@section('content')
  <h1>{{ ucfirst($question->user->username )}} asks: </h1>

  <p>
    {{{ $question->question }}}
  </p>
  
@stop