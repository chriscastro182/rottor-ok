@extends('layouts.admin.app')

@section('title', __('product.edit'))

@section('content')
    <div id="app">
        <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-motorcycle"></i> {{ __('product.edit') }}</h1>
        <form action="{{ route('products.update', [$product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="card shadow mb-4">
                        <div class="card-header">
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
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ __('product.name') }}</label>
                                <input id="name" class="form-control" type="text" name="name" value="{{ $product->name }}">
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('product.description') }}</label>
                                <textarea id="description" class="form-control" name="description">{{ $product->description }}</textarea>
                            </div>
                            <brand-model-version-component brand_id="{{ $product->brand_id }}" model_id="{{ $product->model_id }}" version_id="{{ $product->version_id }}"></brand-model-version-component>
                            <div class="form-group">
                                <label for="price">{{ __('product.price') }}</label>
                                <input id="price" class="form-control" type="text" name="price" value="{{ $product->price }}">
                            </div>
                            <div class="form-group">
                                <label for="year">{{ __('product.year') }}</label>
                                <input id="year" class="form-control" type="text" name="year" value="{{ $product->year }}">
                            </div>
                            <div class="form-group">
                                <label for="owners">{{ __('product.owners') }}</label>
                                <input id="owners" class="form-control" type="text" name="owners" value="{{ $product->owners }}">
                            </div>
                            <div class="form-group">
                                <label for="bill_type">{{ __('product.bill_type') }}</label>
                                <input id="bill_type" class="form-control" type="text" name="bill_type" value="{{ $product->bill_type }}">
                            </div>
                            <div class="form-group">
                                <label for="km">{{ __('product.km') }}</label>
                                <input id="km" class="form-control" type="text" name="km" value="{{ $product->km }}">
                            </div>
                            <div class="form-group">
                                <label for="tank_capacity">{{ __('product.tank_capacity') }}</label>
                                <input id="tank_capacity" class="form-control" type="text" name="tank_capacity" value="{{ $product->tank_capacity }}">
                            </div>
                            <div class="form-group">
                                <label for="performance">{{ __('product.performance') }}</label>
                                <input id="performance" class="form-control" type="text" name="performance" value="{{ $product->performance }}">
                            </div>
                            <div class="form-group">
                                <label for="extras">{{ __('product.extras') }}</label>
                                <textarea name="extras" id="extras" class="form-control">
                                    {{ $product->extras }}
                                </textarea>
                            </div>
                            <input class="btn btn-primary" type="submit" value="{{ __('product.update') }}">
                        </div>
                    </div><!-- .card -->
                </div>
                <div class="col-12 col-sm-6">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h5>{{ __('attachment.images') }}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($product->attachments()->get() as $attachment)
                                <li class="list-group-item">
                                    <img src="{{ asset('storage/'.$attachment->url) }}" alt="{{ $attachment->name }}" class="img-fluid">
                                </li>
                                @endforeach
                            </ul>
                            <div class="form-group">
                                <input id="files" class="form-control" type="file" name="files[]" multiple>
                            </div>
                            <div class="form-group">
                                <label for="sold">¿Producto vendido?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sold" id="sold_si" value="1" {{ $product->sold == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sold_si">Sí</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sold" id="sold_no" value="0" {{ $product->sold == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sold_no">No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="apartada">¿Moto apartada?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="apartada" id="apartada_si" value="1" {{ $product->apartada == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="apartada_si">Sí</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="apartada" id="apartada_no" value="0" {{ $product->apartada == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="apartada_no">No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="priority">{{ __('product.priority') }}</label>
                                <input id="priority" class="form-control" type="text" name="priority" value="{{ $product->priority }}">
                                <label for="priority">Escribe del 1 al 10,000 la prioridad de aparición, donde 1 es la prioridad más alta y 10,000 la más baja</label>
                            </div>
							<div class="form-group">
								<label for="color">{{ __('product.color') }}</label>
								<select id="color" class="form-control" name="color">
									<option value="">.: Selecciona :.</option>
									@foreach($colors as $color)
                                    @if ($color->id == $product->color)
                                        <option selected value="{{ $color->id }}">{{ $color->name }}</option>
                                    @else
                                        <option value="{{ $color->id }}">{{ $color->name }}</option>                                        
                                    @endif
									@endforeach
								</select>
							</div>
                        </div>

                    </div><!-- .card -->
                </div>
            </div>
        </form>
    </div>
@endsection
<script>
    import ProductBrandModelComponent from "../../js/components/product/ProductBrandModelComponent";
    export default {
        components: {ProductBrandModelComponent}
    }
</script>
