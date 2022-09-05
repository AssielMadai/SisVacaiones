<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gustov | </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Datatables -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="{{asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('adminlte/img/restaurant.png')}}" alt="GADCLogo" height="180"
             width="180">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            <li class="nav-item dropdown user-menu">
                <a href="#cerrar" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <span
                        class="d-none d-md-inline"> {{Auth::user()->primerNombre.' '.Auth::user()->apellidoPaterno}} <small>{{ Auth::user()->getRoleNames()}}</small></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="cerrar">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->primerNombre.' '.Auth::user()->segundoNombre.' '.Auth::user()->apellidoPaterno.' '.Auth::user()->apellidoMaterno}}
                            <small>{{ Auth::user()->getRoleNames()}}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @else
                        <div class="text-center">
                            <a class="dropdown-item" href="{{ route('logout') }}" role="button"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Cerrar sesión') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endguest
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('home')}}" class="brand-link" style="text-align: center">
            <img src= "{{asset('adminlte/img/restaurant.png')}}" alt="GADCLogo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light" ><strong style="font-size:larger; font-weight: 1000;">GUSTOV</strong></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- SidebarSearch Form -->
            <div class="form-inline mt-2">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                           aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @can('verUusuario')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users fa-fw"></i>
                            <p>
                                Usuarios
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('vistaCrearUsuario')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registrar Usuarios</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('verListaUsuario')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ver Usuario</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-blue text-bold">@yield('title')</h1>
{{--                        Informacion Ambiental--}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                            @yield('barraTareas')
{{--                            <li class="breadcrumb-item active">Projects</li>--}}
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            {{--                <div class="row">--}}
            @yield('content')
            <!-- ./col -->
            {{--                </div>--}}
            <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Restaurant Gustov</strong>

{{--        <div class="float-right d-none d-sm-inline-block">--}}
{{--            <b>Version</b> 3.1.0--}}
{{--        </div>--}}

    </footer>
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('adminlte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/moment/moment.min.js')}}"></script>
{{--<script src="adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>--}}

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- GADC App -->
<script src="{{asset('adminlte/js/adminlte.js')}}"></script>
@yield('js')

</body>
</html>
