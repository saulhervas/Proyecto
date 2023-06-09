@include('pagina_web/header')
<div class="container">

	<h1 class="title">Contacto</h1>

	<!-- form -->
	<div class="contact">

		<div class="row">

			<div class="col-sm-12">
				<div class="map">
					<iframe src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=Dubai+(Dubai%20Kalifa)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" width="100%" height="400" frameborder="0"></iframe>
				</div>

				<div class="col-sm-6 col-sm-offset-3">
					<div class="spacer">
                        @include('includes.form-error')
                        @include('includes.mensaje')
                        @include('includes.mensaje-error')
						<h4>Contacta con nosotros</h4>
						<form action="{{route('guardar_contacto')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            @csrf
							<div class="form-group">
								<input type="text" name="nombre" class="form-control" id="name" placeholder="Nombre">
							</div>
							<div class="form-group">
								<input type="email" name="email" class="form-control" id="email" placeholder="Email">
							</div>
							<div class="form-group">
								<input type="phone" name="telefono" class="form-control" id="phone" placeholder="Telefono">
							</div>
							<div class="form-group">
								<textarea type="email" name="mensaje" class="form-control" placeholder="Mensaje" rows="4"></textarea>
							</div>

							<input type="submit" value="Enviar" class="btn btn-default"></input>
						</form>
					</div>

				</div>

			</div>
		</div>
	</div>
	<!-- form -->

</div>
@include('pagina_web/footer')

