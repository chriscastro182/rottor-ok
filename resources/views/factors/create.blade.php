@extends('layouts.admin.app')

@section('title', __('factor.new'))

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('factor.submit') }}</h1>
<div class="card shadow mb-4 w-50">
	<div class="card-header">
		<h5>{{ __('factor.new') }}</h5>
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
		<form action="{{ route('factors.store') }}" method="POST">
			@csrf
			<div class="form-group">
				<label for="km_id">{{ __('factor.km') }}</label>
				<select id="km_id" class="form-control" name="km_id">
					<option value="">.: Selecciona :.</option>
					@foreach($kms as $km)
					<option value="{{ $km->id }}">{{ $km->min_km.'-'.$km->max_km }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="motor_id">{{ __('factor.motor') }}</label>
				<select id="motor_id" class="form-control" name="motor_id">
					<option value="">.: Selecciona :.</option>
					@foreach($motors as $motor)
					<option value="{{ $motor->id }}">{{ $motor->min_cc.'-'.$motor->max_cc }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="year">{{ __('factor.year') }}</label>
				<input type="text" id="year" class="form-control" name="year">
			</div>
			<div class="form-group">
				<label for="percentage">{{ __('factor.percentage') }}</label>
				<input type="text" id="percentage" class="form-control" name="percentage">
			</div>
			<input class="btn btn-primary" type="submit" value="{{ __('factor.submit') }}">
		</form>
	</div>
</div>
@endsection
