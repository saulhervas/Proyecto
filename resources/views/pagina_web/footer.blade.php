<footer class="spacer">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <h4>Dubai Kalifa</h4>
                <p>El Burj Al Arab Jumeirah está situado en su propia isla y ofrece suites con vistas al mar, 8 restaurantes exclusivos y un spa de servicio completo.
                    Los huéspedes pueden llegar al establecimiento con flotas de Rolls-Royce con chófer o con un servicio de traslado en helicóptero.
                    La terraza cuenta con 2 piscinas, 32 cabañas de lujo, un restaurante y un bar. </p>
            </div>

            <div class="col-sm-3">
                <h4>Acceso Rápido</h4>
                <ul class="list-unstyled">
                    <li><a href="{{route('pagina_web_habitaciones')}}">Habitaciones y tarifas</a></li>
                    <li><a href="{{route('pagina_web_introduccion')}}">Sobre nosotros</a></li>
                    <li><a href="{{route('pagina_web_galeria')}}">Galeria</a></li>
                    <li><a href="{{route('pagina_web_servicios')}}">Lifestyle</a></li>
                    <li><a href="{{route('pagina_web_contacto')}}">Contacto</a></li>
                </ul>
            </div>
            <div class="col-sm-4 subscribe">
                <h4>Suscribete</h4>
                    @include('includes.form-error')
                    <form action="{{route('suscripcion')}}" id="form-suscripcion" class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="Envia tu email aquí">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Enviar</button>
                            </span>
                        </div>
                    </form>
                <div class="social">
                    <a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook-square" data-toggle="tooltip" data-placement="top" data-original-title="facebook"></i></a>
                    <a href="https://www.instagram.com" target="_blank"><i class="fa fa-instagram" data-toggle="tooltip" data-placement="top" data-original-title="instragram"></i></a>
                    <a href="https://www.twitter.com" target="_blank"><i class="fa fa-twitter-square" data-toggle="tooltip" data-placement="top" data-original-title="twitter"></i></a>
                    <a href="https://www.pinterest.es" target="_blank"><i class="fa fa-pinterest-square" data-toggle="tooltip" data-placement="top" data-original-title="pinterest"></i></a>
                    <a href="https://www.tumblr.com" target="_blank"><i class="fa fa-tumblr-square" data-toggle="tooltip" data-placement="top" data-original-title="tumblr"></i></a>
                    <a href="https://www.youtube.es" target="_blank"><i class="fa fa-youtube-square" data-toggle="tooltip" data-placement="top" data-original-title="youtube"></i></a>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->

    <!--/.footer-bottom-->
</footer>


<a href="#home" class="toTop scroll"><i class="fa fa-angle-up"></i></a>

<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
{{-- <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title">title</h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
</div> --}}

    <!-- jQuery -->
    <script src="{{asset("assets/$theme/plugins/jquery/jquery.min.js")}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset("assets/$theme/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

    {{-- <script src="{{asset("assets/js/script_pagina_web.js")}}"></script> --}}
{{-- <!-- gallery -->
<script src="estilos/gallery/jquery.blueimp-gallery.min.js"></script> --}}


</body>

</html>
