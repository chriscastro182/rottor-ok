@extends('layouts.public.app')

@section('title', __('product.buy'))

@section('content')

    <section id="sell-product-form">
        <div class="container py-4">
            <div class="row">
                <div class="col-12">
                    <div class="w-50 mx-auto">
                        @if(session('message'))
                            <div class="alert alert-success alert-dismissible pulse" role="alert">
                                {{session('message')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
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
                        <h3 class="text-center my-2">{{ __('product.sell') }}</h3>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">${{ number_format($product->price, 2) }}</p>
                            </div>
                            <img src="{{ asset('storage/'.$product->attachments->first()->url) }}" alt="{{ $product->name }}" class="card-img-top">
                            <div class="card-footer">
                                <product-appointment-component product_id="{{ $product->id }}" customer_name="{{ __('customer.name') }}" customer_lastname="{{ __('customer.lastname') }}" customer_phone="{{ __('customer.phone') }}" customer_cellphone="{{ __('customer.cellphone') }}" customer_email="{{ __('customer.email') }}" appointment_date="{{ __('appointment.date') }}" appointment_hour="{{ __('appointment.hour') }}" appointment_submit="{{ __('appointment.submit') }}" accept_terms="{{ __('labels.accept_terms') }}" accept_privacy="{{ __('labels.accept_privacy') }}" privacy_route="{{ route('privacy') }}"></product-appointment-component>
                            </div>
                        </div>
                        <!-- <form action="{{ route('appointments.store') }}" method="POST" class="form mt-2">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="mb-3">
                                <label for="name">{{ __('customer.name') }}</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="lastname">{{ __('customer.lastname') }}</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone">{{ __('customer.phone') }}</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                            </div>
                            <div class="mb-3">
                                <label for="cellphone">{{ __('customer.cellphone') }}</label>
                                <input type="text" name="cellphone" id="cellphone" class="form-control" value="{{ old('cellphone') }}">
                            </div>
                            <div class="mb-3">
                                <label for="lastname">{{ __('customer.email') }}</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <label for="appointment_date">{{ __('appointment.date') }}</label>
                                <input type="date" name="day" id="appointment_date" class="form-control" value="{{ old('day') }}">
                            </div>
                            <div class="mb-3">
                                <label for="appointment_hour">{{ __('appointment.hour') }}</label>
                                <input type="time" name="hour" id="appointment_hour" class="form-control" value="{{ old('hour') }}">
                            </div>
                            <div class="form-check my-3">
                                <input type="checkbox" name="terms_check" id="terms-check" class="form-check-input">
                                <label for="terms-check" class="form-check-label"><a href="{{ route('privacy') }}">{{ __('labels.accept_terms') }}</a></label>
                            </div>
                            <div class="form-check my-3">
                                <input type="checkbox" name="privacy_check" id="privacy-check" class="form-check-input">
                                <label for="privacy-check" class="form-check-label"><a href="{{ route('privacy') }}">{{ __('labels.accept_privacy') }}</a></label>
                            </div>
                            <input type="submit" value="{{ __('appointment.submit') }}" class="btn btn-success">
                        </form>-->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
