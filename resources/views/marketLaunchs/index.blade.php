@extends('layouts.admin.app')

@section('title', __('market.plural') )

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('market.list') }}</h1>
<p class="mb-4">Listado de marketes registrados</p>
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
		<a class="btn btn-secondary float-right" href="{{ route('markets.bulk') }}">{{ __('market.bulk') }}</a>
	</div>
	<div class="card-body div table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>{{ __('market.brand') }}</th>
					<th>{{ __('market.model') }}</th>
                    <th>{{ __('market.version') }}</th>
					<th>{{ __('market.year') }}</th>
					<th>{{ __('market.cc') }}</th>
					<th>{{ __('market.is_cashiable') }}</th>
					<th>{{ __('market.full_payment') }}</th>
					<th>{{ __('market.exchange_payment') }}</th>
					<th>{{ __('market.allocation_payment') }}</th>
					<th>{{ __('labels.actions') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($markets as $market)
				<tr>
					<td>{{ $market->brand->name }}</td>
					<td>{{ $market->model->description }}</td>
                    <td>{{ $market->version->name }}</td>
					<td>{{ $market->year }}</td>
					<td>{{ $market->cc }}</td>
					<td>{{ $market->is_cashiable }}</td>
					<td>{{ $market->full_payment }}</td>
					<td>{{ $market->exchange_payment }}</td>
					<td>{{ $market->allocation_payment }}</td>
					<td>
						<a class="btn btn-warning" href="{{ route('markets.edit', [$market->id]) }}"><i class="fas fa-edit"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $markets->links() }}
	</div>
</div>
@endsection
