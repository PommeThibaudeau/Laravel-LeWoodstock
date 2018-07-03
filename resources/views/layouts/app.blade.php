<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Chosen -->
    <script src="{{ asset('js/chosen/chosen.jquery.min.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/chosen/chosen-bootstrap.css') }}" rel="stylesheet" type="text/css">

    <!-- Global -->
    <link rel="icon" href="/storage/global/favicon.ico" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light nav-colored">
            <div class="container">
                @auth
                    <a class="navbar-brand nav-colored__home-title" href="{{ url('/home') }}">
                        {{ config('app.name') }}
                    </a>
                @else
                    <a class="navbar-brand nav-colored__home-title" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                @endauth

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link nav-colored__page-title" href="{{ route('articles.index') }}">{{ __('Articles') }}</a>
                        </li>

                        @auth
                            <li class="nav-item">
                                <a class="nav-link nav-colored__page-title" href="{{ route('matters.index') }}">{{ __('Matieres') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-colored__page-title" href="{{ route('types.index') }}">{{ __('Types') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-colored__page-title" href="{{ route('images.index') }}">{{ __('Images') }}</a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="info">
          @if(session('message') !== null)
            @if(is_array(session('message')) && session('message')[0] === 'error')
                <div class="alert alert-danger">
                    <strong>{{ session('message')[1] }}</strong>
                </div>
            @else
                <div class="alert alert-info">
                  <strong>{{ session('message') }}</strong>
                </div>
            @endif
          @endif
        </div>
        <div class="parallax"></div>

        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>

        <footer class="page-footer font-small blue pt-4 mt-4 footer-colored">

            <!-- Footer Links -->
            <div class="container-fluid text-center text-md-left">

                <!-- Grid row -->
                <div class="row">

                    <!-- Grid column -->
                    <div class="col-md-6 mt-md-0 mt-3">
                        <p>Here you can use rows and columns here to organize your footer content.</p>
                    </div>

                    <hr class="clearfix w-100 d-md-none pb-3">
                </div>
            </div>

        </footer>
        <!-- Footer -->
    </div>
</body>
<script>
    $( document ).ready(function() {
        $(".chosen-select").chosen();
    });
</script>
</html>
