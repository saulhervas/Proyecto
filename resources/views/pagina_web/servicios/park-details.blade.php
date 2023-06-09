@include('pagina_web/header')

<div class="container">

  <h1 class="title">Wild Wadi Waterpark</h1>

  <!-- RoomDetails -->
  <div id="RoomDetails" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="item active"><img src="{{$servicio->fotos[1]->foto_web}}" class="img-responsive" alt="slide"></div>
    </div>
  </div>
  <!-- RoomCarousel-->

  <div class="room-features spacer">
    <div class="row">
      <div class="col-sm-12 col-md-5">
        <p>Wild Wadi Water Park es uno de los parques acuáticos más queridos de Dubái ya que fue uno de los primeros parques construidos en la ciudad.Además de las decenas de atracciones habituales de cualquier parque acuático,
          en Wild Wadi encontraréis un "simulador de surf" que hasta ahora no habíamos visto en otros parques.El balance perfecto para un día playero de relax y desconexión en pleno Dubai, ¡son las exclusivas atracciones y toboganes de agua que encontrarás en Wild Wadi Water Park!
          Desde las más Suaves, pasando por las opciones Moderadas, hasta las atracciones muy Intensas, para que todo el mundo encuentre su preferida. ¿Ya tienes tu flotador?</p>
          <h3>Nuestro parque no acaba con las atracciones. ¡Hay mucho más! </h3>
          <p>No te pierdas las actividades extra que Wild Wadi Water Park tiene por ofrecerte. Sumérgete con nosotros en este mar de actividades diferentes (y temporales), ¡y pásalo en grande!</p>
      </div>

      <div class="col-sm-6 col-md-3 amenitites">
        <h3>Servicios</h3>
        <ul>
          <li>Camas Balinesas.</li>
          <li>Consignas.</li>
          <li>Flotadores.</li>
          <li>Hamacas.</li>
          <li>Servicio Médico.</li>
          <li>Zona VIP.</li>
          <li>Zonas de Fumadores.</li>
          <li>The Flash Pass.</li>
        </ul>
      </div>

      <div class="col-sm-3 col-md-2">
        <div class="size-price">Precio<span>{{$servicio->precio}}€</span></div>
      </div>
    </div>
  </div>

</div>
@include('pagina_web/footer')
