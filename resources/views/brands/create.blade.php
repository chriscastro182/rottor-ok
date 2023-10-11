@extends('layouts.admin.app')

@section('title', __('brand.new'))

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('brand.new') }}</h1>
<div class="card shadow mb-4 w-50">
	<div class="card-header">
		<h5>Registrar marca</h5>
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
		<form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label for="name">{{ __('brand.name') }}</label>
				<input id="name" class="form-control" type="text" name="name">
			</div>
			<div class="form-group">
				<label for="description">{{ __('brand.description') }}</label>
				<textarea id="description" class="form-control" name="description"></textarea>
			</div>
			<div class="form-group">
				<input id="file" class="form-control" type="file" name="file">
			</div>
			<input class="btn btn-primary" type="submit" value="{{ __('brand.submit') }}">
		</form>
	</div>
</div>
@endsection
