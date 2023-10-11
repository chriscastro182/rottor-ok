@extends('layouts.admin.app')

@section('title', __('model.model', ['name' => $model->description]))

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('model.model', ['name' => $model->description]) }}</h1>
<div class="card shadow mb-4 w-50">
	<div class="card-header">
		<h5>{{ __('model.update') }}</h5>
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
		<form action="{{ route('models.update', [$model->id]) }}" method="POST">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="description">{{ __('model.description') }}</label>
				<textarea id="description" class="form-control" name="description">{{ $model->description }}</textarea>
			</div>
			<div class="form-group">
				<label for="brand_id">{{ __('model.brand') }}</label>
				<select id="brand_id" class="form-control" name="brand_id">
					<option value="">.: Selecciona :.</option>
					@foreach($brands as $brand)
					@if( $model->brand->id == $brand->id )
					<option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
					@else
					<option value="{{ $brand->id }}">{{ $brand->name }}</option>
					@endif
					@endforeach
				</select>
			</div>
			<input class="btn btn-primary" type="submit" value="{{ __('model.update') }}">
		</form>
	</div>
</div>
@endsection
