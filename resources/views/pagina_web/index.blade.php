@include('pagina_web/header')

<!-- banner -->
<div class="banner">
    <img src={{$fotos['index']}} class="img-responsive" alt="slide">
    <div class="welcome-message">
        <div class="wrap-info">
            <div class="information">
                <h1 class="animated fadeInDown">Best hotel in Dubai</h1>
                <p class="animated fadeInUp">Most luxurious hotel of asia with the royal treatments and excellent customer service.</p>
            </div>
            <a href="#information" class="arrow-nav scroll wowload fadeInDownBig"><i class="fa fa-angle-down"></i></a>
        </div>
    </div>
</div>
<!-- banner-->

<!-- reservation-information -->
<div id="information" class="spacer reserve-info">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-md-8">
                <div class="embed-responsive embed-responsive-16by9 wowload fadeInLeft"><iframe class="embed-responsive-item" src="https://player.vimeo.com/video/342658137?autoplay=1&loop=1&title=0&byline=0&portrait=0&muted=true&dnt=true&background=1" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="alert-text">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
            @include('includes.form-error')
            @include('includes.mensaje')
            @include('includes.mensaje-error')
            <div class="col-sm-5 col-md-4">
                <h3>Reservas</h3>
                @if (auth()->check())
                    <form action="{{route('pagina_web_periodo')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fecha_entrada">Entrada</label>
                            <input class="form-control" type="date" name="fecha_entrada" id="fecha_entrada">
                        </div>
                        <div class="form-group">
                            <label for="fecha_salida">Salida</label>
                            <input class="form-control" type="date" name="fecha_salida" id="fecha_salida">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="num_habitaciones" id="num_habitaciones" placeholder="Nº habitaciones">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <input type="number" name="num_adultos" id="num_adultos" class="form-control" placeholder="Nº Adultos" max="5" min="1">
                                </div>
                                <div class="col-xs-6">
                                    <input type="number" name="num_ninios" id="num_ninios" class="form-control" placeholder="Nº Niños" max="5">
                                </div>
                            </div>
                        </div>
                @else
                    <form action="{{route('login_post2')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                        <label>Identificate</label>
                    <div class="form-group">
                        <input type="text" name="usuario" class="form-control" id="nombre" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña">
                    </div>
                @endif
                    @csrf
                    <button class="btn btn-default">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="spacer services wowload fadeInUp">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <!-- RoomCarousel -->
                <div id="RoomCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active"><img src="{{$fotos['habitacion']}}" class="img-responsive" alt="slide"></div>
                    </div>
                </div>
                <!-- RoomCarousel-->
                <div class="caption">Habitaciones<a href="{{route('pagina_web_habitaciones')}}" class="pull-right"><i class="fa fa-edit"></i></a></div>
            </div>


            <div class="col-sm-4">
                <!-- RoomCarousel -->
                <div id="TourCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active"><img src={{$fotos['lifestyle']}} class="img-responsive" alt="slide"></div>
                    </div>
                </div>
                <!-- RoomCarousel-->
                <div class="caption">Lifestyle<a href="{{route('pagina_web_servicios')}}" class="pull-right"><i class="fa fa-edit"></i></a></div>
            </div>


            <div class="col-sm-4">
                <!-- RoomCarousel -->
                <div id="FoodCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active"><img src="{{$fotos['comida']}}" class="img-responsive" alt="slide"></div>
                    </div>
                </div>
                <!-- RoomCarousel-->
                <div class="caption">Comida y bebida<a href="{{route('pagina_web_galeria')}}" class="pull-right"><i class="fa fa-edit"></i></a></div>
            </div>
        </div>
    </div>
</div>
<!-- services -->
@include('pagina_web/footer')
