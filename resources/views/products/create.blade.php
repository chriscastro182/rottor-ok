@extends('layouts.admin.app')

@section('title', __('product.new'))

@section('content')
	<div id="app">
		<h1 class="h3 mb-2 text-gray-800"><i class="fas fa-motorcycle"></i> {{ __('product.new') }}</h1>
		<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-12 col-sm-6">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h5>Registrar producto</h5>
						</div>
						<div class="card-body div table-responsive">
							@csrf
							<div class="form-group">
								<label for="name">{{ __('product.name') }}</label>
								<input id="name" class="form-control" type="text" name="name">
							</div>
							<div class="form-group">
								<label for="description">{{ __('product.description') }}</label>
								<textarea id="description" class="form-control" name="description"></textarea>
							</div>
							<brand-model-component></brand-model-component>
							<div class="form-group">
								<label for="price">{{ __('product.price') }}</label>
								<input id="price" class="form-control" type="text" name="price">
							</div>
							<div class="form-group">
								<label for="year">{{ __('product.year') }}</label>
								<input id="year" class="form-control" type="text" name="year">
							</div>
                            <div class="form-group">
                                <label for="owners">{{ __('product.owners') }}</label>
                                <input id="owners" class="form-control" type="text" name="owners">
                            </div>
                            <div class="form-group">
                                <label for="km">{{ __('product.km') }}</label>
                                <input id="km" class="form-control" type="text" name="km">
                            </div>
                            <div class="form-group">
                                <label for="bill_type">{{ __('product.bill_type') }}</label>
                                <input id="bill_type" class="form-control" type="text" name="bill_type">
                            </div>
							<div class="form-group">
								<label for="tank_capacity">{{ __('product.tank_capacity') }}</label>
								<input id="tank_capacity" class="form-control" type="text" name="tank_capacity">
							</div>
							<div class="form-group">
								<label for="performance">{{ __('product.performance') }}</label>
								<input id="performance" class="form-control" type="text" name="performance">
							</div>
							<div class="form-group">
								<label for="extras">{{ __('product.extras') }}</label>
								<textarea name="extras" id="extras" class="form-control"></textarea>
							</div>
							<input class="btn btn-primary" type="submit" value="{{ __('product.submit') }}">
						</div>
					</div><!-- .card -->
				</div>
				<div class="col-12 col-sm-6">
					<div class="card shadow mb-4">
						<div class="card-header">
							<h5>{{ __('attachment.images') }}</h5>
						</div>
						<div class="card-body">
							<div class="form-group">
								<input id="files" class="form-control" type="file" name="files[]" multiple>
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
