@extends('layouts.admin.app')

@section('title', __('product.plural') )

@section('content')
<h1 class="h3 mb-2 text-gray-800"><i class="fas fa-motorcycle"></i> {{ __('product.list') }}</h1>
<p class="mb-4">Listado de productos registrados</p>
<div class="card shadow mb-4">
	<div class="card-header">
		@if(session('message'))
			<div class="alert alert-success alert-dismissible pulse" role="alert">
				<button class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				{{session('message')}}
			</div>
		@endif
		@if(count($errors)>0)
			<div class="alert alert-danger animated pulse">
				<ul>
					@foreach ($errors->all() as $error)
						<li class="">{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
	</div>
	<div class="card-body div table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>{{ __('product.image') }}</th>
					<th>{{ __('product.brand') }}</th>
					<th>{{ __('product.model') }}</th>
					<th>{{ __('product.name') }}</th>
					<th>{{ __('product.description') }}</th>
					<th>{{ __('product.price') }}</th>
					<th>{{ __('product.year') }}</th>
					<th>{{ __('labels.actions') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
				<tr>
					<td>
					@if($product->attachments->count() > 0)
						<img class="img-fluid" src="{{ asset('storage/'.$product->attachments->first()->url) }}" alt="">
					@endif
					</td>
					<td>{{ $product->brand->name }}</td>
					<td>{{ $product->model->description }}</td>
					<td>{{ $product->name }}</td>
					<td>{{ $product->description }}</td>
					<td>{{ $product->price }}</td>
					<td>{{ $product->year }}</td>
					<td>
                        <a href="{{ route('products.show', [$product->id]) }}" class="btn btn-info">{!!  __('labels.show') !!}</a>
                        <a href="{{ route('products.edit', [$product->id]) }}" class="btn btn-warning">{!! __('labels.edit') !!}</a>
						<form action="{{ route('products.destroy', [$product->id]) }}" method="POST">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger">{!! __('labels.delete') !!}</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
    <div class="card-footer">
        {{$products->links()}}
    </div>
</div>
@endsection
