@extends('layouts.public.app')

@section('title', 'Rottor')

@section('content')

<div id="boton-contacto-xs" class="d-block d-sm-none text-center">
	<a href="{{ route('front.sell.info') }}">
		<img class="img-fluid mx-auto" src="{{ asset('img/BTN.png') }}" alt="Boton Cotiza">
	</a>
</div>
<section id="presentation">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center px-0">
				<div id="motociclista-1" class="img-container position-relative">
					<!-- <img class="img-fluid" src="{{ asset('img/1ER_SECCION.jpg') }}" alt=""> -->
					<div id="motociclista-description" class="description py-2 py-sm-1 ps-sm-5 pe-0 pe-sm-3">
						<p class="text-uppercase h1 w-100 pe-0 pe-sm-5 mt-sm-2 mb-0">REVOLUCIONANDO</p>
					</div>
					<div class="second-description py-2 py-sm-4 text-center">
						<h3 id="first-description-text" class="text-uppercase h2 mb-0">LA <strong class="h1">compra - venta</strong> de</h3>
						<h3 id="second-description-text" class="text-uppercase h2"><strong class="h1">motocicletas</strong></h3>
						<a href="{{ route('front.products.index') }}" class=""><img src="{{ asset('img/BTN_negro.png') }}" alt=""></a>
						<p><small class="text-uppercase text-white">consulta términos y condiciones</small></p>
					</div>
					<div class="img-moto"><img src="{{ asset('img/MOTO.png') }}" alt=""></div>
				</div>
			</div>
		</div>
	</div>
</section><!-- #presentation -->
<section id="why">
	<div class="container py-3">
		<div class="row">
			<div class="col-12 text-center">
				<h2 id="why-title" class="text-white text-uppercase h1 my-2 my-sm-4">&iquest;Porqué comprar en rottor?</h2>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<figure class="figure mx-1 px-2">
					<img class="img-fluid" src="{{ asset('img/body2/BODY_2_IMG_1.jpg') }}" alt="">
					<figcaption class="text-uppercase text-center text-white my-1">certificamos todas las motos que vendemos</figcaption>
				</figure>
				<figure class="figure mx-1 px-2">
					<img class="img-fluid" src="{{ asset('img/body2/BODY_2_IMG_2.jpg') }}" alt="">
					<figcaption class="text-uppercase text-center text-white my-1">otorgamos garantía en todas nuestras motos</figcaption>
				</figure>
				<figure class="figure mx-1 px-2">
					<img class="img-fluid" src="{{ asset('img/body2/BODY_2_IMG_3.jpg') }}" alt="">
					<figcaption class="text-uppercase text-center text-white my-1">ofrecemos financiamiento</figcaption>
				</figure>
				<figure class="figure mx-1 px-2">
					<img class="img-fluid" src="{{ asset('img/body2/BODY_2_IMG_4.jpg') }}" alt="">
					<figcaption class="text-uppercase text-center text-white my-1">puedes probar la moto 5 días o 150 km</figcaption>
				</figure>
				<figure class="figure mx-1 px-2">
					<img class="img-fluid" src="{{ asset('img/body2/BODY_2_IMG_5.jpg') }}" alt="">
					<figcaption class="text-uppercase text-center text-white my-1">entrega en toda la republica mexicana</figcaption>
				</figure>
			</div>
		</div><!-- .row -->
		<div class="row">
			<div class="col">
				<div class="text-center">
					<a href="{{ route('front.products.index') }}"><img class="img-fluid" src="{{ asset('img/COMPRA_BTN2.png') }}" alt=""></a>
					<p><small class="text-center text-uppercase text-white">consulta términos y condiciones</small></p>
				</div>
			</div>
		</div><!-- .row -->
	</div><!-- .container -->
</section>
<section id="certification">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="certification-title text-white p-2 px-3 bg-black mt-3 float-end">Nuestras <strong>motocicletas</strong> están <strong>certificadas</strong> en más de 100 PUNTOS con los más altos estándares de cálidad</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="certification-container mt-1 mt-sm-2">
					<figure class="figure px-2" id="certificate-img">
						<img class="img-fluid" src="{{ asset('img/body3/CERTIFICADO-ROTTOR.png') }}" alt="">
					</figure>
					<figure id="mechanic" class="figure px-2 mt-0 mt-sm-4">
						<img class="img-fluid" src="{{ asset('img/body3/IMG_CIRCULO.png') }}" alt="">
						<figcaption class="text-uppercase text-center my-1 my-sm-2">inspección mecánica</figcaption>
					</figure>
					<figure id="legal" class="figure px-2 mt-0 ms-0 mt-sm-4 ms-sm-4">
						<img class="img-fluid" src="{{ asset('img/body3/IMG_CIRCULO2.png') }}" alt="">
						<figcaption class="text-uppercase text-center my-1 my-sm-2">legal</figcaption>
					</figure>
					<figure id="shop" class="figure px-2 mt-0 mt-sm-4">
						<img class="img-fluid" src="{{ asset('img/body3/compra_venta_circle.png') }}" alt="">
						<figcaption class="text-uppercase text-center my-1 my-sm-2">compra y venta</figcaption>
					</figure>
				</div>
			</div>
		</div>
	</div><!-- .container -->
