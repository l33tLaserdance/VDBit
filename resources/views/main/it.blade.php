@extends('layouts.app')

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
							<button type="submit" class="back">
								{{ __('Назад') }}
							</button>
						</div>
						<div class="col-mg-8">
							<!--<img class="fulllogo" src="http://sd.cloud1.vidimtech.com/images/vdfulllogo.png">-->
						</div>
					</div>
				</div>
					<div class="card-body">
						<h1>Заявка на IT-поддержку</h1><br>
						<div class="form-group">
							<label class="control-label col-xs-2 fields">Поля, помеченные символом <span class="star">*</span>, обязательны к заполнению</label><br>
							<label for="inputOrg" class="control-label col-xs-2">Название организации <span class="star">*</span></label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputOrg" placeholder="Введите организацию">
							</div><br>
							<label for="inputTRC" class="control-label col-xs-2">Название ТРЦ (для торговых точек)</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputTRC">
							</div><br>
							<label for="inputName" class="control-label col-xs-2">Имя <span class="star">*</span></label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputName">
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
							<label for="inputPhone" class="control-label col-xs-2">Телефон <span class="star">*</span></label>
							<div class="col-xs-9">
								<input type="text" class="form-control" id="inputPhone">
							</div><br>
							<label for="inputIssue" class="control-label col-xs-2">Суть проблемы <span class="star">*</span></label>
							<div class="col-xs-9">
								<textarea name="Issue" cols="50" rows="10" class="form-control" id="inputIssue"></textarea>
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