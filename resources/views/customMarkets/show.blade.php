@extends('layouts.admin.app')

@section('title', __('market.singular') )

@section('content')
    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-comment-dollar"></i> {{ __('customMarket.number', ['id' => $market->id]) }}</h1>
    <div class="card">
        <div class="card-header">
            {{ __('customer.customer') }}
        </div>
        <div class="card-body">
            <h4 class="card-title"><i class="fas fa-user"></i> {{ $market->customers()->first()->getFullName() }}</h4>
            <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-envelope"></i> {{ $market->customers()->first()->email  }}</h6>
            <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-phone-alt"></i> {{ $market->customers()->first()->phone  }}</h6>
        </div>
    </div>
    <div class="card my-2">
        <div class="card-header">
            {{ __('customMarket.data') }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ __('customMarket.singular') }}</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">{{ __('brand.singular'). ': ' . $market->brand }}</li>
                <li class="list-group-item">{{ __('model.singular'). ': ' . $market->model }}</li>
                <li class="list-group-item">{{ __('market.year'). ': ' . $market->year }}</li>
                <li class="list-group-item">{{ __('market.cc'). ': ' . $market->cc }}</li>
                <li class="list-group-item">{{ __('km.singular'). ': ' . $market->km }}</li>
            </ul>
        </div>
    </div>
@endsection
