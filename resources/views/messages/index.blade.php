@extends('layouts.admin.app')

@section('title', __('message.plural') )

@section('content')
    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-inbox"></i> {{ __('message.list') }}</h1>
    <div class="card shadow mb-4">
        <div class="card-header">
            <form action="{{ route('message.search') }}" method="POST" class="row align-items-center">
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
        <div class="card-body div table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>{{ __('customer.name') }}</th>
                    <th>{{ __('customer.email') }}</th>
                    <th>{{ __('message.subject') }}</th>
                    <th>{{ __('message.message') }}</th>
                    <th>{{ __('labels.date') }}</th>
                    <th>{{ __('labels.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->customer->getFullName() }}</td>
                        <td>{{ $message->customer->email }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->message }}</td>
                        <td>{{ date('d-m-Y', strtotime($message->created_at)) }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('message.show', [$message->id]) }}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $messages->links() }}
        </div>
    </div>
@endsection
