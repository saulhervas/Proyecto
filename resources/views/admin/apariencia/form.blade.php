<div class="form-group row">
    @include('includes.input.select', ['nombre' => 'aside', 'title' => 'Color Menu Lateral','label' => 2,'input' => 4, 'req' => 0, 'valores' => $asides])
    @include('includes.input.select', ['nombre' => 'brand', 'title' => 'Hueco Logo','label' => 2,'input' => 4, 'req' => 0, 'valores' => $navbars])
</div>
<div class="form-group row">
    @include('includes.input.select', ['nombre' => 'navbar', 'title' => 'Color Barra Navegación','label' => 2,'input' => 4, 'req' => 0, 'valores' => $navbars])
    @include('includes.input.select', ['nombre' => 'card_color', 'title' => 'Color Filo Tarjeta','label' => 2,'input' => 4, 'req' => 0, 'valores' => $card_colors])
</div>
