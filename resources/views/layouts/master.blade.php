<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="apple-touch-icon" href="img/touch-icon-iphone.png" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel de Administración | CMS</title>
    <!-- Styles -->
    <style>.sidebar {
      padding-bottom: 0;
      padding-top: 0;
      padding-left: .5rem;
      padding-right: .5rem;
      overflow: hidden;
      height: 100vh;
  }
  
  .main-sidebar > .sidebar > nav {
      margin-right: -25px;
      padding-right: 22px;
      overflow-y: auto;
      height: calc(100% - 5.2rem);
  }
  </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/datatables.min.css"/>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navnar-dark bg-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Página Principal</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <router-link to="/home" class="nav-link">Dashboard</router-link>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="overflow-x: hidden;">
    <!-- Brand Logo -->
    <router-link to="/home" class="brand-link">
      <img src="./img/logo-navbar.png" alt="CMS Logo" class="brand-image img-circle"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CMS v0.4.12</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/profile/{{ Auth::user()->foto }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          @guest
          <a href="/login" class="d-block">Debe Iniciar Seccion</a>
          @else
          <router-link to="/cuenta" class="d-block">{{ Auth::user()->username }}</router-link>
          @endguest
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item">
                <router-link to="/dashboard" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </router-link>
              </li>
              @can('esAdmin')
              
              <li class="nav-item">
                  <router-link to="/documento" class="nav-link" active-class="active">
                    <i class="nav-icon far fa-file-alt"></i>
                    <p>
                      Documentos
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/tipodocumento" class="nav-link" active-class="active">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                      Tipo de Documentos
                    </p>
                  </router-link>
                </li>
                @endcan
                @canany(['esAdmin','esOrganizador'])
                <li class="nav-item">
                    <router-link to="/evento" class="nav-link" active-class="active">
                      <i class="nav-icon far fa-calendar-check"></i>
                      <p>
                        Eventos
                      </p>
                    </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/tipoevento" class="nav-link" active-class="active">
                    <i class="nav-icon fas fa-calendar"></i>
                    <p>
                      Tipo de Eventos
                    </p>
                  </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/area" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-map-marker-alt"></i>
                  <p>
                    Areas
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/sede" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-building"></i>
                  <p>
                    Sedes
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/expositor" class="nav-link" active-class="active">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>
                    Expositores
                  </p>
                </router-link>
              </li>
                @endcanany
                @canany(['esAdmin','esAutor'])
                <li class="nav-item">
                  <router-link to="/noticia" class="nav-link" active-class="active">
                    <i class="nav-icon far fa-newspaper"></i>
                    <p>
                      Noticias
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/tiponoticia" class="nav-link" active-class="active">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                      Tipo de Noticias
                    </p>
                  </router-link>
                </li>
                @endcanany
                @can('esAdmin')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link" :class="{'active': subIsActive(['/usuario', '/modulo', '/submodulo', '/perfil'])}">
                  <i class="nav-icon fas fa-wrench"></i>
                  <p>
                    Mantenedores
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <router-link to="/usuario" class="nav-link" active-class="active">
                      <i class="fas fa-users nav-icon"></i>
                      <p>Usuarios</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link to="/perfil" class="nav-link" active-class="active">
                      <i class="fas fa-tags nav-icon"></i>
                      <p>Perfiles</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                      <router-link to="/modulo" class="nav-link" active-class="active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Módulos</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/submodulo" class="nav-link" active-class="active">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Submódulos</p>
                        </router-link>
                      </li>
                </ul>
              </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link" :class="{'active': subIsActive(['/perfilusuario', '/moduloperfil', '/submodulomodulo'])}">
                      <i class="nav-icon fas fa-tasks"></i>
                      <p>
                        Asignadores
                        <i class="right fa fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <router-link to="/perfilusuario" class="nav-link" active-class="active">
                          <i class="fas fa-user-tag nav-icon"></i>
                          <p>Perfiles de Usuario</p>
                        </router-link>
                      </li>
                      <li class="nav-item">
                        <router-link to="/moduloperfil" class="nav-link" active-class="active">
                          <i class="fas fa-circle-notch nav-icon"></i>
                          <p>Módulos de Perfil</p>
                        </router-link>
                      </li>
                      <li class="nav-item">
                          <router-link to="/submodulomodulo" class="nav-link" active-class="active">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Submódulos de Módulos</p>
                          </router-link>
                        </li>
                    </ul>
                </li>
                

                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link" :class="{'active': subIsActive(['/habilitarusuario', '/deshabilitarusuario', '/usuariopendiente'])}">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>
                      Consultas
                      <i class="right fa fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link to="/deshabilitarusuario" class="nav-link" active-class="active">
                        <i class="fas fa-user-check nav-icon"></i>
                        <p>Usuarios Habilitados</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="/habilitarusuario" class="nav-link" active-class="active">
                        <i class="fas fa-user-times nav-icon"></i>
                        <p>Usuarios Deshabilitados</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/usuariopendiente" class="nav-link" active-class="active">
                          <i class="far fa-user nav-icon"></i>
                          <p>Usuarios Pendientes</p>
                        </router-link>
                      </li>
                  </ul>
              </li>
              @endcan
              @canany(['esDev','esAdmin'])
                    <li class="nav-item">
                      <router-link to="/desarrollador" class="nav-link" active-class="active">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Desarrollador</p>
                      </router-link>
                    </li>
              @endcanany
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>{{ __('Cerrar Sección') }}</p>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                  </li>
            </ul>
          </nav>
    
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- router view -->
    <router-view></router-view>
    <!-- set progressbar -->
    <vue-progress-bar></vue-progress-bar>
  </div>
  <!-- /.content-wrapper -->

  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      CMS v0.4.12
    </div>
    <!-- Default to the left -->
    <strong>Segundo Estado de Avance <i class="fas fa-chess-knight"></i> <a href="https://dev.patrickwcity.com">Proyecto de Titulo</a>.</strong> Hecha de manera Clara, Precisa y Concisa con <i class="fas fa-heart"></i>.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Scripts -->
@auth
    <script>
    window.user =@json(auth()->user()->roles)
    </script>
@endauth

<script src="/js/manifest.js"></script>
<script src="/js/vendor.js"></script>
<script src="/js/app.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/datatables.min.js"></script>
</body>
</html>