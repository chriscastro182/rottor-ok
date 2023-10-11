@extends('layouts.admin.app')

@section('title', __('motor.new'))

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('motor.update') }}</h1>
<div class="card shadow mb-4 w-50">
	<div class="card-header">
		<h5>{{ __('motor.edit') }}</h5>
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
		<form action="{{ route('motors.update', [$motor->id]) }}" method="POST">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="min_cc">{{ __('motor.min_cc') }}</label>
				<input id="min_cc" class="form-control" type="text" name="min_cc" value="{{ $motor->min_cc }}">
			</div>
			<div class="form-group">
				<label for="max_cc">{{ __('motor.max_cc') }}</label>
				<input id="max_cc" class="form-control" type="text" name="max_cc" value="{{ $motor->max_cc }}">
			</div>
			<input class="btn btn-primary" type="submit" value="{{ __('motor.update') }}">
		</form>
	</div>
</div>
@endsection
