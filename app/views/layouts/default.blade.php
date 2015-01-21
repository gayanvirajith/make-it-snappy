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
      {{ link_to_route('home', 'Make It Snappy Q&A' )}}  
    </div> <!-- end header -->

    <div id="nav">
      <ul>
        <li>{{ link_to_route('home', 'Home')}}</li>
        <li>{{ link_to_route('register', 'Register')}}</li>
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