<div class="card p-3">
    <div class="form-group row">
        @include('includes.input.text', ['nombre' => 'nombre', 'label' => 2,'input' => 4, 'req' => 1])
    </div>
    <div class="form-group row">
        @include('includes.input.number', ['nombre' => 'num_personas', 'tittle' => 'Numero Personas','label' => 2,'input' => 1, 'req' => 1])
        @include('includes.input.number', ['nombre' => 'num_camas', 'tittle' => 'Numero Camas','label' => 2,'input' => 1, 'req' => 1])
        @include('includes.input.number', ['nombre' => 'tamanio', 'tittle' => 'Tamaño', 'label' => 2,'input' => 1, 'step' => 'any', 'req' => 1])
        @include('includes.input.number', ['nombre' => 'precio', 'label' => 2,'input' => 1, 'step' => 'any', 'req' => 1])
    </div>
    <div class="form-group row">
        @include('includes.input.textarea', ['nombre' => 'descripcion', 'label' => 2,'input' => 10, 'rows' => 7, 'req' => 1])
    </div>
</div>
