<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title> Dubai Kalifa </title>

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800|Old+Standard+TT' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800' rel='stylesheet' type='text/css'>

    <!-- font awesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap 4 -->
    <link href="{{asset("assets/$theme/plugins/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/estilos_web.css')}}">

    {{-- <!-- gallery -->
    <link rel="stylesheet" href="estilos/gallery/blueimp-gallery.min.css"> --}}

    <!-- favicon -->
    <link rel="shortcut icon" href="{{url('storage/pagina_web/dubai.png')}}" type="image/x-icon">
    <link rel="icon" href="{{url('storage/pagina_web/dubai.png')}}" type="image/x-icon">

</head>

<body id="home">

    <!-- header -->
    <nav class="navbar  navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('pagina_web')}}"><img src="{{url("storage/pagina_web/dubai.png")}}" alt="holiday crown"></a>
                <h1 class="navbar-brand-name">Dubai Kalifa</h1>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav">
                    <li><a href="{{route('pagina_web')}}">Inicio </a></li>
                    <li><a href="{{route('pagina_web_habitaciones')}}">Habitaciones y Tarifas</a></li>
                    <li><a href="{{route('pagina_web_servicios')}}">Servicios</a></li>
                    <li><a href="{{route('pagina_web_galeria')}}">Galeria</a></li>
                    <li><a href="{{route('pagina_web_introduccion')}}">Sobre Nosotros</a></li>
                    <li><a href="{{route('pagina_web_contacto')}}">Contacto</a></li>
                    @if (auth()->check())
                        <li><a href="{{route('logout')}}">Salir</a></li>
                    @else
                        <li><a href="{{route('pagina_web_registro')}}">Registrate</a></li>
                        <li><a href="{{route('pagina_web_login')}}">Identificate</a></li>
                    @endif
                </ul>
            </div><!-- Wnavbar-collapse -->
        </div><!-- container-fluid -->
    </nav>
    <!-- header -->
