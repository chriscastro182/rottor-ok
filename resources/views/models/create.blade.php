@extends('layouts.admin.app')

@section('title', __('model.new'))

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('model.new') }}</h1>
<div class="card shadow mb-4 w-50">
	<div class="card-header">
		<h5>{{ __('model.submit') }}</h5>
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
		<form action="{{ route('models.store') }}" method="POST">
			@csrf
			<div class="form-group">
				<label for="description">{{ __('model.description') }}</label>
				<textarea id="description" class="form-control" name="description"></textarea>
			</div>
			<div class="form-group">
				<label for="brand_id">{{ __('model.brand') }}</label>
				<select id="brand_id" class="form-control" name="brand_id">
					<option value="">.: Selecciona :.</option>
					@foreach($brands as $brand)
					<option value="{{ $brand->id }}">{{ $brand->name }}</option>
					@endforeach
				</select>
			</div>
			<input class="btn btn-primary" type="submit" value="{{ __('model.submit') }}">
		</form>
	</div>
</div>
@endsection
