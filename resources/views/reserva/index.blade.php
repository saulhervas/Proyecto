@extends("theme.$theme.layout")
@section('titulo')
    Reservas
@endsection

@section("styles")
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-buttons/css/buttons.bootstrap4.css")}}">
    <!-- DATEPICKER-->
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/bootstrap-datepicker/css/datepicker.css")}}"/>
@endsection

@section("scripts")
    @include('includes.exportar')
    <!-- DATEPICKER-->
    <script src="{{asset("assets/$theme/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")}}"></script>
    <script>
        $("#fecha_entrada_bus").datepicker();
        $("#fecha_salida_bus").datepicker();
    </script>
    <script src="{{asset("assets/pages/scripts/admin/index.js")}}" type="text/javascript"></script>
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
                @include('includes.mensaje')
                @include('includes.mensaje-error')
                <div class="card {{$card_color}} card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Listado</h3>
                        <div class="card-tools">
                            @if (can('añadir-reservas',false))
                                <a href="{{route('periodo')}}" class="btn btn-block btn-success btn-sm d-inline mr-4">
                                    <i class="fas fa-fw fa-plus-circle"></i> Nueva Reserva
                                </a>
                            @endif
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">

                        <!-- Busqueda -->
                        @include('reserva.busqueda')

                        <!-- Listado -->
                        <table id="tabla-data" class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Cliente</th>
                                    <th>Entrada</th>
                                    <th>Salida</th>
                                    <th>Nº Noches</th>
                                    <th>Nº Adultos</th>
                                    <th>Nº Niños</th>
                                    <th>Nº Habitaciones</th>
                                    <th class="width70"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr >
                                    <td>{{$data->codigo}}</td>
                                    <td>{{$data->cliente->full_name}}</td>
                                    <td>{{$data->fecha_entrada}}</td>
                                    <td>{{$data->fecha_salida}}</td>
                                    <td>{{$data->num_noches}}</td>
                                    <td>{{$data->num_adultos}}</td>
                                    <td>{{$data->num_ninios}}</td>
                                    <td>{{$data->num_habitaciones}}</td>
                                    <td>
                                        @if (can('modificar-reservas',false))
                                            <a href="{{route('editar_reserva', ['id' => $data->id])}}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @elseif (can('ver-reservas',false))
                                            <a href="{{route('editar_reserva', ['id' => $data->id])}}" class="btn-accion-tabla tooltipsC" title="Ver este registro">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
                                        @if (can('eliminar-reservas',false))
                                            <form action="{{route('eliminar_reserva', ['id' => $data->id])}}" class="d-inline form-eliminar" method="POST">
                                                @csrf @method("delete")
                                                <button type="submit" class="btn-accion-tabla eliminar tooltipsC" title="Eliminar este registro">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
