@extends('layouts.admin.app')

@section('title', __('product.singular') )

@section('content')
    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-motorcycle"></i> {{ __('product.number', ['id' => $product->id]) }}</h1>
    <div class="card">
        <div class="card-header">
            {{ __('product.singular') }}
            <form action="{{ route('products.destroy', [$product->id]) }}" method="POST" class="text-right">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{!! __('labels.delete') !!}</button>
            </form>
        </div>
        <div class="card-body">
            <h4 class="card-title">{{ __('product.name').': '. $product->name }}</h4>
            <p class="card-text">{{ __('product.brand') }}: {{ $product->brand->name }}</p>
            <p class="card-text">{{ __('product.model') }}: {{ $product->model->description }}</p>
            <p class="card-text">{{ __('product.version') }}: {{ $product->version()->get()->count() > 0 ? $product->version->name : 'N/A' }}</p>
            <p class="card-text">{{ __('product.description') }}: {{ $product->description }}</p>
            <p class="card-text">{{ __('product.price') }}: {{ number_format($product->price, 2) }}</p>
            <p class="card-text">{{ __('product.year') }}: {{ $product->year }}</p>
            <p class="card-text">{{ __('product.km') }}: {{ $product->km }}</p>
            <p class="card-text">{{ __('product.owners') }}: {{ $product->owners }}</p>
            <p class="card-text">{{ __('product.bill_type') }}: {{ $product->bill_type }}</p>
            <p class="card-text">{{ __('product.priority') }}: {{ $product->priority }}</p>
            <p class="card-text">{{ __('product.color') }}: {{ !$product->color ? '' : $product->colorClass->name }}</p>
            @if ($product->sold)
                <p class="card-text">Estado: 
                    <span>
                        {!! __('labels.sold') !!} 
                    </span>
                    Vendida
                </p>                  
            @endif

            @if ($product->apartada)
            <p class="card-text">
                <span>
                    {!! __('labels.sold') !!} 
                </span>
                Apartada
            </p>    
            @endif 

            @if (!$product->apartada && !$product->sold)
                <p class="card-text">Estado: En venta</p>                
            @endif
            
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <img src="{{ asset('storage/'.$product->attachments()->first()->url) }}" alt="{{ $product->attachments()->first()->name }}" class="img-fluid">
                </li>
            </ul>
        </div>
    </div>
@endsection
