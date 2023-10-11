@extends('layouts.admin.app')

@section('title', 'Acceder')

@section('content')
	<div class="row justify-content-center">

		<div class="col-xl-10 col-lg-12 col-md-9">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
						<div class="col-lg-6">
							<div class="p-5">
								<div class="text-center">
									@if(count($errors)>0)
									<div class="alert alert-danger animated pulse">
										<ul>
											@foreach ($errors->all() as $error)
											<li class="">{{ $error }}</li>
											@endforeach
										</ul>
									</div>
									@endif
									<h1 class="h4 text-gray-900 mb-4">Acceder</h1>
								</div>
								<form class="user" action="/login" method="POST">
									@csrf
									<div class="form-group">
										<input type="email" class="form-control form-control-user" name="email" id="email" aria-describedby="emailHelp" placeholder="{{ __('user.email') }}">
									</div>
									<div class="form-group">
										<input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="{{ __('user.password') }}">
									</div>
									<div class="form-group">
										<div class="custom-control custom-checkbox small">
											<input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
											<label class="custom-control-label" for="customCheck">Recuerdame</label>
										</div>
									</div>
									<input class="btn btn-primary btn-user btn-block" type="submit" value="{{ __('user.login') }}">
									<hr>
								</form>
								<hr>
								<div class="text-center">
									<a class="small" href="">Forgot Password?</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>
@endsection
