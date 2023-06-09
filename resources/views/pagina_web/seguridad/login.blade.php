@include('pagina_web/header')
<div class="banner_login">
    <img src="{{$foto->foto_web}}" class="img-responsive1" alt="slide">

</div>

<div class="container">

<div class="col-sm-6 col-sm-offset-3">
    <div class="spacer_login">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <div class="alert-text">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif
        <h4>Identifícate</h4>
        <form class="wowload fadeInRight" action="{{route('login_post2')}}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="usuario" class="form-control" id="nombre" placeholder="Usuario">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña">
            </div>

            <button type="submit" class="btn btn-default">Enviar</button>
        </form>
    </div>

</div>

</div>

@include('pagina_web/footer')
