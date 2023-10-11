@extends('layouts.admin.app')

@section('title', __('brand.brand', ['name' => $brand->name]))

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('brand.edit') }}</h1>
<div class="card shadow mb-4 w-50">
	<div class="card-header">
		<h5>{{ __('brand.update') }}</h5>
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
		<form action="{{ route('brands.update', [$brand->id]) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="name">{{ __('brand.name') }}</label>
				<input id="name" class="form-control" type="text" name="name" value="{{ $brand->name }}">
			</div>
			<div class="form-group">
				<label for="description">{{ __('brand.description') }}</label>
				<textarea id="description" class="form-control" name="description">{{ $brand->description }}</textarea>
			</div>
			<div class="form-group">
				<input id="file" class="form-control" type="file" name="file">
			</div>
			<input class="btn btn-primary" type="submit" value="{{ __('brand.update') }}">
		</form>
	</div>
</div>
@endsection
