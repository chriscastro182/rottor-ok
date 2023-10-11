@extends('layouts.admin.app')

@section('title', __('km.new'))

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('km.update') }}</h1>
<div class="card shadow mb-4 w-50">
	<div class="card-header">
		<h5>{{ __('km.edit') }}</h5>
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
		<form action="{{ route('kms.update', [$km->id]) }}" method="POST">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="min_km">{{ __('km.min_km') }}</label>
				<input id="min_km" class="form-control" type="text" name="min_km" value="{{ $km->min_km }}">
			</div>
			<div class="form-group">
				<label for="max_km">{{ __('km.max_km') }}</label>
				<input id="max_km" class="form-control" type="text" name="max_km" value="{{ $km->max_km }}">
			</div>
			<input class="btn btn-primary" type="submit" value="{{ __('km.update') }}">
		</form>
	</div>
</div>
@endsection
