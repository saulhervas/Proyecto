<div class="card p-3">
    <div class="form-group row">
        @include('includes.input.calendar', ['nombre' => 'fecha_entrada', 'label' => 2,'input' => 4, 'req' => 1])
        @include('includes.input.calendar', ['nombre' => 'fecha_salida', 'label' => 2,'input' => 4, 'req' => 1])
    </div>
    <div class="form-group row">
        @include('includes.input.number', ['nombre' => 'num_adultos', 'label' => 2,'input' => 4, 'req' => 1])
        @include('includes.input.number', ['nombre' => 'num_ninios', 'label' => 2,'input' => 4, 'req' => 1])
    </div>
    <div class="form-group row">
        @include('includes.input.number', ['nombre' => 'num_habitaciones', 'label' => 2,'input' => 4, 'req' => 1])
        @if (!isset($buscar))
            @include('includes.input.select', ['nombre' => 'tipo_habitacion_id', 'title' => 'Tipo Habitación','label' => 2,'input' => 4, 'req' => 1, 'valores' => $habitaciones])
        @elseif(isset($data))
            @include('includes.input.select', ['nombre' => 'tipo_habitacion_id', 'title' => 'Tipo Habitación','label' => 2,'input' => 4, 'req' => 1, 'valores' => $habitaciones, 'data' => $data->habitacion])
        @endif
    </div>
</div>

@if (!isset($buscar))
    <div class="card p-3">
        <label>Cliente</label>
        <div class="form-group row">
            @include('includes.input.select', ['nombre' => 'cliente_id', 'title' => 'Cliente','label' => 2,'input' => 4, 'req' => 1, 'valores' => $clientes])
            @include('includes.input.switch', ['nombre' => 'nuevo_cliente', 'label' => 2,'input' => 4, 'req' => 0])
        </div>
        <div class="form-group row nuevo">
            @include('includes.input.text', ['nombre' => 'nombre', 'label' => 2,'input' => 4, 'req' => 0])
            @include('includes.input.text', ['nombre' => 'apellidos', 'label' => 2,'input' => 4, 'req' => 0])
        </div>
        <div class="form-group row nuevo">
            @include('includes.input.text', ['nombre' => 'dni', 'label' => 2,'input' => 4, 'req' => 0])
            @include('includes.input.email', ['nombre' => 'email', 'label' => 2,'input' => 4, 'req' => 0])
        </div>
    </div>
    <div class="card p-3">
        <label>Servicios</label>
        <div class="form-group row">
            @foreach ($servicios as $key => $value)
                <div class="custom-control custom-checkbox offset-md-1 col-lg-2" >
                    <input class="custom-control-input" type="checkbox" name="servicio[]" id="{{$value}}" value="{{$key}}"
                    {{ isset($data) ? ( isset($data->servicio) ? ($data->servicio->firstWhere('id', $key) ? 'checked' : ''): ''): ''}}>
                    <label for="{{$value}}" class="custom-control-label">{{ucfirst(str_replace('_',' ',$value))}}</label>
                </div>
            @endforeach
        </div>
    </div>
@endif
