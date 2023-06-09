@include('pagina_web/header')

<div class="container">

    <h2>Habitaciones y Tarifas</h2>

  <!-- form -->
    <div class="row">
        @foreach ($habitaciones as $habitacion)
            <div class="col-sm-6 wowload fadeInUp">
                <div class="rooms"><img src="@if(count($habitacion->fotos)!=0){{$habitacion->fotos[0]->foto_web}}@endif" alt="imagen no encontrada" class="img-responsive">
                    <div class="info">
                        <h3>{{$habitacion->nombre}}</h3>
                        <p>{{explode('.',$habitacion->descripcion)[0]}}</p>
                        <a href="{{route('pagina_web_habitacion', ['id'=> $habitacion->id])}}" class="btn btn-default">Detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
{{-- <h3>Deluxe Marina Suite</h3>
<p>Vestida con una lujosa rapsodia de ricos materiales, esta suite de dos pisos y un dormitorio está diseñada para brindarle una experiencia inolvidable </p>
<a href="room-details.php" class="btn btn-default">Detalles</a> --}}
    {{-- <div class="col-sm-6 wowload fadeInUp">
      <div class="rooms"><img src="images/photos/habitacion2.jpg" class="img-responsive">
        <div class="info">
          <h3>Deluxe Palm Suite</h3>
          <p>Contemple las vistas de la icónica Palm Jumeirah desde su espaciosa sala de estar o desde la suprema comodidad de su dormitorio en el segundo piso.</p>
          <a href="room-details.php" class="btn btn-default">Detalles</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6 wowload fadeInUp">
      <div class="rooms"><img src="images/photos/habitacion3.jpg" class="img-responsive">
        <div class="info">
          <h3>Sky Marina Suite</h3>
          <p>Habitaciones ubicadas en los pisos superiores, estas suites dúplex ofrecen a parejas o familias pequeñas vistas aparentemente infinitas del océano.   </p>
          <a href="room-details.php" class="btn btn-default">Detalles</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6 wowload fadeInUp">
      <div class="rooms"><img src="images/photos/habitacion4.jpg" class="img-responsive">
        <div class="info">
          <h3>Sky Palm Suite</h3>
          <p>Contemple el horizonte de Dubai Marina y la icónica Palm Jumeirah desde la exclusividad de las ventanas del piso al techo de su suite dúplex.      </p>
          <a href="room-details.php" class="btn btn-default">Detalles</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6 wowload fadeInUp">
      <div class="rooms"><img src="images/photos/habitacion5.jpg" class="img-responsive">
        <div class="info">
          <h3>Panoramic Suite</h3>
          <p>Esta amplia suite ofrece comodidad, conveniencia y privacidad. Su lujoso ambiente tipo loft y sus hermosas vistas de Dubái y el océano hacen que esta suite sea verdaderamente memorable.</p>
          <a href="room-details.php" class="btn btn-default">Detalles</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6 wowload fadeInUp">
      <div class="rooms"><img src="images/photos/habitacion6.jpg" class="img-responsive">
        <div class="info">
          <h3>Deluxe Two Bedroom Suite</h3>
          <p>Habitacion con decoración inspirada en el océano y vistas al golfo Pérsico. Siéntase como en casa en esta suite familiar, que cuenta con un área de juegos para los más pequeños.</p>
          <a href="room-details.php" class="btn btn-default">Detalles</a>
        </div>
      </div>
    </div> --}}
</div>
</div>
@include('pagina_web/footer')
