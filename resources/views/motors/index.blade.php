@extends('layouts.admin.app')

@section('title', __('motor.plural') )

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('motor.list') }}</h1>
<p class="mb-4">Listado de motores registrados</p>
<div class="card shadow mb-4">
	<div class="card-header">
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
		<a class="btn btn-secondary float-right" href="{{ route('motors.create') }}">{{ __('motor.new') }}</a>
	</div>
	<div class="card-body div table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>{{ __('motor.min_cc') }}</th>
					<th>{{ __('motor.max_cc') }}</th>
					<th>{{ __('labels.actions') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($motors as $motor)
				<tr>
					<td>{{ $motor->min_cc }}</td>
					<td>{{ $motor->max_cc }}</td>
					<td>
						<a class="btn btn-warning" href="{{ route('motors.edit', [$motor->id]) }}"><i class="fas fa-edit"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
