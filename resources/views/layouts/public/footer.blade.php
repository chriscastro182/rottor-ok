<div id="footer" class="position-relative">
	<div class="container">
		<div class="row p-2 p-sm-4">
			<div class="col-12 col-sm-3">
				<div id="logo-footer" class="my-4 mx-auto">
					<a class="navbar-brand mx-auto" href="/" title="Rottor"><img class="img-fluid" src="{{ asset('img/LOGO_SMALL.png') }}" alt=""></a>
				</div>
			</div><!-- col-sm-3 -->
			<div class="col-12 col-sm-3">
				<div class="text-white text-uppercase my-2 my-sm-4 text-start d-none d-sm-block">
					<p><a href="{{ route('front.products.index') }}">compra tu moto</a></p>
					<p><a href="{{ route('front.sell.info') }}">vende tu moto</a></p>
				</div>
				<div class="text-white text-uppercase my-2 my-sm-4 text-center d-block d-sm-none">
					<p><a href="{{ route('front.products.index') }}">compra tu moto</a></p>
					<p><a href="{{ route('front.sell.info') }}">vende tu moto</a></p>
				</div>
			</div><!-- .col-sm-3 -->
			<div class="col-12 col-sm-3">
				<div class="text-white my-2 my-sm-4 text-end text-uppercase d-none d-sm-block">
					<p><a href="{{ route('privacy') }}">consulta términos y condiciones</a></p>
					<p><a href="mailto:contacto@rottor.com.mx">contacto@rottor.com.mx</a></p>
				</div>
				<div class="text-white my-2 my-sm-4 text-center text-uppercase d-block d-sm-none">
					<p><a href="{{ route('privacy') }}">consulta términos y condiciones</a></p>
					<p><a href="mailto:contacto@rottor.com.mx">contacto@rottor.com.mx</a></p>
				</div>
			</div>
			<div class="col-12 col-sm-3">
				<div class="text-white my-2 my-sm-4 text-center">
					<helpform-component></helpform-component>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="advice text-center text-white text-uppercase"><small>{{ __('labels.advice') }}</small></div>
			</div>
		</div>
		<div class="row">
			<hr class="my-4 border bg-white" style="border: 2px solid #fff !important; opacity: 1;">
		</div>
		<div class="row mb-2">
			<div class="col-12 col-sm-4">
				<ul class="list-inline my-2 my-sm-4">
					<li class="list-inline-item px-2 px-sm-2"><a href="https://www.instagram.com/rottor.mx/"><i class="fab fa-instagram h1"></i></a></li>
					<li class="list-inline-item px-2 px-sm-2"><a href="https://www.facebook.com/rottor.mx/"><i class="fab fa-facebook-f h1"></i></a></li>
					<li class="list-inline-item px-2 px-sm-2"><a href="https://mobile.twitter.com/rottormx"><i class="fab fa-tiktok h1"></i></a></li>
					<li class="list-inline-item px-2 px-sm-2"><a href="https://www.tiktok.com/@rottor.mx"><i class="fab fa-twitter h1"></i></a></li>
				</ul>
			</div>
			<div class="col-12 col-sm-4">
				<div class="mx-auto text-center my-2 my-sm-4 text-white text-uppercase">
					<p>copyright &copy; 2021 rottor. Todos los derechos reservados.</p>
					<p><a href="{{ route('privacy') }}">Aviso de privacidad</a></p>
				</div>
			</div>
			<div class="col-12 col-sm-4"></div>
		</div>
	</div>
</div>
