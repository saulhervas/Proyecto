@extends("theme.$theme.layout")
@section('titulo')
    Tipo Habitación
@endsection

@section("styles")
    <!-- LIGTHBOX-->
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/ekko-lightbox/ekko-lightbox.css")}}">
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
    <!-- LIGTHBOX-->
    <script src="{{asset("assets/$theme/plugins/ekko-lightbox/ekko-lightbox.min.js")}}" type="text/javascript"></script>
    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
@endsection

@section('contenido')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@yield('titulo')</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <form action="{{route('guardar_tipo_habitacion')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf

                    <div class="card {{$card_color}} card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Crear Tipo Habitación</h3>
                            <div class="card-tools">
                                <a href="{{route('tipo_habitacion')}}" class="btn btn-block btn-info btn-sm d-inline mr-4">
                                    <i class="fas fa-fw fa-reply-all"></i> Volver al listado
                                </a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body ">
                            @include('tipo-habitacion.form')
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    @include('includes.boton-form-crear')
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
