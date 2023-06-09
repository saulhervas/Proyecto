@include('pagina_web/header')

<div class="container">

  <h1 class="title">Ristorante L'Olivo at Al Mahara</h1>

  <div id="RoomDetails" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="item active"><img src="{{$fotos->where('referencia_vista','portada')->first()->foto_web}}" class="img-responsive" alt="slide"></div>
    </div>
  </div>

  <div class="room-features spacer">
    <div class="row">
      <div class="col-sm-12 col-md-5">
        <p>El chef Andrea Migliaccio, director del único restaurante con dos estrellas Michelin en la elegante isla de Capri, acaba de traer su famoso Ristorante L'Olivo al espectacular restaurante Al Mahara del Dubai Kalifa.
        Sentarse en una mesa entre los acuarios de corales y probar los exquisitos platos de marisco que preparan en las cocinas del Capri Palace Jumeirah es toda una experiencia.</p>
        <p>El ambiente acuático acentuado con tonos dorados es un escenario perfecto para degustar los platos mediterráneos de conocido chef oriundo de Isquia. En esta experiencia gastronómica temporal podrá disfrutar de la misma atención al detalle
        y los mismos ingredientes de calidad superior que hacen famoso al L’Olivo original.</p>
      </div>

      <div class="col-sm-6 col-md-3 amenitites">
        <h3>HORARIO</h3>
        <ul>
          <li>9:00 - 0:00</li>
          <br>
        </ul>

        <h3>TIPO DE COMIDA</h3>
        <ul>
          <li>Comida italiana</li>
          <li>Pescados y mariscos</li>
          <li>Pizzas</li>
        </ul>

        <h3>POLITICA</h3>
        <ul>
          <li>No se permiten niños menores de 8 años</li>
        </ul>

      </div>

      <div class="col-sm-3 col-md-2">
        <div class="rest"><a target="_blank" href="https://cd-hospitality.jumeirah.com/-/mediadh/dh/hospitality/jumeirah/restaurants/dubai/burj-al-arab-mahara/restaurant-menu/menu/ristorantelolivofoodmenu.pdf?_gl=1*1j9z81t*_ga*NTk2ODM0MTU0LjE2NzY3MjI0NjQ.*_ga_KZ83V9NGDQ*MTY4MDY0OTg3Ny4xNS4xLjE2ODA2NTA5NDMuNjAuMC4w*_fplc*bHJkWVU4MUs5djJvblVGZjFObzFSb3huNGhBNmxaY1BOdjI1dWFNZU5HemhDbFhHanJReEp4NmpsaFBHS3lFTFBjNXUlMkZ0bWh3TlZzRVNIaHdqNWZWTUpDclZzbXRRSWM1aVJNWXZEVjFsaEFhS1NsbjlsUSUyQndyWUNtTmNRUSUzRCUzRA..">CARTA</a></div>
        <div class="rest"><a target="_blank" href="https://cd-hospitality.jumeirah.com/-/mediadh/dh/hospitality/jumeirah/restaurants/dubai/burj-al-arab-mahara/restaurant-menu/menu/ristorantelolivococktailmenu.pdf?_gl=1*1yldtyg*_ga*NTk2ODM0MTU0LjE2NzY3MjI0NjQ.*_ga_KZ83V9NGDQ*MTY4MDY0OTg3Ny4xNS4xLjE2ODA2NTE3MjYuNjAuMC4w*_fplc*bHJkWVU4MUs5djJvblVGZjFObzFSb3huNGhBNmxaY1BOdjI1dWFNZU5HemhDbFhHanJReEp4NmpsaFBHS3lFTFBjNXUlMkZ0bWh3TlZzRVNIaHdqNWZWTUpDclZzbXRRSWM1aVJNWXZEVjFsaEFhS1NsbjlsUSUyQndyWUNtTmNRUSUzRCUzRA..">BEBIDAS</a></div>
        <div class="rest"><a target="_blank" href="https://cd-hospitality.jumeirah.com/-/mediadh/dh/hospitality/jumeirah/restaurants/dubai/burj-al-arab-mahara/restaurant-menu/menu/ristorantelolivowinemenu.pdf?_gl=1*1jx5m7u*_ga*NTk2ODM0MTU0LjE2NzY3MjI0NjQ.*_ga_KZ83V9NGDQ*MTY4MDY0OTg3Ny4xNS4xLjE2ODA2NTE5NDUuNjAuMC4w*_fplc*bHJkWVU4MUs5djJvblVGZjFObzFSb3huNGhBNmxaY1BOdjI1dWFNZU5HemhDbFhHanJReEp4NmpsaFBHS3lFTFBjNXUlMkZ0bWh3TlZzRVNIaHdqNWZWTUpDclZzbXRRSWM1aVJNWXZEVjFsaEFhS1NsbjlsUSUyQndyWUNtTmNRUSUzRCUzRA..">VINOS</a></div>
      </div>

    </div>
  </div>
</div>
  </div>
</div>
@include('pagina_web/footer')
