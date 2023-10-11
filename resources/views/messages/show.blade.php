@extends('layouts.admin.app')

@section('title', __('message.plural') )

@section('content')
    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-inbox"></i> {{ __('message.number', ['id' => $message->id]) }}</h1>
    <div class="card">
        <div class="card-header">
            {{ __('customer.customer') }}
        </div>
        <div class="card-body">
            <h4 class="card-title"><i class="fas fa-user"></i> {{ $message->customer->getFullName() }}</h4>
            <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-envelope"></i> {{ $message->customer->email  }}</h6>
            <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-phone-alt"></i> {{ $message->customer->phone  }}</h6>
            <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-calendar-check"></i> {{ date('d-m-Y', strtotime($message->created_at))  }}</h6>
        </div>
    </div>
    <div class="card my-2">
        <div class="card-header">
            {{ __('message.data') }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $message->subject }}</h5>
            <p class="card-text">{{ $message->message }}</p>
        </div>
    </div>
@endsection
