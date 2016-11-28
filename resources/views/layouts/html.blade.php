<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>@yield('title') | Infinite Conflict</title>
        <meta name="description" content="The best online tick based strategy game">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">        
        <link href="//fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/vendor/font-awesome.css') }}" rel="stylesheet" type="text/css">
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        <header class="header">
            <div class="left">
                <h1>Infinite<span>Conflict</span></h1>
                <h2>Worlds to be conquered...</h2>
            </div>
            <div class="right">
                @if (!Auth::user())
                    <div class="login"><a href="/oauth/google/login">Login with Google</a></div>
                @else
                    <div class="login"><strong>{{ Auth::user()->name }}</strong> <a href="/logout">[Logout]</a></div>
                @endif
            </div>
        </header>

        @if (Auth::user())
            <div class="container">
                <nav class="menu main-menu">
                    <ul>
                        <li class="home @if(Request::segment(1) == '') active @endif"><a href="/"><span>Home</span></a></li>
                        <li class="planets @if(Request::segment(1) == 'planets') active @endif"><a href="/planets"><span>Planets</span></a></li>
                        <li class="fleets @if(Request::segment(1) == 'fleets') active @endif"><a href="/fleets"><span>Fleets</span></a></li>
                        <li class="navigation @if(Request::segment(1) == 'navigation') active @endif"><a href="/navigation"><span>Navigation</span></a></li>
                        <li class="research @if(Request::segment(1) == 'research') active @endif"><a href="/research"><span>Research</span></a></li>
                        <li class="alliances @if(Request::segment(1) == 'alliances') active @endif"><a href="/alliances"><span>Alliances</span></a></li>
                    </ul>
                </nav>
                <div class="headbar"></div>
            </div>
        @endif

        @if ($errors)
            <div class="container">
                <div class="alerts">
                    @foreach ($errors->all() as $error)
                        <div class="flash-error"><span>{{ $error }}</span></div>
                     @endforeach
                </div>
            </div>
        @endif

        <section class="content">
            <div class="container">
                <div id="app">
                    @yield('content')
                </div>
            </div>
        </section>

        <div class="container">
            <div class="footbar"></div>
        </div>


        <script src="/js/app.js"></script>
    </body>
</html>
