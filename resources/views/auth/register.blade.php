@extends('layouts.admin.app')

@section('title', 'Registrar Usuario')

@section('content')
<div class="login-wrapper">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card w-25 mx-auto mt-3">
					<div class="card-body">
						@if(count($errors)>0)
						<div class="alert alert-danger animated pulse">
							<ul>
								@foreach ($errors->all() as $error)
								<li class="">{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif

						<h3 class="card-title text-center text-secondary">Registrar</h3>
						<form class="form my-4" action="{{ route('register') }}" method="POST">
							@csrf
							<div class="form-group mb-3">
								<input id="name" class="form-control" type="text" name="name" placeholder="{{ __('user.name') }}" value="{{ old('name') }}">
							</div>
							<div class="form-group mb-3">
								<input id="lastname" class="form-control" type="text" name="lastname" placeholder="{{ __('user.lastname') }}" value="{{ old('lastname') }}">
							</div>
							<div class="form-group mb-3">
								<input id="email" class="form-control" type="email" name="email" placeholder="{{ __('user.email') }}" value="{{ old('email') }}">
							</div>
							<div class="form-group mb-3">
								<input id="birth_date" class="form-control" type="date" name="birth_date" placeholder="{{ __('user.birth_date') }}" value="{{ old('birth_date') }}">
							</div>
							<div class="form-group mb-3">
								<select id="gender" class="form-control" name="gender">
									<option value="">.: Selecciona genero :.</option>
									@if( old('gender') == 1 )
									<option value="1" selected>Mujer</option>
									<option value="2">Hombre</option>
									@else
									<option value="1">Mujer</option>
									<option value="2" selected>Hombre</option>
									@endif
								</select>
							</div>
							<div class="form-group mb-3">
								<input id="password" class="form-control" type="password" name="password" placeholder="{{ __('user.password') }}">
							</div>
							<div class="form-group mb-3">
								<input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="{{ __('user.confirm_password') }}">
							</div>
							<div class="d-grid gap-2 d-md-block mx-auto text-center">
								<input class="btn btn-primary mx-auto text-center" type="submit" value="{{ __('user.submit') }}">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
