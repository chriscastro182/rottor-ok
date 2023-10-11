@extends('layouts.admin.app')

@section('title', __('market.market', ['name' => $market->name]))

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('market.edit') }}</h1>
<div class="card shadow mb-4 w-50">
	<div class="card-header">
		<h5>{{ __('market.update') }}</h5>
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
		<form action="{{ route('markets.update', [$market->id]) }}" method="POST">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="brand_id">{{ __('market.brand') }}</label>
				<select id="brand_id" class="form-control" name="brand_id">
					<option value="">.: Selecciona :.</option>
					@foreach($brands as $brand)
					@if($market->brand->id == $brand->id)
					<option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
					@else
					<option value="{{ $brand->id }}">{{ $brand->name }}</option>
					@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="model_id">{{ __('market.model') }}</label>
				<select id="model_id" class="form-control" name="model_id">
					<option value="">.: Selecciona :.</option>
					@foreach($models as $model)
					@if($market->model->id == $model->id)
					<option value="{{ $model->id }}" selected>{{ $model->description }}</option>
					@else
					<option value="{{ $model->id }}">{{ $model->description }}</option>
					@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="year">{{ __('market.year') }}</label>
				<input id="year" class="form-control" type="text" name="year" value="{{ $market->year }}">
			</div>
			<div class="form-group">
				<label for="cc">{{ __('market.cc') }}</label>
				<input id="cc" class="form-control" type="text" name="cc" value="{{ $market->cc }}">
			</div>
			<div class="form-group">
				<label for="is_cashiable">{{ __('market.is_cashiable') }}</label>
				<input id="is_cashiable" class="form-control" type="text" name="is_cashiable" value="{{ $market->is_cashiable }}">
			</div>
			<div class="form-group">
				<label for="full_payment">{{ __('market.full_payment') }}</label>
				<input id="full_payment" class="form-control" type="text" name="full_payment" value="{{ $market->full_payment }}">
			</div>
			<div class="form-group">
				<label for="exchange_payment">{{ __('market.exchange_payment') }}</label>
				<input id="exchange_payment" class="form-control" type="text" name="exchange_payment" value="{{ $market->exchange_payment }}">
			</div>
			<div class="form-group">
				<label for="allocation_payment">{{ __('market.allocation_payment') }}</label>
				<input id="allocation_payment" class="form-control" type="text" name="allocation_payment" value="{{ $market->allocation_payment }}">
			</div>
			<input class="btn btn-primary" type="submit" value="{{ __('market.update') }}">
		</form>
	</div>
</div>
@endsection
