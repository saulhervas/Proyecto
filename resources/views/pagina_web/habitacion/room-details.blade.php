@include('pagina_web/header')

<div class="container">

    <h1 class="title">{{$habitacion->nombre}}</h1>

    <!-- RoomDetails -->
    <div id="RoomDetails" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active"><img src="@if(count($habitacion->fotos)!=0){{$habitacion->fotos[0]->foto_web}}@endif" class="img-responsive" alt="slide"></div>
        </div>
    </div>
    <!-- RoomCarousel-->

    <div class="room-features spacer">
        <div class="row">
            <div class="col-sm-12 col-md-5"><p>{!! nl2br($habitacion->descripcion)!!}</p></div>
            <div class="col-sm-6 col-md-3 amenitites">
                <h3>Comodidades</h3>
                <ul>
                    <li>Servicio de mayordomo de clase mundial y conserjería las 24 horas.</li>
                    <li>Sala de estar privada con tocador exclusivo.</li>
                    <li>Un baño principal completo con un jacuzzi de tamaño completo y una ducha de lluvia separada de
                        cinco cabezales.</li>
                    <li>Entorno controlado a distancia que incluye cortinas, TV, música y luces.</li>
                    <li>Acceso a las instalaciones de nuestro icónico spa y a nuestra playa privada.</li>
                </ul>
            </div>
            <div class="col-sm-3 col-md-2">
                <div class="size-price">Tamaño<span>{{$habitacion->tamanio}}m<sup>2</sup></span></div>
            </div>
            <div class="col-sm-3 col-md-2">
                <div class="size-price">Precio/noche<span>{{$habitacion->precio}}€</span></div>
            </div>
        </div>
    </div>

</div>
@include('pagina_web/footer')
