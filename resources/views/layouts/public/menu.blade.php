<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container-fluid text-center">
		<a class="navbar-brand mx-auto" href="/" title="Rottor"><img class="img-fluid" src="{{ asset('img/LOGO_SMALL.png') }}" alt=""></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu" aria-controls="main_menu" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div id="main_menu" class="collapse navbar-collapse">
			<ul class="navbar-nav mx-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="{{ route('front.products.index') }}"><img class="img-fluid" src="{{ asset('img/COMPRA_BTN2.png') }}" alt=" Compra Moto"></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('front.sell.info') }}"><img class="img-fluid" src="{{ asset('img/VENDE_BTN.png') }}" alt="Vende Moto"></a>
				</li>
			</ul>
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<loginform-component></loginform-component>
				</li>
			</ul>
		</div>
		<div class="user-options d-flex">
		</div>
	</div>
</nav>
