<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="img/touch-icon-iphone.png" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset(mix('js/manifest.js')) }}"></script>
    <script src="{{ asset(mix('js/vendor.js')) }}"></script>
    <script src="{{ asset(mix('js/app.js')) }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <!--<nav class="navbar navbar-expand-md navbar-light navbar-laravel">-->
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('/img/logo.png') }}" alt="logo" style="height:27px;">
                   <!-- {{ config('app.name', 'Construyendo Mis Sueños') }} -->
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ Request::is('/noticias') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/noticias') }}">Noticias</a>
                          </li>
                          <li class="nav-item {{ Request::is('/tiponoticias') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/tiponoticias') }}">TipoNoticias</a>
                          </li>
                        <li class="nav-item {{ Request::is('/documentos') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/documentos') }}">Documentos</a>
                          </li>
                          <li class="nav-item {{ Request::is('/tipodocumentos') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/tipodocumentos') }}">TipoDocumentos</a>
                          </li>
                      <li class="nav-item {{ Request::is('/eventos') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/eventos') }}">Eventos</a>
                      </li>
                      <li class="nav-item {{ Request::is('/tipoeventos') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/tipoeventos') }}">TipoEventos</a>
                      </li>
                      <li class="nav-item {{ Request::is('/voluntarios') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/voluntarios') }}">Voluntario</a>
                      </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/home" style="color: #212529 !important;">
                                        Dashboard
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="color: #212529 !important;">
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

        <main class="py-4">
            @include('inc.messages')
            @yield('content')
        </main>
    </div>
</body>
</html>
