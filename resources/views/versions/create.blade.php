@extends('layouts.admin.app')

@section('title', __('version.new'))

@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ __('version.new') }}</h1>
    <div class="card shadow mb-4 w-50">
        <div class="card-header">
            <h5>{{ __('version.submit') }}</h5>
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
            <form action="{{ route('versions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('version.name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="brand_id">{{ __('version.model') }}</label>
                    <select id="model_id" class="form-control" name="model_id">
                        <option value="">.: Selecciona :.</option>
                        @foreach($models as $model)
                            <option value="{{ $model->id }}">{{ $model->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">{{ __('version.year') }}</label>
                    <input type="text" name="year" id="year" class="form-control" value="{{ old('year') }}">
                </div>
                <input class="btn btn-primary" type="submit" value="{{ __('version.submit') }}">
            </form>
        </div>
    </div>
@endsection
