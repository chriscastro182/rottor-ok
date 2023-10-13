@extends('layouts.admin.app')

@section('title', __('market.new'))

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ __('market.submit') }}</h1>
<div class="card shadow mb-4 w-50">
	<div class="card-header">
		<h5>{{ __('market.new') }}</h5>
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
		<form action="{{ route('markets.bulkImporter') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label for="market_file">{{ __('market.file') }}</label>
				<input type="file" id="market_file" class="form-control" name="market_file">
			</div>
			<input class="btn btn-primary" type="submit" value="{{ __('market.upload') }}">
		</form>
	</div>
</div>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@endsection
