@extends('layouts.app')

@section('title', 'Просмотр заявки')
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
							@if (($scud[0]->closed) == 0)
								<div class="alert alert-success status">В работе</div>	
								@elseif (($scud[0]->closed) == 1)
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
						<h1>Заявка на обслуживание СКУД №{{ $scud[0]->bitrix }}</h1><br>
						<div class="form-group">
							<label for="inputBuild" class="control-label col-xs-2">Номер строения</label>
							<div class="col-xs-9">
								<input name="Build" type="text" class="form-control" id="inputBuild" value="{{ $scud[0]->numBuild }}" disabled>
							</div><br>
							<label for="inputLevel" class="control-label col-xs-2">Этаж</label>
							<div class="col-xs-9">
								<input name="Level" type="text" class="form-control" id="inputLevel" value="{{ $scud[0]->numLevel }}" disabled>
							</div><br>
							<label for="inputDoorPos" class="control-label col-xs-2">Расположение или имя двери</label>
							<div class="col-xs-9">
								<input name="DoorPos" type="text" class="form-control" id="inputDoorPos" value="{{ $scud[0]->numDoor }}" disabled>
							</div><br>
							<label for="inputMagLock" class="control-label col-xs-2">Наличие магнитного замка на двери </label>
							<div class="col-xs-9">
								@if (($scud[0]->is_mag) == 1)
								<input name="MagLock" type="text" class="form-control" id="inputMagLock" value="Да" disabled></input>
								@elseif (($scud[0]->is_mag) == 0)
								<input name="MagLock" type="text" class="form-control" id="inputMagLock" value="Нет" disabled></input>
								@endif
							</div><br>
							<label for="inputElec" class="control-label col-xs-2">Электричество в строении</label>
							<div class="col-xs-9">
								@if (($scud[0]->is_electrified) == 1)
								<input name="Elec" type="text" class="form-control" id="inputElec" value="Включено" disabled></input>
								@elseif (($scud[0]->is_electrified) == 0)
								<input name="Elec" type="text" class="form-control" id="inputElec" value="Отключено" disabled></input>
								@endif
							</div><br>
							<label for="inputMont" class="control-label col-xs-2">Строительно-монтажные работы в строении</label>
							<div class="col-xs-9">
								@if (($scud[0]->is_worked) == 1)
								<input name="Mont" type="text" class="form-control" id="inputMont" value="Проводятся" disabled></input>
								@elseif (($scud[0]->is_worked) == 0)
								<input name="Mont" type="text" class="form-control" id="inputMont" value="Не проводятся" disabled></input>
								@endif
							</div><br>
							<label for="email" class="control-label col-xs-2">Указанный E-mail</label>
							<div class="col-xs-9">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $scud[0]->email }}" disabled>
							</div><br>
							<label for="inputName" class="control-label col-xs-2">Указанное имя</label>
							<div class="col-xs-9">
								<input name="Name" type="text" class="form-control" id="inputName" value="{{ $scud[0]->name }}" disabled>
							</div><br>
							<label for="inputAdditionalInfo" class="control-label col-xs-2">Дополнительная информация</label><br>
							<label for="inputAdditionalInfo" class="descr col-xs-2">Краткое описание неисправности</label>
							<div class="col-xs-9">
								<textarea name="Issue" cols="50" rows="10" class="form-control" id="inputAdditionalInfo" disabled>{{ $scud[0]->info }}</textarea>
							</div>
						</div>
						<div class="col-xs-9">
							<label class="control-label col-xs-2">Комментарии:</label>
						</div>
						@if (isset($final))
						@foreach ($final->result as $fin)
							<div class="col-xs-9"> 
								<div class="row">
									<div class="col-lg-6 alert alert-primary" style="text-align: left; margin-bottom: 0">{{ $fin->AUTHOR_NAME }}</div>
									<div class="col-lg-6 alert alert-primary" style="text-align: right; margin-bottom: 0">{{ $fin->POST_DATE }}</div>
								</div>
								<textarea name="Comment" class="form-control" style="margin-top: 0; background-color: white" disabled>{{ $fin->POST_MESSAGE }}</textarea>
							</div>
						@endforeach
						@endif
						@if (!isset($final))
							<div class="col-xs-9">
								<label class="descr col-xs-2">Комментариев пока нет.</label>
							</div>
						@endif
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