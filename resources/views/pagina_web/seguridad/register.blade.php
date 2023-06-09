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
        <h3>Regístrate</h3>
        <form role="form" class="wowload fadeInRight" action="{{route('register_post')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="usuario">
            </div>
            <div class="form-group">
                <label for="">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="">Contraseña</label>
                <input type="password" class="form-control" id="pass" name="password" >
            </div>
            <div class="form-group">
                <label for="">Repetir contraseña</label>
                <input type="password" class="form-control" id="pass1" name="password_confirmation" >
            </div>

            <button type="submit" class="btn btn-default">Enviar</button>
        </form>
    </div>

</div>

</div>

@include('pagina_web/footer')
