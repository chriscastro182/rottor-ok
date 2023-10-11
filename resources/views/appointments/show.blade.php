@extends('layouts.admin.app')

@section('title', __('appointment.singular') )

@section('content')
    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-calendar-check"></i> {{ __('appointment.number', ['id' => $appointment->id]) }}</h1>
    <div class="card">
        <div class="card-header">
            {{ __('customer.customer') }}
        </div>
        <div class="card-body">
            <h4 class="card-title"><i class="fas fa-user"></i> {{ $appointment->customer->getFullName() }}</h4>
            <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-envelope"></i> {{ $appointment->customer->email  }}</h6>
            <p class="card-text day mb-1"><i class="fas fa-calendar-day"></i> {{ $appointment->day }}</p>
            <p class="card-text hour mb-1"><i class="fas fa-clock"></i> {{ $appointment->hour }}</p>
        </div>
    </div>
    <div class="card my-2">
        <div class="card-header">
            {{ __('appointment.data') }}
        </div>
        <div class="card-body">
            @if( $appointment->quotations()->count() > 0 )
                <h5 class="card-title">{{ __('appointment.has_quotations') }}</h5>
                @foreach($appointment->quotations()->get() as $quotation)
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ __('brand.singular'). ': ' . $quotation->marketLaunch->brand->name }}</li>
                    <li class="list-group-item">{{ __('model.singular'). ': ' . $quotation->marketLaunch->model->description }}</li>
                    <li class="list-group-item">{{ __('market.year'). ': ' . $quotation->marketLaunch->year }}</li>
                    <li class="list-group-item">{{ __('market.is_cashiable'). ': ' }}
                        @if($quotation->marketLaunch->is_cashiable)
                            <i class="fas fa-check-circle text-success"></i>
                        @else
                            <i class="fas fa-times-circle text-danger text-danger text-danger"></i>
                        @endif
                    </li>
                    <li class="list-group-item">{{ __('market.full_payment'). ': $' . number_format($quotation->marketLaunch->full_payment, 2) }}</li>
                    <li class="list-group-item">{{ __('market.exchange_payment'). ': $' . number_format($quotation->marketLaunch->exchange_payment, 2) }}</li>
                    <li class="list-group-item">{{ __('market.allocation_payment'). ': $' . number_format($quotation->marketLaunch->allocation_payment, 2) }}</li>
                </ul>
                @endforeach
            @elseif( $appointment->orders()->count() > 0 )
                <h5 class="card-title">{{ __('appointment.has_orders') }}</h5>
                @foreach($appointment->orders()->get() as $order)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ __('order.status'). ': ' . $order->status->name }}</li>
                        <li class="list-group-item">{{ __('customer.name'). ': ' . $order->customer->name.' '.$order->customer->lastname }}</li>
                        <li class="list-group-item">{{ __('order.import'). ': $' . number_format($order->import, 2) }}</li>
                        <li class="list-group-item">{{ __('order.iva'). ': $' . number_format($order->iva, 2) }}</li>
                        <li class="list-group-item">{{ __('order.total'). ': $' . number_format($order->total, 2) }}</li>
                    </ul>
                @endforeach
            @elseif($appointment->customMarkets()->count() > 0)
                <h5 class="card-title">{{ __('appointment.has_custom') }}</h5>
                @foreach($appointment->customMarkets()->get() as $custom)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ __('brand.singular'). ': ' . $custom->brand }}</li>
                        <li class="list-group-item">{{ __('model.singular'). ': ' . $custom->model }}</li>
                        <li class="list-group-item">{{ __('market.year'). ': ' . $custom->year }}</li>
                        <li class="list-group-item">{{ __('market.cc'). ': ' . $custom->cc }}</li>
                        <li class="list-group-item">{{ __('km.singular'). ': ' . $custom->km }}</li>
                    </ul>
                @endforeach
            @elseif($appointment->products()->count() > 0)
                <h5 class="card-title">{{ __('appointment.has_product') }}</h5>
                @foreach($appointment->products()->get() as $product)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ __('product.name'). ': ' . $product->name }}</li>
                        <li class="list-group-item">{{ __('product.description'). ': ' . $product->description }}</li>
                        <li class="list-group-item">{{ __('product.price'). ': ' . $product->price }}</li>
                        <li class="list-group-item">{{ __('product.year'). ': ' . $product->year }}</li>
                        <li class="list-group-item">{{ __('brand.singular'). ': ' . $product->brand->name }}</li>
                        <li class="list-group-item">{{ __('model.singular'). ': ' . $product->model->description }}</li>
                    </ul>
                @endforeach
            @endif
        </div>
    </div>
@endsection
