@extends('layouts.public.app')

@section('title', __('product.list') )

@section('content')

<section id="products-page">
	<div class="container">
		<div class="row">
			<div class="col-12">
			</div>
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ __('product.list') }}</li>
			  </ol>
			</nav>
		</div><!-- .row -->
		<product-list></product-list>
		<div class="row">
		</div><!-- .row -->
	</div>
</section>

@endsection
