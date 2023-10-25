@extends('layouts.public.app')

@section('title', 'Información para vender tu moto' )

@section('content')
    <section id="sell-page" class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="sell-title text-center mx-auto mt-1 mt-sm-4">
                        <h1 class="text-uppercase">vende <span class="text-red h1">tu moto</span></h1>
                    </div>
                    <div class="sell-body">
                        <h2 id="sell-subtitle" class="text-uppercase text-center mt-2">en 3 simples pasos</h2>
                        <div class="sell-list mx-auto my-4 text-left">
                            <div class="sell-list-item my-5">
                                <span class="h3 text-red">1.</span>
                                <span class="h4 text-uppercase">{{ __('sell.number_one') }}</span><br>
                                <span class="h5 text-gray">{{ __('sell.sub_one') }}.</span>
                            </div>
                            <div class="sell-list-item my-5">
                                <span class="h3 text-red">2.</span>
                                <span class="h4 text-uppercase">{{ __('sell.number_two') }}</span><br>
                                <span class="h5 text-gray">{{ __('sell.sub_two') }}.</span>
                            </div>
                            <div class="sell-list-item my-5">
                                <span class="h3 text-red">3.</span>
                                <span class="h4 text-uppercase">{{ __('sell.number_three') }}</span><br>
                                <span class="h5 text-gray">{{ __('sell.sub_three') }}.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="my-4">
                        <img src="{{ asset('img/IMG_01.jpg') }}" alt="Moto" class="img-fluid mx-auto">
                    </div>
                    <div class="text-center my-4">
                        <a href="{{ route('front.sell.index') }}" class="btn-background text-white text-uppercase text-decoration-none px-4 py-2 rounded my-4">cotiza aquí</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
