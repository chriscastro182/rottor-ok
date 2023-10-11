@extends('layouts.admin.app')

@section('title', __('version.version', ['name' => $version->name]))

@section('content')
    <h1 class="h3 mb-2 text-gray-800">{{ __('version.version', ['name' => $version->name]) }}</h1>
    <div class="card shadow mb-4 w-50">
        <div class="card-header">
            <h5>{{ __('version.update') }}</h5>
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
            <form action="{{ route('versions.update', [$version->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">{{ __('version.name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $version->name }}">
                </div>
                <div class="form-group">
                    <label for="brand_id">{{ __('version.model') }}</label>
                    <select id="model_id" class="form-control" name="model_id">
                        <option value="">.: Selecciona :.</option>
                        @foreach($models as $model)
                            @if( $version->model->id == $model->id )
                                <option value="{{ $model->id }}" selected>{{ $model->description }}</option>
                            @else
                                <option value="{{ $model->id }}">{{ $model->description }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">{{ __('version.year') }}</label>
                    <input type="text" name="year" id="year" class="form-control" value="{{ $version->year }}">
                </div>
                <input class="btn btn-primary" type="submit" value="{{ __('version.update') }}">
            </form>
        </div>
    </div>
@endsection
