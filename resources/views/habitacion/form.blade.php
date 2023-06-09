<div class="card p-3">
    <div class="form-group row">
        @include('includes.input.select', ['nombre' => 'tipo_habitacion_id', 'title' => 'Tipo Habitación','label' => 2,'input' => 4, 'req' => 1, 'valores' => $tipos])
        @include('includes.input.text', ['nombre' => 'numero', 'title' => 'Nº Habitación','label' => 2,'input' => 1, 'req' => 1])
        @include('includes.input.switch', ['nombre' => 'disponible', 'label' => 2,'input' => 1])
    </div>
</div>
