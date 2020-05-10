<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/bd6d7b078c.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body style="background-color: #F2F6FF; overflow-x: hidden;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div class="float-right">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                        @guest
                        @else
                        @if (\Request::is('settings'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('settings')}}"><i class="fas fa-sliders-h"></i> Settings</a>
                        </li>
                        @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div style="height: 2px; width: 100%; background-color: #3490DC;"></div>
        @yield('auth')
        <div class="container-fluid" style="background-color: #F2F6FF;">
            <div class="row">
                <nav class="col-md-3 d-none d-lg-block sidebar border-right">
                    <div class="sidebar-sticky">
                        @yield('customsidebar')
                    </div>
                </nav>
                <main style="padding-right: 0px!important; height: 100%;" role="main" class="col-md-9 col-lg-9 px-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/acordion.js') }}" defer></script>
    <script src="{{ asset('js/datepicker.js') }}" defer></script>
    <script src="{{ asset('js/search.js') }}" defer></script>
</body>

</html>