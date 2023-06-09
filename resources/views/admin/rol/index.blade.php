@extends("theme.$theme.layout")
@section('titulo')
    Roles
@endsection

@section("styles")
<link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">
@endsection

@section("scripts")
@include('includes.exportar')
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
                            @if (can('añadir-roles',false))
                                <a href="{{route('crear_rol')}}" class="btn btn-block btn-success btn-sm d-inline mr-4">
                                    <i class="fas fa-fw fa-plus-circle"></i> Nuevo rol
                                </a>
                            @endif
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="tabla-data" class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th class="width70"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->nombre}}</td>
                                    <td>
                                        @if (can('modificar-roles',false))
                                            <a href="{{route('editar_rol', ['id' => $data->id])}}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @elseif (can('ver-roles',false))
                                            <a href="{{route('editar_rol', ['id' => $data->id])}}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
                                        @if (can('eliminar-roles',false))
                                            <form action="{{route('eliminar_rol', ['id' => $data->id])}}" class="d-inline form-eliminar" method="POST">
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
