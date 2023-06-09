@extends("theme.$theme.layout")
@section('titulo')
    Reserva
@endsection

@section("styles")
    <!-- DATEPICKER-->
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/bootstrap-datepicker/css/datepicker.css")}}"/>
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/cliente/crear.js")}}" type="text/javascript"></script>
    <!-- DATEPICKER-->
    <script src="{{asset("assets/$theme/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")}}"></script>
    <script>
        $("#fecha_entrada").datepicker();
        $("#fecha_salida").datepicker();
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
                @include('includes.mensaje-error')
                <form action="{{route('buscar_periodo')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf

                    <div class="card {{$card_color}} card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Buscar Periodo</h3>
                            <div class="card-tools">
                                <a href="{{route('reserva')}}" class="btn btn-block btn-info btn-sm d-inline mr-4">
                                    <i class="fas fa-fw fa-reply-all"></i> Volver al listado
                                </a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body ">
                            @include('reserva.form')
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
