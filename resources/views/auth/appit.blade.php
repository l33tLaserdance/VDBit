@extends('layouts.app')

@section('title', 'Просмотр заявки')
@section('content')
<div class="container">
<form method="GET" action="{{ route('showapplist') }}"> <!-- Вставить action! -->
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
							@if (($it[0]->closed) == 0)
								<div class="alert alert-success status">В работе</div>	
								@elseif (($it[0]->closed) == 1)
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
						<h1>Заявка на IT-поддержку №{{ $it[0]->bitrix }} </h1><br>
						<div class="form-group">
							<label for="inputOrg" class="control-label col-xs-2">Название организации</label>
							<div class="col-xs-9">
								<input name="Org" type="text" class="form-control" id="inputOrg" value="{{ $it[0]->orgname }}" disabled>
							</div><br>
							<label for="inputTRC" class="control-label col-xs-2">Название ТРЦ (для торговых точек)</label>
							<div class="col-xs-9">
								<input name="TRC" type="text" class="form-control" id="inputTRC" value="{{ $it[0]->trcname }}" disabled>
							</div><br>
							<label for="inputName" class="control-label col-xs-2">Указанное Имя</label>
							<div class="col-xs-9">
								<input name="Name" type="text" class="form-control" id="inputName" value="{{ $it[0]->name }}" disabled>
							</div><br>
							<label for="email" class="control-label col-xs-2">Указанный E-mail</label>
							<div class="col-xs-9">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $it[0]->email }}" disabled>
							</div><br>
							<label for="inputPhone" class="control-label col-xs-2"></label><br>
							<div class="col-xs-9">
								<input name="Phone" type="text" class="form-control" id="inputPhone" value="{{ $it[0]->phone }}" disabled>
							</div><br>
							<label for="inputIssue" class="control-label col-xs-2">Суть проблемы</label>
							<div class="col-xs-9">
								<textarea name="Issue" cols="50" rows="10" class="form-control" required id="inputIssue" disabled>{{ $it[0]->info }}</textarea>
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
						@elseif (!isset($final))
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