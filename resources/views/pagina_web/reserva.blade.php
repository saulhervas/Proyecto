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
            @include('includes.form-error')
            @include('includes.mensaje')
            @include('includes.mensaje-error')
            <div class="col">
                <h3>Reservas</h3>
                <form action="{{route('pagina_web_reserva_guardar')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="col">
                        <div class="col">
                            <div class="form-group">
                                <label for="fecha_entrada">Entrada</label>
                                <input class="form-control" type="date" name="fecha_entrada" id="fecha_entrada" value="{{ old('fecha_entrada') }}">
                            </div>
                            <div class="form-group">
                                <label for="fecha_salida">Salida</label>
                                <input class="form-control" type="date" name="fecha_salida" id="fecha_salida" value="{{ old('fecha_salida') }}">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="num_habitaciones" id="num_habitaciones" placeholder="Nº habitaciones" value="{{ old('num_habitaciones') }}">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="number" name="num_adultos" id="num_adultos" class="form-control" placeholder="Nº Adultos" max="5" min="1" value="{{ old('num_adultos') }}">
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="number" name="num_ninios" id="num_ninios" class="form-control" placeholder="Nº Niños" max="5" value="{{ old('num_ninios')!=null ?  old('num_ninios') : 0 }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                @include('includes.input.select', ['nombre' => 'tipo_habitacion_id', 'title' => 'Tipo Habitación','label' => 4,'input' => 8, 'req' => 0, 'valores' => $habitaciones])
                            </div>
                            @include('includes.input.hidden', ['nombre' => 'cliente_id', 'data' => $cliente])

                            <div class="card p-3">
                                <label>Servicios</label>
                                <div class="form-group row">
                                    @foreach ($servicios as $key => $value)
                                        <div class="custom-control custom-checkbox offset-md-1 col-lg-2" >
                                            <input class="custom-control-input" type="checkbox" name="servicio[]" id="{{$value}}" value="{{$key}}"
                                            {{ isset($data) ? ( isset($data->servicio) ? ($data->servicio->firstWhere('id', $key) ? 'checked' : ''): ''): ''}}>
                                            <label for="{{$value}}" class="custom-control-label">{{ucfirst(str_replace('_',' ',$value))}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
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
