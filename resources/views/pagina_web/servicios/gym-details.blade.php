@include('pagina_web/header')

<div class="container">

  <h1 class="title">Fitness Centre</h1>

  <!-- RoomDetails -->
  <div id="RoomDetails" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="item active"><img src="{{$fotos->where('referencia_vista','principal')->first()->foto_web}}" class="img-responsive" alt="slide"></div>
    </div>
  </div>
  <!-- RoomCarousel-->

  <div class="room-features spacer">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <p>En nuestro gimnasio encontrarás maquinaria de última generación de Matrix y TechnoGym. ¡Todo lo que necesitas para un perfecto entrenamiento! Además, cuidamos de la higiene y un entorno limpio y saludable, lo cual es importantísimo en estos momentos.
            Entrena de forma libre en la sala de fitness o sigue nuestras clases colectivas presenciales y virtuales GXR en las salas destinadas para ello.
            Apuntarse al gimnasio es el primer gran paso; ahora te toca buscar tu rutina. Porque si estás motivado, estarás en el camino correcto para conseguirlo.
            Por eso, después de una buena dosis informativa online, los nuevos socios reciben un entrenamiento personal para las 6 primeras semanas de gym con el fin de que tengan el mejor comienzo.</p>
      </div>

      <div class="col-sm-12 col-md-5 amenitites">
        <h3>PERSONAL TRAINERS</h3>
        <p>¿Tienes un objetivo deportivo en mente y necesitas ayuda para alcanzarlo? Contacta con uno de nuestros entrenadores personales en tu gym.
        Utiliza la barra de búsqueda que tienes arriba para descubrir todos los perfiles y entrenadores disponibles, y así encontrar tu mejor opción basada en tus preferencias y objetivos.
        Cada uno tiene una especialidad y un método de trabajo, y todos son entrenadores certificados.</p>
      </div>

      <div class="col-sm-12 col-md-6 amenitites">
        <img src="{{$fotos->where('referencia_vista','entrenador1')->first()->foto_web}}" class="img-responsive" alt="slide">
      </div>

      <div class="col-sm-12 col-md-5 amenitites">
        <h3>SOPORTE</h3>
        <p>Nuestro gimnasio te ofrece ayuda extra de fitness. La primera: "Personal Training Intro". Una sesión introductoria al entrenamiento personal en la que un entrenador personal cualificado te guiará en tu plan y objetivos durante 60 minutos.
        Gracias a sus conocimientos y ayuda disfrutarás más de tu entrenamiento, conseguirás resultados más rápidos y reducirás el riesgo de lesiones.
        Otra opción es el "Personal Online Coach", un servicio de entrenamiento personal online en el que recibirás la ayuda de un entrenador certificado a través de la app.
        Recibirás un programa de entrenamiento personalizado de 12 semanas, consejos sobre nutrición y estilo de vida, y también tendrás controles semanales con tu entrenador personal.</p>
      </div>

      <div class="col-sm-12 col-md-6 amenitites">
        <img src="{{$fotos->where('referencia_vista','entrenador2')->first()->foto_web}}" class="img-responsive" alt="slide">
      </div>

      <div class="col-sm-12 col-md-5 amenitites">
        <h3>FISITERAPEUTA</h3>
        <p>¿Sientes dolor o molestias, o te estás recuperando de una lesión? Nos encantaría poder ofrecerte los servicios de un fisioterapeuta en tu gym,
        que trabaja de manera externa para que puede ayudarte. Mira todas las opciones y personal disponible en la barra de búsqueda de arriba.</p>
      </div>

      <div class="col-sm-12 col-md-6 amenitites">
        <img src="{{$fotos->where('referencia_vista','entrenador3')->first()->foto_web}}" class="img-responsive" alt="slide">
      </div>

    </div>
  </div>

</div>
@include('pagina_web/footer')
