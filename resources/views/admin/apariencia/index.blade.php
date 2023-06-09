@extends("theme.$theme.layout")
@section('titulo')
    Apariencia Intranet
@endsection

@section("styles")
    <!-- SELECT2-->
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/select2/css/select2.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
    <!-- SELECT2-->
    <script src="{{asset("assets/$theme/plugins/select2/js/select2.full.min.js")}}"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
        })
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
                <form action="{{route('actualizar_apariencia')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off">
                    @csrf @method("put")

                    <div class="card {{$card_color}} card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Apariencia Intranet</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @include('admin.apariencia.form')
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    @if (can('modificar-usuarios',false))
                                        @include('includes.boton-form-editar')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
