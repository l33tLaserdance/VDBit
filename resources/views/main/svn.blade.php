@extends('layouts.app')

@section('content')
<div class="container">
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
						<h1>Заявка на обслуживание СВН</h1><br>
						<div class="form-group">
							<label class="control-label col-xs-2 fields">Поля, помеченные символом <span class="star">*</span>, обязательны к заполнению</label><br>
							<label for="inputBuild" class="control-label col-xs-2">Укажите номер строения <span class="star">*</span></label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputBuild" placeholder="Например, Стр. 9">
							</div><br>
							<label for="inputRegistrator" class="control-label col-xs-2">Укажите название регистратора <span class="star">*</span></label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputRegistrator" placeholder="Например, Stroenie-01-3">
							</div><br>
							<label for="inputCamera" class="control-label col-xs-2">Укажите название камеры <span class="star">*</span></label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputCamera" placeholder="Например, 32_1.4">
							</div><br>
							<label for="selectCamera" class="control-label col-xs-2">Присутствует ли камера на месте установки? <span class="star">*</span></label>
							<div class="col-xs-9">
								<!--<select id="selectDoor" class="form-control dropdown-toggle-split" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<option value="yes" selected="selected">Да</option>
									<option value="no">Нет</option>
								</select>-->
								<select class="form-control" id="selectCamera">
									<option>Нет</option>
									<option>Да</option>
								</select>
							</div><br>
							<label for="selectElec" class="control-label col-xs-2">Электричество в строении <span class="star">*</span></label>
							<div class="col-xs-9">
								<select class="form-control" id="selectElec">
									<option>Отключено</option>
									<option>Включено</option>
								</select>
							</div><br>
							<label for="selectMont" class="control-label col-xs-2">Строительно-монтажные работы в строении <span class="star">*</span></label>
							<div class="col-xs-9">
								<select class="form-control" id="selectMont">
									<option>Проводятся</option>
									<option>Не проводятся</option>
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
								<input type="text" class="form-control" id="inputName">
							</div><br>
							<label for="inputAdditionalInfo" class="control-label col-xs-2">Дополнительная информация</label><br>
							<label for="inputAdditionalInfo" class="descr col-xs-2">Краткое описание неисправности</label>
							<div class="col-xs-9">
								<textarea name="Issue" cols="50" rows="10" class="form-control" id="inputAdditionalInfo"></textarea>
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
</div>
@endsection