</section><!-- #certification -->
<section id="mision">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-7">
				<div class="mision-container px-2 py-3">
                    <p><strong>ROTTOR</strong> nace de la idea de un apasionado por las motos.</p>
                    <p><strong>Juan Pablo Peralta</strong> se formó en áreas comerciales y medios digitales colaborando con diferentes compañías de prestigio como RSA, New York Life y una de las plataformas digitales más importantes en México, Ticketmaster.</p>
					<p>La necesidad constante del mercado de poder tener un lugar seguro para comprar o vender una moto, el crecimiento acelerado de la digitalización y la importancia de entender al motociclista, es lo que lo hacen decidir crear una opción digital en donde el motociclista pueda vender su moto de forma rápida, fácil y segura.</p>
					<hr>
					<p>Después de una larga planeación y estructuración surge <strong>ROTTOR</strong> logrando entender claramente las necesidades de los motociclistas ya que es fundada y operada por motociclistas que buscan ayudar a motociclistas.</p>
					<p>Los pilares sobre los que está fundada la empresa son la transparencia y la creación disruptiva de nuevas soluciones. Por esto mismo, la empresa siempre busca que sus colaboradores propongan nuevas ideas y así estar en continua innovación.</p>
					<p>El pensamiento que rige la compañía es alcanzar metas globales a través de la consolidación local.</p>
				</div>
			</div>
			<div class="col-12 col-sm-5">
				<div class="mision-image py-3">
					<img class="img-fluid mx-auto" src="{{ asset('img/body4/JP_IMG.jpg') }}" width="60%" alt="">
				</div>
			</div>
		</div>
	</div>
</section>
@php
/*
<section id="sale" class="py-sm-5 py-4">
	<div class="container pb-4">
		<div class="row">
			<div class="col-12 p-sm-4 text-center">
				<div class="position-relative d-sm-flex mx-auto justify-content-center my-sm-4">
					<div class="sale-title text-uppercase p-2 position-relative">
						<h3 class="border border-white px-sm-4 py-sm-2" id="sale-title">Vende tu moto al <strong>mejor precio</strong></h3>
						<div class="mt-4 d-none d-sm-block">
							<img class="img-fluid mx-auto" src="{{ asset('img/2DA_SECCION_ICONOS.png') }}" alt="">
							<h4 class="text-center text-uppercase">fácil, rápido y seguro</h4>
						</div>
					</div>
					<img id="sale-img" class="img-fluid float-sm-end mt-n2 d-none d-sm-block" width="300" src="{{ asset('img/IMG.png') }}" alt="">
				</div>
				<div class="mt-4 d-block d-sm-none">
					<img class="img-fluid mx-auto" src="{{ asset('img/2DA_SECCION_ICONOS.png') }}" alt="">
					<h4 class="text-center text-uppercase">fácil, rápido y seguro</h4>
				</div>
				<div class="p-2 mt-5">
					<h4 class="text-uppercase tex-center">Vende el equipo de tu moto</h4>
					<h5 class="text-uppercase text-center">sabemos que equipar tu moto también tiene un valor</h5>
				</div>
			</div>
		</div>
	</div>
</section><!-- #sale -->
<section id="sale-forms">
	<div class="container">
		<div class="row">
			<div class="col-12 py-4 text-center">
				<h4 class="text-uppercase">Contamos con 2 formas de vender tu moto</h4>
				<div class="d-sm-flex justify-content-center">
					<p class="text-uppercase">pago inmediato</p>
					<span class="rounded-circle bg-danger mx-3 mt-2 d-none d-sm-block" id="form-circle">&nbsp;</span>
					<p class="text-uppercase">consignación</p>
				</div>
			</div>
		</div>
	</div>
</section><!-- #sale-forms -->
<section id="steps" class="py-4">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="d-sm-flex justify-content-start my-5">
					<div class="d-flex my-4">
						<div class="flex-shrink-0">
							<h1 class="text-gigant">1</h1>
						</div>
						<div class="flex-grow-1 ms-3">
							<h3 class="text-uppercase">cotiza en minutos</h3>
							<h4 class="font-light">Déjanos tus datos y recibe una cotización</h4>
						</div>
					</div>
				</div>
				<div class="d-sm-flex justify-content-center my-5">
					<div class="d-flex my-4">
						<div class="flex-shrink-0">
							<h1 class="text-gigant">2</h1>
						</div>
						<div class="flex-grow-1 ms-3">
							<h3 class="text-uppercase">recibe la oferta de forma inmediata</h3>
							<h4 class="font-light">Ingresa la información de la moto y el equipo</h4>
						</div>
					</div>
				</div>
				<div class="d-sm-flex justify-content-end my-5">
					<div class="d-flex my-4">
						<div class="flex-shrink-0">
							<h1 class="text-gigant">3</h1>
						</div>
						<div class="flex-grow-1 ms-3">
							<h3 class="text-uppercase">Agenda tu cita para realizar la inspección</h3>
							<h4 class="font-light">Certificamos todas nuestras motos</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- #steps -->
*/
@endphp

@endsection
