@extends('layouts.public.app')

@section('title', $product->name )


@section('content')

<section id="product-page">
	<div class="container py-4">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/">Home</a></li>
			<li class="breadcrumb-item " aria-current="page"><a href="{{ route('front.products.index') }}">{{ __('product.list') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
		  </ol>
		</nav>
		<div class="row">
			<div class="col-12 col-sm-8">
				@php
				/*
				<div class="product-image px-3 row">
					<div class="col-2">
						<div class="small-img">
							<img src="{{ asset("img/next-icon.png") }}" alt="" class="icon-left" id="prev-image">
							<div class="small-container">
								<div class="small-img-roll">
									@foreach($product->attachments()->get() as $attachment)
										<img src="{{ asset('storage/'.$attachment->url) }}" alt="" class="show-small-img">
									@endforeach
								</div>
							</div>
							<img src="{{ asset("img/next-icon.png") }}" alt="" class="icon-right" id="next-image">
						</div><!-- .small-img -->
					</div>
					<div class="col-10">
						<div class="show" href="{{ $product->attachments->first()->name }}">
							<img id="show-img" class="card-img-top" src="{{ asset('storage/'.$product->attachments->first()->url) }}" alt="">
						</div><!-- .show -->
					</div>
				</div>
				*/
				@endphp
				<div class="row">
					<div class="col-12">
						<product-gallery-component product_id="{{ $product->id }}"></product-gallery-component>
					</div>
				</div>
			</div><!-- .col-sm-7 -->
			<div class="col-12 col-sm-4">
				<div class="product-description px-4">
					<h1 class="text-secondary">{{ $product->name }}</h1>
					<h2 class="text-secondary">${{ number_format($product->price, 2) }}</h2>
					<p class="text-secondary">{{ __('product.brand') }}: {{ $product->brand->name }}</p>
					<p class="text-secondary">{{ __('product.model') }}: {{ $product->model->description }}</p>
                    <p class="text-secondary">{{ __('product.version') }}: {{ $product->version()->get()->count() > 0 ? $product->version->name : 'N/A' }}</p>
                    <p class="text-secondary">{{ __('product.year') }}: {{ $product->year }}</p>
					<p class="text-secondary">{{ __('product.km') }}: {{ $product->km }}</p>
                    <p class="text-secondary">{{ __('product.owners') }}: {{ $product->owners }}</p>
                    <p class="text-secondary">{{ __('product.bill_type') }}: {{ $product->bill_type }}</p>
					<p class="text-secondary">{{ __('product.tank_capacity') }}: {{ $product->tank_capacity }}</p>
					<p class="text-secondary">{{ __('product.performance') }}: {{ $product->performance }}</p>
					<p class="text-secondary">{{ __('product.extras') }}: {{ $product->extras }}</p>
					<p class="text-secondary">{{ $product->description }}</p>
					<a class="btn btn-primary btn-lg h1 p-3" href="{{ route('front.products.form', [$product->id]) }}">{{ __('product.buy') }}</a>
				</div>
			</div>
		</div><!-- .row -->
	</div>
</section>

@endsection
@push('footer_scripts')
	<script src="{{ asset('js/zoom-image.js') }}" ></script>
	<script src="{{ asset('js/main.js') }}"></script>
@endpush
