<div class='float-right'>
    <a href="#" class='busqueda' style='@if (isset($busqueda)) display:none @else display:block @endif'><i class="fas fa-search-plus"></i></a>
    <a href="#" class='busqueda-close' style='@if (isset($busqueda)) display:block @else display:none @endif'><i class="fas fa-search-minus"></i></a>
</div>
<div class="clearfix"></div>
<form action="{{route('busqueda_reserva')}}" id="form-busqueda" class="form-horizontal" method="POST" autocomplete="off"  style='@if (isset($busqueda)) display:block @else display:none @endif'>
    @csrf
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Filtros busqueda</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                @include('includes.input.calendar', ['nombre' => 'fecha_entrada_bus', 'title' => 'Fecha Entrada', 'label' => 2,'input' => 2, 'req' => 0])
                @include('includes.input.calendar', ['nombre' => 'fecha_salida_bus', 'title' => 'Fecha Salida', 'label' => 2,'input' => 2, 'req' => 0])
            </div>
            <div class="form-group row">
                @include('includes.input.text', ['nombre' => 'codigo_bus', 'title' => 'Código', 'label' => 2,'input' => 2, 'req' => 0])
                @include('includes.input.text', ['nombre' => 'dni_bus', 'title' => 'Dni', 'label' => 2,'input' => 2, 'req' => 0])
            </div>
            <div class="col-lg-12 text-right">
                <button type="submit" class="btn btn-success">Buscar </button>
            </div>
        </div>
    </div>
</form>
