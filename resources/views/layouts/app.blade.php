<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CMADMIN 2.0 | @yield('title')</title>

    <link rel="icon" type="image/png" href="{{asset('favicon.png')}}" />

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    @yield('styles')

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="fixed-sidebar">

<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold">selpeca</span>
                            <span class="text-muted text-xs block">Más <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="{{route('/')}}">Salir</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li id="Inicio">
                    <a href="{{route('dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Principal</span></a>
                </li>                
                <li id="Productos">
                    <a href="{{route('productos.index')}}"><i class="fa fa-list-alt"></i> <span class="nav-label">Productos</span></a>                    
                </li>
                <li id="Lotes">
                        <a href="{{route('lotes.index')}}"><i class="fa fa-barcode"></i> <span class="nav-label">Lotes</span></a>                    
                </li>                
                <li id="Clientes">
                    <a href="{{route('clientes.index')}}"><i class="fa fa-users"></i> <span class="nav-label">Clientes</span></a>
                </li>
                <li id="Usuarios">
                    <a href="{{route('usuarios.index')}}"><i class="fa fa-user"></i> <span class="nav-label">Usuarios</span></a>
                </li>
                <li class="special_link" id="Ventas">
                    <a href="{{route('vender.create')}}"><i class="fa fa-money"></i> <span class="nav-label">Vender</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>                    
                </div>
                <div class="center">
                    <h2 class="">CMADMIN 2.0</h2>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="{{route('vender.create')}}">
                            <i class="fa fa-money"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('/')}}">
                            <i class="fa fa-sign-out"></i> Salir
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="pull-right">
                <strong>Grupo 2</strong>  - Sistemas de información.
            </div>
            <div>
                <strong>Copyright</strong> &copy; 2018
            </div>
        </div>

    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- Custom and plugin javascript -->
<script src="{{asset('js/inspinia.js')}}"></script>
<script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>
<!-- Sweet alert -->
<script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('js/scripts.js')}}"></script>
<script>
$( document ).ready(function() {
    $('#<?php echo $title; ?>').addClass('active');
});
</script>

@yield('script')

</body>

</html>