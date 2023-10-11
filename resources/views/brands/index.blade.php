@extends('layouts.admin.app')

@section('title', __('brand.plural') )

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('brand.list') }}</h1>
<p class="mb-4">Listado de brandos registrados</p>
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
		<a class="btn btn-secondary float-right" href="{{ route('brands.create') }}">{{ __('brand.new') }}</a>
	</div>
	<div class="card-body div table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>{{ __('brand.image') }}</th>
					<th>{{ __('brand.name') }}</th>
					<th>{{ __('brand.description') }}</th>
					<th>{{ __('labels.actions') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($brands as $brand)
				<tr>
					<td><img class="img-fluid" src="{{ $brand->attachments->count()>0 ? asset('storage/'.$brand->attachments->first()->url) : '' }}" alt=""></td>
					<td>{{ $brand->name }}</td>
					<td>{{ $brand->description }}</td>
					<td>
						<a class="btn btn-warning" href="{{ route('brands.edit', [$brand->id]) }}"><i class="fas fa-edit"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
    <div class="card-footer">
        {{ $brands->links() }}
    </div>
</div>
@endsection
