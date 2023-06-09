<div class="card p-3">
    @if (empty($editar) && empty($unitario))
        <div class="form-group row">
            @include('includes.input.upload-multiple', ['nombre' => 'fotos', 'label' => 2,'input' => 4, 'req' => 1, 'imgFormat' => 'img-square'])
        </div>
    @else
        <div class="form-group row">
            @include('includes.input.text', ['nombre' => 'referencia_vista', 'label' => 2,'input' => 4, 'req' => 0])
        </div>
        <div class="form-group row">
            @include('includes.input.select', ['nombre' => 'tipo_habitacion_id', 'title' => 'Tipo Habitación','label' => 2,'input' => 4, 'req' => 0, 'valores' => $tipo_habitaciones])
            @include('includes.input.select', ['nombre' => 'servicio_id', 'title' => 'Servicio','label' => 2,'input' => 4, 'req' => 0, 'valores' => $servicios])
        </div>
        <div class="form-group row">
            @include('includes.input.upload', ['nombre' => 'foto', 'label' => 2,'input' => 4, 'req' => 0, 'imgFormat' => 'img-square'])
        </div>
    @endif
</div>
