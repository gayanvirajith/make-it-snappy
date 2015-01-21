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
      {{ HTML::link('/', 'Make It Snappy Q&A' )}}  
    </div> <!-- end header -->

    <div id="nav">
      <ul>
        <li>{{ HTML::link('/', 'Home')}}</li>
        <li>{{ HTML::link('/', 'Register')}}</li>
        <li>{{ HTML::link('/', 'Login')}}</li>
      </ul>
    </div><!-- end nav -->

    <div id="content">
      @if(Session::has('message'))
        <p id="message">{{ Session::get('message') }}</p>
      @endif

      @yield('content')

    </div><!-- content -->

    <div id="footer">
      &copy; Make It Snappy Q&A {{{ date('Y') }}}.
    </div>

  </div> <!-- end container -->
</body>
</html>