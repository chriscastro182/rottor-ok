@extends('layouts.admin.app')

@section('title', 'Rottor Dashboard')

@section('content')
	<div id="app">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<product-quote-component></product-quote-component>
			</div>
			<div class="col-xs-12 col-sm-6">
				<product-quotecc-component></product-quotecc-component>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<product-quotekm-component></product-quotekm-component>
			</div>
			<div class="col-xs-12 col-sm-6">
				<product-quotedate-component></product-quotedate-component>
			</div>
		</div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <quote-brands></quote-brands>
            </div>
            <div class="col-12 col-sm-6">
                <quote-versions></quote-versions>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <quote-cc></quote-cc>
            </div>
        </div>
	</div>
@endsection
