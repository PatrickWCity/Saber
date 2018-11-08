<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="img/touch-icon-iphone.png" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset(mix('js/manifest.js')) }}"></script>
        <script src="{{ asset(mix('js/vendor.js')) }}"></script>
        <script src="{{ asset(mix('js/app.js')) }}"></script>

        <script src="{{ asset('/js/holder.min.js') }}"></script>
        <script src="{{ asset('/js/offcanvas.js') }}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{ asset('/css/carousel.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/offcanvas.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <!--<nav class="navbar navbar-expand-md navbar-light navbar-laravel">-->
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('/img/logo.png') }}" alt="logo" style="height:27px;">
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
                            <li class="nav-item {{ Request::is('/documentos') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/documentos') }}">Documentos</a>
                              </li>
                          <li class="nav-item {{ Request::is('/eventos') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/eventos') }}">Eventos</a>
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
                                    <a class="dropdown-item " href="{{ route('logout') }}"
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
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1" class=""></li>
              <li data-target="#myCarousel" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="first-slide" src="img/carousel1.jpg" alt="First slide">
                <div class="container">
                  <div class="carousel-caption text-left">
                    <h1>Primer Ejemplo.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Ejemplo 1</a></p>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <img class="second-slide" src="img/carousel2.jpg" alt="Second slide">
                <div class="container">
                  <div class="carousel-caption">
                    <h1>Segundo Ejemplo.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Ejemplo 2</a></p>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <img class="third-slide" src="img/carousel3.jpg" alt="Third slide">
                <div class="container">
                  <div class="carousel-caption text-right">
                    <h1>Tercer Ejemplo.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Ejemplo 3</a></p>
                  </div>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    </div>
    <div class="container">
        <h1>Noticias</h1>
        @if(count($noticias) > 0)  
        <p>Las Ultimas Noticias</p>
        <div class="row mb-2">
            @foreach($noticias as $noticia)
            <div class="col-md-6">
              <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                  <strong class="d-inline-block mb-2 text-primary">{{$noticia->TipoNoticia}}</strong>
                  <h3 class="mb-0">
                    <a class="text-dark" href="#">{{$noticia->titulo}}</a>
                  </h3>
                  <div class="mb-1 text-muted">{{Date::parse($noticia->fechaCreada)->format('l, j \d\e F \d\e Y')}}</div>
                  <p class="card-text mb-auto">{{$noticia->contenido}}</p>
                  <a href="/noticias/{{$noticia->idNoticia}}">
                    continuar leyendo</a>
                </div>
                <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="" text="{{$noticia->imagenPortada}}" style="width: 200px; height: 250px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_166e7284025%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_166e7284025%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.203125%22%20y%3D%22131%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
              </div>
            </div>
            @endforeach
        </div>
    @else
        <p>No Existen Noticias.</p>
    @endif

    </div>
</body>
</html>