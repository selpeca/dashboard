<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMAdmin 2.0 | Login</title>
    <link rel="icon" type="image/png" href="{{asset('favicon.png')}}" />
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/estilos.css')}}" rel="stylesheet">
        <!-- Mainly scripts -->
        <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.js')}}"></script>
        <script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen">
        <div>
            <div class="logo-login mb-5">
                <img src="{{asset('img/Casa-Musical.png')}}">
            </div>
            <h3>CM Admin 2.0</h3>
            @yield('content')
            <p class="m-t"> <small>Derechos reservador &copy; 2018</small> </p>
        </div>
    </div>

    @yield('scripts')    
</body>

</html>
