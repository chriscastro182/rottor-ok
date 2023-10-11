@extends('layouts.admin.app')

@section('title', __('factor.plural') )

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('factor.list') }}</h1>
<p class="mb-4">Listado de factores registrados</p>
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
		<a class="btn btn-secondary float-right" href="{{ route('factors.bulk') }}">{{ __('factor.bulk') }}</a>
		<a class="btn btn-secondary float-right" href="{{ route('factors.create') }}">{{ __('factor.new') }}</a>
	</div>
	<div class="card-body div table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>{{ __('factor.km') }}</th>
					<th>{{ __('factor.motor') }}</th>
					<th>{{ __('factor.year') }}</th>
					<th>{{ __('factor.percentage') }}</th>
					<th>{{ __('labels.actions') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($factors as $factor)
				<tr>
					<td>{{ $factor->km->min_km . '-' . $factor->km->max_km }}</td>
					<td>{{ $factor->motor->min_cc.'-'.$factor->motor->max_cc }}</td>
					<td>{{ $factor->year }}</td>
					<td>{{ $factor->percentage }}</td>
					<td>
						<a class="btn btn-warning" href="{{ route('factors.edit', [$factor->id]) }}"><i class="fas fa-edit"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $factors->links() }}
	</div>
</div>
@endsection
