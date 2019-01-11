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
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark navbar-laravel py-4 py-md-4">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('/img/logo.png') }}" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Request::is('/quienessomos') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/quienessomos') }}">Quiénes Somos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Noticias
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ url('/noticias') }}" style="color: #212529 !important;">Noticias</a>
                        <a class="dropdown-item" href="{{ url('/tiponoticias') }}" style="color: #212529 !important;">Tipo de Noticias</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Documentos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ url('/documentos') }}" style="color: #212529 !important;">Documentos</a>
                        <a class="dropdown-item" href="{{ url('/tipodocumentos') }}" style="color: #212529 !important;">Tipo de Documentos</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Eventos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ url('/eventos') }}" style="color: #212529 !important;">Eventos</a>
                        <a class="dropdown-item" href="{{ url('/tipoeventos') }}" style="color: #212529 !important;">Tipo de Eventos</a>
                        </div>
                    </li>
                    <li class="nav-item {{ Request::is('/tiponoticias/1') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/tiponoticias/1') }}">Prensa</a>
                    </li>
                    <li class="nav-item {{ Request::is('/voluntarios/create') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/voluntarios/create') }}">¡Haste parte!</a>
                    </li>
                    <li class="nav-item {{ Request::is('/contactanos') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/contactanos') }}">Contáctanos</a>
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
                    <h1>Primera Imagen</h1>
                    <p>Somos Construyendo Mis Sueños, una organización sin fines de lucro 
que busca potenciar el emprendimiento en Chile. </p>
                    <p><a class="btn btn-lg btn-primary" href="/quienessomos" role="button">Quiénes Somos</a></p>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <img class="second-slide" src="img/carousel2.jpg" alt="Second slide">
                <div class="container">
                  <div class="carousel-caption">
                    <h1>Segunda Imagen</h1>
                    <p>Somos Construyendo Mis Sueños, una organización sin fines de lucro 
que busca potenciar el emprendimiento en Chile. </p>
                    <p><a class="btn btn-lg btn-primary" href="/quienessomos" role="button">Quiénes Somos</a></p>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <img class="third-slide" src="img/carousel3.jpg" alt="Third slide">
                <div class="container">
                  <div class="carousel-caption text-right">
                    <h1>Tercera Imagen</h1>
                    <p>Somos Construyendo Mis Sueños, una organización sin fines de lucro 
que busca potenciar el emprendimiento en Chile. </p>
                    <p><a class="btn btn-lg btn-primary" href="/quienessomos" role="button">Quiénes Somos</a></p>
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
                  <strong class="d-inline-block mb-2 text-primary">{{$noticia->tiponoticia->nombre}}</strong>
                  <h3 class="mb-0">
                    <a class="text-dark" href="#">{{$noticia->titulo}}</a>
                  </h3>
                  <div class="mb-1 text-muted">{{Date::parse($noticia->fechaCreada)->format('l, j \d\e F \d\e Y')}}</div>
                  <p class="card-text mb-auto text-truncate"  style="max-width: 150px;">{{$noticia->contenido}}</p>
                  <a href="/noticias/{{$noticia->idNoticia}}">
                    continuar leyendo</a>
                </div>
                <img class="card-img-right flex-auto d-none d-md-block" alt="" text="{{$noticia->imagenPortada}}" style="width: 200px; height: 250px;" src="img/noticias/{{$noticia->imagenPortada}}" data-holder-rendered="true">
              </div>
            </div>
            @endforeach
        </div>
    @else
        <p>No Existen Noticias.</p>
    @endif

    </div>
        <!-- Footer -->
<footer class="page-footer font-small background-color: #6351ce;">

<div style="background-color: #e4e4e4;">
  <div class="container">

    <!-- Grid row-->
    <div class="row py-4 d-flex align-items-center">

      <!-- Grid column -->
      <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
        <h6 class="mb-0">¡Conéctate con nosotros en las redes sociales!</h6>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-6 col-lg-7 text-center text-md-right">

        <!-- Facebook -->
        <a class="fb-ic" href="https://www.facebook.com/construyendomissuenos/">
          <i class="fab fa-facebook white-text mr-4"></i>
        </a>
        <!-- Twitter -->
        <a class="tw-ic" href="https://twitter.com/ConstruMisSue">
          <i class="fab fa-twitter white-text mr-4"></i>
        </a>
        <!-- Google +-->
        <a class="gplus-ic" href="https://www.youtube.com/channel/UCnPLIVX-9JlsM45Vb8JKstA">
          <i class="fab fa-youtube white-text mr-4"></i>
        </a>
        <!--Instagram-->
        <a class="ins-ic" href="https://www.instagram.com/construyendomissuenos/">
          <i class="fab fa-instagram white-text"></i>
        </a>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

  </div>
</div>

<!-- Footer Links -->
<div class="container text-center text-md-left mt-5">

  <!-- Grid row -->
  <div class="row mt-3">

    <!-- Grid column -->
    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

      <!-- Content -->
      <h6 class="text-uppercase font-weight-bold">Construyendo Mis Sueños
</h6>
      <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p>Organización sin fines de lucro que busca potenciar el emprendimiento en Chile.</p>

    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

      <!-- Links -->
      <h6 class="text-uppercase font-weight-bold">
ENLACES ÚTILES</h6>
      <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p>
        <a href="/quienessomos">Quiénes Somos</a>
      </p>
      <p>
        <a href="/noticias">Noticias</a>
      </p>
      <p>
        <a href="/documentos">Documentos</a>
      </p>
      <p>
        <a href="/eventos">Eventos</a>
      </p>

    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-5 col-lg-5 col-xl-4 mx-auto mb-md-0 mb-4">

      <!-- Links -->
      <h6 class="text-uppercase font-weight-bold">Contáctenos</h6>
      <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p>
        <i class="fa fa-home mr-3"></i>Domeyko 2361, Santiago, Chile.</p>
      <p>
        <i class="fa fa-envelope mr-3"></i> comunicaciones@construyendomissuenos.cl</p>
      <p>
        <i class="fa fa-phone mr-3"></i> +56 2 2978 4060 – anexo 124</p>


    </div>
    <!-- Grid column -->

  </div>
  <!-- Grid row -->

</div>
<!-- Footer Links -->

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="http://construyendomissuenos.cl/"> ConstruyendoMisSuenos.cl</a>
</div>
<!-- Copyright -->

</footer>
<!-- Footer -->
</body>
</html>