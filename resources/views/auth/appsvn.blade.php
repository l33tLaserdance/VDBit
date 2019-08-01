@extends('layouts.app')

@section('content')
<div class="container">
<form method="GET" action="{{ route('showapplist') }}">
	@csrf
	<div class="row justify-content-center">
		<div class="col-lg-2">
		</div>
		<div class="col-lg-8">
			<div class="card"> <!-- Начало карточки -->
				<div class="card-header">
					<div class="row">
						<div class="col-lg-4">
							<button type="submit" class="back" onclick="window.location='{{ route('showapplist') }}'">
								{{ __('Назад') }}
							</button>
						</div>
						<div class="col-lg-8">
							@if (($svn[0]->closed) == 0)
								<div class="alert alert-success status">В работе</div>	
								@elseif (($svn[0]->closed) == 1)
								<div class="alert alert-danger status">Закрыта</div>
								@endif
						</div>
					</div>
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
						<h1>Заявка на обслуживание СВН №{{ $svn[0]->bitrix }}</h1><br>
						<div class="form-group">
							<label for="inputBuild" class="control-label col-xs-2">Номер строения</label>
							<div class="col-xs-9">
								<input name="Build" type="text" class="form-control" id="inputBuild" value="{{ $svn[0]->numBuild }}" disabled>
							</div><br>
							<label for="inputRegistrator" class="control-label col-xs-2">Название регистратора</label>
							<div class="col-xs-9">
								<input name="Registrator" type="text" class="form-control" id="inputRegistrator" value="{{ $svn[0]->numRegister }}" disabled>
							</div><br>
							<label for="inputCamera" class="control-label col-xs-2">Название камеры</label>
							<div class="col-xs-9">
								<input name="Camera" type="text" class="form-control" id="inputCamera" value="{{ $svn[0]->numCam }}" disabled>
							</div><br>
							<label for="inputAvailable" class="control-label col-xs-2">Присутствует ли камера на месте установки</label>
							<div class="col-xs-9">
								@if (($svn[0]->is_available) == 1)
								<input name="Available" type="text" class="form-control" id="inputAvailable" value="Да" disabled></input>
								@elseif (($svn[0]->is_available) == 0)
								<input name="Available" type="text" class="form-control" id="inputAvailable" value="Нет" disabled></input>
								@endif
							</div><br>
							<label for="inputElec" class="control-label col-xs-2">Электричество в строении</label>
							<div class="col-xs-9">
								@if (($svn[0]->is_electrified) == 1)
								<input name="Elec" type="text" class="form-control" id="inputElec" value="Включено" disabled></input>
								@elseif (($svn[0]->is_electrified) == 0)
								<input name="Elec" type="text" class="form-control" id="inputElec" value="Отключено" disabled></input>
								@endif
							</div><br>
							<label for="inputMont" class="control-label col-xs-2">Строительно-монтажные работы в строении</label>
							<div class="col-xs-9">
								@if (($svn[0]->is_worked) == 1)
								<input name="Mont" type="text" class="form-control" id="inputMont" value="Проводятся" disabled></input>
								@elseif (($svn[0]->is_worked) == 0)
								<input name="Mont" type="text" class="form-control" id="inputMont" value="Не проводятся" disabled></input>
								@endif
							</div><br>
							<label for="email" class="control-label col-xs-2">Указанный E-mail</label>
							<div class="col-xs-9">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $svn[0]->email }}" disabled>
							</div><br>
							<label for="inputName" class="control-label col-xs-2">Указанное имя</label>
							<div class="col-xs-9">
								<input name="Name" type="text" class="form-control" id="inputName" value="{{ $svn[0]->name }}" disabled>
							</div><br>
							<label for="inputAdditionalInfo" class="control-label col-xs-2">Дополнительная информация</label><br>
							<label for="inputAdditionalInfo" class="descr col-xs-2">Краткое описание неисправности</label>
							<div class="col-xs-9">
								<textarea name="Issue" cols="50" rows="10" class="form-control" id="inputAdditionalInfo" disabled>{{ $svn[0]->info }}</textarea>
							</div>
						</div>
					</div>
				<div class="card-footer">
					<button type="submit" class="sender">
						{{ __('Назад') }}
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