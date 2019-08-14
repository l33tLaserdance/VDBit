@extends('layouts.admin')

@section('title', 'Обновление пользователя')
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
					<form method="POST" action="{{ route('UPDUSR') }}">
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
						<h1>Редактирование пользователя: {{ $usr[0]->name }}</h1><br>
						@if ($usr[0]->created_at != null)
						<p style="text-align: center;">Пользователь создан на форме регистрации {{ $usr[0]->created_at }}</p><br>
						@else
						<p style="text-align: center;">Пользователь был создан администратором {{ Auth::user()->name }}</p><br>	
						@endif
						<div class="form-group">
							<label for="inputName" class="control-label col-xs-2">Имя пользователя</label>
							<div class="col-xs-9">
								<input name="Name" type="text" class="form-control @error('Name') is-invalid @enderror" id="inputName" placeholder="{{ $usr[0]->name }}">
								@error('Name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							</div><br>
							<label for="email" class="control-label col-xs-2">E-mail</label>
							<div class="col-xs-9">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="email" autofocus placeholder="{{ $usr[0]->email }}">
								@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							</div><br>
							<label for="Password" class="control-label col-xs-2">Сменить пароль</label><br>
							<label for="Password" class="descr col-xs-2">Пароль должен содержать не менее 6 и не более 15 символов.</label>
							<div class="col-xs-9">
								<input name="Password" id="Password" type="text" class="form-control @error('Password') is-invalid @enderror" name="Password" value="{{ old('Password') }}">

                                @error('Password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div><br>
							<div class="col-xs-9">
								<label for="Password-confirm" class="control-label col-xs-2">Подтвердите пароль</label>
								<input id="Password-confirm" type="text" class="form-control" name="Password_confirmation" value="{{ old('Password_confirmation') }}">
							</div>
						</div>
					</div>	
				<div class="card-footer">
					<button type="submit" class="sender">
						{{ __('Обновить') }}
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