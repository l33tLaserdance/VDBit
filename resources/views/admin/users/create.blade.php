@extends('layouts.admin')

@section('title', 'Создание пользователя')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-2">
		</div>
		<div class="col-lg-8">
			<div class="card"> <!-- Начало карточки -->
				<div class="card-header">
					<div class="row">
						<div class="col-mg-4">
							<button type="submit" class="back" onclick="window.location='{{ route('users')}}'">
								{{ __('Назад') }}
							</button>
						</div>
						<div class="col-mg-8">
							<!--<img class="fulllogo" src="http://sd.cloud1.vidimtech.com/images/vdfulllogo.png">-->
						</div>
					</div>
				</div>
					<form method="POST" action="{{ route('USR') }}">
					@csrf
					<div class="card-body">
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
						<h1>Создание нового пользователя</h1><br>
						<div class="form-group">
							<label class="control-label col-xs-2 fields">Поля, помеченные символом <span class="star">*</span>, обязательны к заполнению</label><br>
							<label for="inputID" class="control-label col-xs-2">ID пользователя</label><br>
							<label for="inputID" class="descr col-xs-2">(Заполните только если хотите присвоить пользователю конкретный ID)</label>
							<div class="col-xs-9">
								<input name="ID" type="text" class="form-control @error('ID') is-invalid @enderror" id="inputID" value="{{ old('ID') }}">
								@error('ID')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							</div><br>
							<label for="inputName" class="control-label col-xs-2">Имя пользователя <span class="star">*</span></label>
							<div class="col-xs-9">
								<input name="Name" type="text" class="form-control @error('Name') is-invalid @enderror" id="inputName" value="{{ old('Name') }}" required autofocus>
								@error('Name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							</div><br>
							<label for="email" class="control-label col-xs-2">E-mail <span class="star">*</span></label>
							<div class="col-xs-9">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email@example.com">
								@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							</div><br>
							<label for="Password" class="control-label col-xs-2">Назначение пароля <span class="star">*</span></label><br>
							<label for="Password" class="descr col-xs-2">Пароль должен содержать не менее 6 и не более 15 символов.</label>
							<div class="col-xs-9">
								<input name="Password" id="Password" type="text" class="form-control @error('Password') is-invalid @enderror" name="Password" value="{{ old('Password') }}" required autocomplete="new-password">

                                @error('Password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div><br>
							<div class="col-xs-9">
								<label for="Password-confirm" class="control-label col-xs-2">Подтвердите пароль <span class="star">*</span></label>
								<input id="Password-confirm" type="text" class="form-control" name="Password_confirmation" value="{{ old('Password_confirmation') }}" required autocomplete="new-password">
							</div>
						</div>
					</div>
					
				<div class="card-footer">
					<button type="submit" class="sender">
						{{ __('Создать') }}
					</button>
				</div>
				</form>
			</div>
		</div> <!-- Конец карточки -->
		<div class="col-lg-2">
		</div>
	</div>
</div>
@endsection