@include('pagina_web/header')

<div class="container">

  <h1 class="title">Talise Spa</h1>

  <!-- RoomDetails -->
  <div id="RoomDetails" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="item active"><img src="{{$fotos->where('referencia_vista','portada2')->first()->foto_web}}" class="img-responsive" alt="slide"></div>
    </div>
  </div>
  <!-- RoomCarousel-->

  <div class="room-features spacer">
    <div class="row">
      <div class="col-sm-12 col-md-5">
        <p>Embárcate en un viaje de bienestar personal en nuestro Spa Privado. Con un diseño ingenioso y ecológicamente consciente, es el refugio perfecto para experimentar servicios relajantes y vigorizantes.
        El Spa ofrece una relajante escapada para relajarse y rejuvenecer. Disfrute de los tratamientos del spa innovadores que combinan ingredientes lujosos con la atención cuidadosa de nuestros profesionales.
        Un spa, también conocido como centro de spa o centro de hidroterapia, es un establecimiento sanitario que ofrece tratamientos, terapias o sistemas de relajación utilizando como elemento principal el agua.
        También se llama ‘spa’ a una pequeña piscina o bañera con diferentes tomas y desagües, usada como hidromasaje.</p>
        <p>En la actualidad, se aplica a todos aquellos establecimientos de ocio y salud, donde se utilizan terapias con agua, en las modalidades de piscinas, jacuzzis, hidromasajes, chorros y sauna sin que usen aguas medicinales, en cuyo caso se trataría de un balneario. </p>
      </div>
      <div class="col-sm-6 col-md-3 amenitites">
        <h3>TRATAMIENTOS</h3>
        <ul>
          <li>Tratamientos faciales.</li>
          <li>Barros.</li>
          <li>Limpieza de cutis.</li>
          <li>Manicura y pedicura.</li>
        </ul>
        <br>
        <h3>MASAJES</h3>
        <ul>
          <li>Relajante.</li>
          <li>Masaje circulatorio.</li>
          <li>Quiromasaje.</li>
          <li>Masaje con bambú.</li>
        </ul>
        <h3>HORARIO</h3>
        <ul>
          <li>Lunes - Domingo </li>
          <li>10:00 - 20:00</li>
        </ul>



      </div>
      <div class="col-sm-3 col-md-2">
        <div class="size-price">Precio<span>{{$servicio->precio}}€/h</span></div>
      </div>
    </div>
  </div>

</div>
@include('pagina_web/footer')
