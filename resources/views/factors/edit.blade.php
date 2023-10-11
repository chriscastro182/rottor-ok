@extends('layouts.admin.app')

@section('title', __('factor.edit'))

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('factor.update') }}</h1>
<div class="card shadow mb-4 w-50">
	<div class="card-header">
		<h5>{{ __('factor.edit') }}</h5>
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
		<form action="{{ route('factors.update', [$factor->id]) }}" method="POST">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="km_id">{{ __('factor.km') }}</label>
				<select id="km_id" class="form-control" name="km_id">
					<option value="">.: Selecciona :.</option>
					@foreach($kms as $km)
					@if($factor->km->id == $km->id)
					<option value="{{ $km->id }}" selected>{{ $km->min_km.'-'.$km->max_km }}</option>
					@else
					<option value="{{ $km->id }}">{{ $km->min_km.'-'.$km->max_km }}</option>
					@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="motor_id">{{ __('factor.motor') }}</label>
				<select id="motor_id" class="form-control" name="motor_id">
					<option value="">.: Selecciona :.</option>
					@foreach($motors as $motor)
					@if($factor->motor->id == $motor->id)
					<option value="{{ $motor->id }}" selected>{{ $motor->min_cc.'-'.$motor->max_cc }}</option>
					@else
					<option value="{{ $motor->id }}">{{ $motor->min_cc.'-'.$motor->max_cc }}</option>
					@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="year">{{ __('factor.year') }}</label>
				<input type="text" id="year" class="form-control" name="year" value="{{ $factor->year }}">
			</div>
			<div class="form-group">
				<label for="percentage">{{ __('factor.percentage') }}</label>
				<input type="text" id="percentage" class="form-control" name="percentage" value="{{ $factor->percentage }}">
			</div>
			<input class="btn btn-primary" type="submit" value="{{ __('factor.submit') }}">
		</form>
	</div>
</div>
@endsection
