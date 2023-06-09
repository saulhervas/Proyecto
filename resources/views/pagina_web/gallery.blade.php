@include('pagina_web/header')
<div class="container">
    <h1 class="title">Galería</h1>
    <div class="row gallery">
        @foreach ($fotos as $foto)
            <div class="col-sm-4 wowload fadeInUp"><a href="{{ $foto->foto_web }}" title="Foods" target="_black" class="gallery-image"
                    data-gallery><img src="{{ $foto->foto_web }}" ></a></div>
                    {{-- class="img-responsive" --}}
        @endforeach
    </div>
</div>
@include('pagina_web/footer')
