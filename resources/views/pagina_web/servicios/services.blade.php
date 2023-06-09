@include('pagina_web/header')

<div class="container">

  <h2>Servicios</h2>

  <!-- form -->
  <div class="row">
    <div class="col-sm-6 wowload fadeInUp">
      <div class="rooms"><img src="{{$servicios['Spa'][1]}}" class="img-responsive">
        <div class="info">
          <h3>Talise Spa</h3>
          <p>Vestida con una lujosa rapsodia de ricos materiales, esta suite de dos pisos y un dormitorio está diseñada para brindarle una experiencia inolvidable </p>
          <a href="{{route('pagina_web_servicio', ['id' => $servicios['Spa'][0]])}}" class="btn btn-default">Detalles</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6 wowload fadeInUp">
      <div class="rooms"><img src="{{$servicios['Gimnasio'][1]}}" class="img-responsive">
        <div class="info">
          <h3>Gimnasio</h3>
          <p>Incorpore la actividad física sin esfuerzo a su jornada laboral con nuestro centro de fitness y entrenamiento personal de última generación en Jumeirah Emirates Towers</p>
          <a href="{{route('pagina_web_servicio', ['id' => $servicios['Gimnasio'][0]])}}" class="btn btn-default">Detalles</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6 wowload fadeInUp">
      <div class="rooms"><img src="{{$servicios['Restaurante'][1]}}" class="img-responsive">
        <div class="info">
          <h3>Restaurante</h3>
          <p>Disfruta de nuestro restaurante con una exquisita experiencia gastronómica del Chef Andrea Migliaccio del ‘Ristorante L’Olivo’ de Capri, con dos estrellas Michelin.</p>
          <a href="{{route('pagina_web_servicio', ['id' => $servicios['Restaurante'][0]])}}" class="btn btn-default">Detalles</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6 wowload fadeInUp">
      <div class="rooms"><img src="{{$servicios['Parque_aquatico'][1]}}" class="img-responsive">
        <div class="info">
          <h3>Parque Acuático</h3>
          <p>Wild Wadi Waterpark™ le da la bienvenida a usted y a su familia para aventuras acuáticas inolvidables en uno de los parques acuáticos más icónicos de Dubái. </p>
          <a href="{{route('pagina_web_servicio', ['id' => $servicios['Parque_aquatico'][0]])}}" class="btn btn-default">Detalles</a>
        </div>
      </div>
    </div>
</div>
</div>
@include('pagina_web/footer')
