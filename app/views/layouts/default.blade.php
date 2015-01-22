<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{{ $title }}}</title>
  {{ HTML::style('css/main.css') }}
</head>
<body>
  <div id="container">
    
    <div id="header">
      {{ link_to_route('home', Lang::get('messages.appName') ) }}
      <div id="searchbar">
        {{ Form::open(array('route' => 'search')) }}
          <?php $keyword = (isset($keyword))? $keyword : "" ?>
          {{ Form::text('keyword', isset($keyword) ? $keyword : '', array('placeholder' => 'Search')) }}
          {{ Form::submit('Search') }}
        {{ Form::close() }}
      </div>    
    </div> <!-- end header -->

    <div id="nav">
      <ul>
        <li>{{ link_to_route('home', 'Home')}}</li>
        @if (!Auth::check() )
          <li>{{ link_to_route('register', Lang::get('messages.register'))}}</li>
          <li>{{ link_to_route('login', Lang::get('messages.login'))}}</li>
        @else 
          <li>
            {{ link_to_route('yourQuestions', 'Your Q\'s')}}
          </li>
          <li>{{ link_to_route('logout', Lang::get('messages.logout', array('name' => Auth::user()->username ))) }}</li>
        @endif
      </ul>
    </div><!-- end nav -->

    <div id="content">
      @if(Session::has('message'))
        <p id="message">{{ Session::get('message') }}</p>
      @endif

      @yield('content')

    </div><!-- content -->

    <div id="footer">
      &copy; {{{ Lang::get('messages.appName') }}} {{{ date('Y') }}}.
    </div>

  </div> <!-- end container -->
</body>
</html>