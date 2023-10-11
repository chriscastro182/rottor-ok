@extends('layouts.admin.app')

@section('title', __('motor.new'))

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('motor.submit') }}</h1>
<div class="card shadow mb-4 w-50">
	<div class="card-header">
		<h5>{{ __('motor.new') }}</h5>
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
		<form action="{{ route('motors.store') }}" method="POST">
			@csrf
			<div class="form-group">
				<label for="min_cc">{{ __('motor.min_cc') }}</label>
				<input id="min_cc" class="form-control" type="text" name="min_cc">
			</div>
			<div class="form-group">
				<label for="max_cc">{{ __('motor.max_cc') }}</label>
				<input id="max_cc" class="form-control" type="text" name="max_cc">
			</div>
			<input class="btn btn-primary" type="submit" value="{{ __('motor.submit') }}">
		</form>
	</div>
</div>
@endsection
