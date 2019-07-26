@extends('layouts.app')

@section('content')
<div class="container">
<form method="POST" action="{{ route('SCUD') }}">
	@csrf
	<div class="row justify-content-center">
		<div class="col-lg-2">
		</div>
		<div class="col-lg-8">
			<div class="card"> <!-- Начало карточки -->
				<div class="card-header">
					<button type="submit" class="back" onclick="window.location='{{ route("main")}}'">
						{{ __('Назад') }}
					</button>
					<!--<img class="fulllogo" src="http://sd.cloud1.vidimtech.com/images/vdfulllogo.png">-->
				</div>
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
						<h1>Заявка на обслуживание СКУД</h1><br>
						<div class="form-group">
							<label class="control-label col-xs-2 fields">Поля, помеченные символом <span class="star">*</span>, обязательны к заполнению</label><br>
							<label for="inputBuild" class="control-label col-xs-2">Укажите номер строения <span class="star">*</span></label>
							<div class="col-xs-9">
								<input name="Build" type="text" class="form-control" id="inputBuild" value="{{ old('Build') }}" required autofocus placeholder="Например, Стр. 1">
								@error('inputBuild')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							</div><br>
							<label for="inputLevel" class="control-label col-xs-2">Укажите этаж <span class="star">*</span></label>
							<div class="col-xs-9">
								<input name="Level" type="text" class="form-control" id="inputLevel" value="{{ old('Level') }}" required autofocus placeholder="Например, 3 этаж">
								@error('inputLevel')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							</div><br>
							<label for="inputDoorPos" class="control-label col-xs-2">Укажите расположение двери, либо её "имя" <span class="star">*</span></label>
							<div class="col-xs-9">
								<input name="DoorPos" type="text" class="form-control" id="inputDoorPos" value="{{ old('DoorPos') }}" required autofocus placeholder="Например, кабинет отдела мониторинга, или стр01.эт3.ГВН">
								@error('inputDoorPos')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							</div><br>
							<label for="selectMagLock" class="control-label col-xs-2">Наличие магнитного замка на двери <span class="star">*</span></label>
							<div class="col-xs-9">
								<select name="MagLock" class="form-control" id="selectMagLock">
									<option value="Да{{ (old('MagLock') == 'Да' ? "selected":"") }}">Да</option>
									<option value="Нет{{ (old('MagLock') == 'Нет' ? "selected":"") }}">Нет</option>
								</select>
							</div><br>
							<label for="selectElec" class="control-label col-xs-2">Электричество в строении <span class="star">*</span></label>
							<div class="col-xs-9">
								<select name="Elec" class="form-control" id="selectElec">
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
			</div>
		</div> <!-- Конец карточки -->
		<div class="col-lg-2">
		</div>
	</div>
</form>
</div>
@endsection