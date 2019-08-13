@extends('layouts.app')

@section('title', 'СВН')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-2">
		</div>
		<div class="col-lg-8">
			<div class="card"> <!-- Начало карточки -->
				<div class="card-header">
					<button type="submit" class="back" onclick="window.location='{{ route('main')}}'">
						{{ __('Назад') }}
					</button>
					<!--<img class="fulllogo" src="http://sd.cloud1.vidimtech.com/images/vdfulllogo.png">-->
				</div>
				<form method="POST" action="{{ route('SVN') }}">
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
						<h1>Заявка на обслуживание СВН</h1><br>
						<div class="form-group">
							<label class="control-label col-xs-2 fields">Поля, помеченные символом <span class="star">*</span>, обязательны к заполнению</label><br>
							<label for="inputBuild" class="control-label col-xs-2">Укажите номер строения <span class="star">*</span></label>
							<div class="col-xs-9">
								<input name="Build" type="text" class="form-control" id="inputBuild" value="{{ old('Build') }}" required autofocus placeholder="Например, Стр. 9">
								@error('inputBuild')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							</div><br>
							<label for="inputRegistrator" class="control-label col-xs-2">Укажите название регистратора <span class="star">*</span></label>
							<div class="col-xs-9">
								<input name="Registrator" type="text" class="form-control" id="inputRegistrator" value="{{ old('Registrator') }}" required autofocus placeholder="Например, Stroenie-01-3">
								@error('inputRegistrator')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							</div><br>
							<label for="inputCamera" class="control-label col-xs-2">Укажите название камеры <span class="star">*</span></label>
							<div class="col-xs-9">
								<input name="Camera" type="text" class="form-control" id="inputCamera" value="{{ old('Camera') }}" required autofocus placeholder="Например, 32_1.4">
								@error('inputCamera')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							</div><br>
							<label for="selectCamera" class="control-label col-xs-2">Присутствует ли камера на месте установки? <span class="star">*</span></label>
							<div class="col-xs-9">
								<select name="CamAvailable" class="form-control" id="selectCamera">
									<option value="Да{{ (old('CamAvailable') == 'Да' ? "selected":"") }}">Да</option>
									<option value="Нет{{ (old('CamAvailable') == 'Нет' ? "selected":"") }}">Нет</option>
								</select>
							</div><br>
							<label for="selectElec" class="control-label col-xs-2">Электричество в строении <span class="star">*</span></label>
							<div class="col-xs-9">
								<select name="Elec" name="Elec" class="form-control select" id="selectElec">
									<option value="Включено{{ (old('Elec') == 'Включено' ? "selected":"") }}">Включено</option>
									<option value="Отключено{{ (old('Elec') == 'Отключено' ? "selected":"") }}">Отключено</option>
								</select>
							</div><br>
							<label for="selectMont" class="control-label col-xs-2">Строительно-монтажные работы в строении <span class="star">*</span></label>
							<div class="col-xs-9">
								<select name="Mont" class="form-control" id="selectMont">
									<option value="Проводятся{{ (old('Mont') == 'Проводятся' ? "selected":"") }}">Проводятся</option>
									<option value="Не проводятся{{ (old('Mont') == 'Не проводятся' ? "selected":"") }}">Не проводятся</option>
								</select>
							</div><br>
							<label for="email" class="control-label col-xs-2">Укажите Вашу почту <span class="star">*</span></label>
							<div class="col-xs-9">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email@example.com">
								@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							</div><br>
							<label for="inputName" class="control-label col-xs-2">Имя <span class="star">*</span></label>
							<div class="col-xs-9">
								<input name="Name" type="text" class="form-control" id="inputName" value="{{ old('Name') }}" required autofocus>
								@error('inputName')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							</div><br>
							<label for="inputAdditionalInfo" class="control-label col-xs-2">Дополнительная информация</label><br>
							<label for="inputAdditionalInfo" class="descr col-xs-2">Краткое описание неисправности</label>
							<div class="col-xs-9">
								<textarea name="Issue" cols="50" rows="10" class="form-control" id="inputAdditionalInfo">{{ old('Issue') }}</textarea>
							</div>
						</div>
					</div>
				<div class="card-footer">
					<button type="submit" class="sender">
						{{ __('Отправить') }}
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