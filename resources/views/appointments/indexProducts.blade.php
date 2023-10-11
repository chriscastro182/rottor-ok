@extends('layouts.admin.app')

@section('title', __('appointment.products_list') )

@section('content')
    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-calendar-alt"></i> {{ __('appointment.products_list') }}</h1>
    <div class="card shadow mb-4">
        <div class="card-header">
            <form action="{{ route('appointments.search') }}" method="POST" class="row align-items-center">
                @csrf
                <div class="col-auto form-group align-middle">
                    <label for="start_date" class="label-form">{{ __('labels.start_date') }}</label>
                </div>
                <div class="col-auto form-group">
                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Fecha de inicio" value="{{ old('start_date') }}">
                </div>
                <div class="col-auto form-group">
                    <label for="end_date" class="label-form">{{ __('labels.end_date') }}</label>
                </div>
                <div class="col-auto form-group">
                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Fecha final" value="{{ old('end_date') }}">
                </div>
                <div class="col-auto form-group">
                    <button type="submit" class="btn btn-primary btn-lg">{!! __('labels.search') !!}</button>
                </div>
            </form>
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
        </div><!-- .card-header -->
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>{{ __('appointment.customer') }}</th>
                    <th>{{ __('customer.email') }}</th>
                    <th>{{ __('appointment.date') }}</th>
                    <th>{{ __('appointment.hour') }}</th>
                    <th>{{ __('product.name') }}</th>
                    <th>{{ __('product.description') }}</th>
                    <th>{{ __('labels.date') }}</th>
                    <th>{{ __('labels.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->customer->name. ' ' .$appointment->customer->lastname }}</td>
                        <td>{{ $appointment->customer->email }}</td>
                        <td>{{ $appointment->day }}</td>
                        <td>{{ $appointment->hour }}</td>
                        <td>{{ $appointment->products->first()->name }}</td>
                        <td>{{ $appointment->products->first() ->description}}</td>
                        <td>{{ date('d-m-Y', strtotime($appointment->created_at)) }}</td>
                        <td>
                            @if($appointment->quotations()->count()>0)
                                {{ __('appointment.has_quotations') }}
                            @elseif($appointment->orders()->count() > 0)
                                {{ __('appointment.has_orders') }}
                            @elseif($appointment->customMarkets()->count() > 0)
                                {{ __('appointment.has_custom') }}
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('appointments.show', [$appointment->id]) }}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $appointments->links() }}
        </div>
    </div><!-- .card -->
@endsection
