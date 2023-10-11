@extends('layouts.admin.app')

@section('title', __('customMarket.list') )

@section('content')
    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-comments-dollar"></i> {{ __('customMarket.list') }}</h1>
    <div class="card shadow mb-4">
        <div class="card-header">
            <form action="{{ route('customMarkets.search') }}" method="POST" class="row align-items-center">
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
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>{{ __('customMarket.id') }}</th>
                    <th>{{ __('customer.name') }}</th>
                    <th>{{ __('customMarket.brand') }}</th>
                    <th>{{ __('customMarket.model') }}</th>
                    <th>{{ __('customMarket.year') }}</th>
                    <th>{{ __('customMarket.cc') }}</th>
                    <th>{{ __('customMarket.km') }}</th>
                    <th>{{ __('labels.date') }}</th>
                    <th>{{ __('labels.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($markets as $market)
                <tr>
                    <td>#{{ $market->id }}</td>
                    <td>{{ $market->customers->count()>0 ? $market->customers()->first()->name.' '.$market->customers()->first()->lastname : ''}}</td>
                    <td>{{ $market->brand }}</td>
                    <td>{{ $market->model }}</td>
                    <td>{{ $market->year }}</td>
                    <td>{{ $market->cc }}</td>
                    <td>{{ $market->km }}</td>
                    <td>{{ date('d-m-Y', strtotime($market->created_at)) }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('customMarkets.show', [$market->id]) }}"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $markets->links() }}
        </div>
    </div>
@endsection
