@extends('layouts.app')

@section('content')
<div class="container">
<form method="POST" action="{{ route('showapplist') }}">
	@csrf
	<div class="row justify-content-center">
		<div class="col-lg-1">
		</div>
		<div class="col-lg-10">
			<div class="card"> <!-- Начало карточки -->
			@if (session('message') == 'Запрашиваемой заявки не существует.')
				  <div class="alert alert-danger">
					<strong>Ошибка.</strong> {{ session('message') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
				  </div>
			@elseif (session('message'))
				<div class="alert alert-success">
					<strong>Успешно!</strong> {{ session('message') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
				</div>
			@endif
				<div class="card-header">
					<div class="row">
						<div class="col-mg-8">
							<img class="fulllogo" src="http://sd.cloud1.vidimtech.com/images/vdfulllogo.png">
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
					<form id="appform" method="get">
						<h1>Заявки пользователя {{ Auth::user()->name }}</h1><br>
						<div class="form-group">
							<div class="col-xs-12">
								<label for="scud" class="control-label col-xs-2">Заявки на обслуживание СКУД</label><br>
							</div>
							@if (empty($scud[0]))
								<p>У вас нет заявок на обслуживание СКУД.</p>
							@elseif (!empty($svn))
							<div class="col-xs-12">
								<table class="table table-bordered table-dark" id="scud">
								<tr scope="row">
									<th scope="col" width="10%">Номер заявки</th>
									<th scope="col" width="10%">Имя</th>
									<th scope="col" width="60%">Содержание заявки</th>
									<th scope="col" width="20%">Действия</th>
								</tr>
									@foreach ($scud as $obj)
										<tr>
										@foreach($obj as $tbl)
											@if (is_numeric($tbl))
												<td class="btn btn-danger" id="bit"> {{ $tbl }}</td>
											@elseif (is_string($tbl))
												<td> {{ $tbl }}</td>
											@endif
										@endforeach
										<td> 
										<a class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-app="{{ $obj->bitrix }}" data-name="scud" name="del">Отменить заявку</a>
										<br>
										<a class="btn btn-success" id="{{ $obj->bitrix }}" name="read" href="http://sd.cloud1.vidimtech.com/appscud?id={{ $obj->bitrix }}">Просмотреть заявку</a>
										</td>
										</tr>
									@endforeach
								</table>
							@endif
							
								<div class="col-xs-12">
								<label for="scud" class="control-label col-xs-2">Заявки на обслуживание СВН</label><br>
							</div>
							@if (empty($svn[0]))
								<p>У вас нет заявок на обслуживание СВН.</p>
							@elseif (!empty($svn))
							<div class="col-xs-12">
								<table class="table table-bordered table-dark" id="svn">
								<tr scope="row">
									<th scope="col" width="10%">Номер заявки</th>
									<th scope="col" width="10%">Имя</th>
									<th scope="col" width="60%">Содержание заявки</th>
									<th scope="col" width="20%">Действия</th>
								</tr>
									@foreach ($svn as $obj)
										<tr>
										@foreach($obj as $tbl)
											@if (is_numeric($tbl))
												<td class="btn btn-danger" id="bit">{{ $tbl }}</td>
											@elseif (is_string($tbl))
												<td>{{ $tbl }}</td>
											@endif
										@endforeach
										<td>
										<a class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-app="{{ $obj->bitrix }}" data-name="svn" name="del">Отменить заявку</a>
										<br>
										<a class="btn btn-success" id="{{ $obj->bitrix }}" name="read" href="http://sd.cloud1.vidimtech.com/appsvn?id={{ $obj->bitrix }}">Просмотреть заявку</a>
										</td>
										</tr>
									@endforeach
								</table>
							</div>
							@endif
							
							<div class="col-xs-12">
								<label for="alarm" class="control-label col-xs-2">Заявки на обслуживание охранной сигнализации</label><br>
							</div>
							@if (empty($alarm[0]))
								<p>У вас нет заявок на обслуживание охранной сигнализации.</p>
							@elseif (!empty($alarm))
							<div class="col-xs-12">
								<table class="table table-bordered table-dark" id="alarm">
								<tr scope="row">
									<th scope="col" width="10%">Номер заявки</th>
									<th scope="col" width="10%">Имя</th>
									<th scope="col" width="60%">Содержание заявки</th>
									<th scope="col" width="20%">Действия</th>
								</tr>
									@foreach ($alarm as $obj)
										<tr>
										@foreach($obj as $tbl)
											@if (is_numeric($tbl))
												<td class="btn btn-danger" id="bit">{{ $tbl }}</td>
											@elseif (is_string($tbl))
												<td>{{ $tbl }}</td>
											@endif
										@endforeach
										<td>
										<a class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-app="{{ $obj->bitrix }}" data-name="alarm" name="del">Отменить заявку</a>
										<br>
										<a class="btn btn-success" id="{{ $obj->bitrix }}" name="read" href="http://sd.cloud1.vidimtech.com/appalarm?id={{ $obj->bitrix }}">Просмотреть заявку</a>
										</td>
										</tr>
									@endforeach
								</table>
							</div>
							@endif
							
							<div class="col-xs-12">
								<label for="it" class="control-label col-xs-2">Заявки на IT-поддержку</label><br>
							</div>
							@if (empty($it[0]))
								<p>У вас нет заявок на IT-поддержку.</p>
							@elseif (!empty($it))
							<div class="col-xs-12">
								<table class="table table-bordered table-dark" id="it">
								<tr scope="row">
									<th scope="col" width="10%">Номер заявки</th>
									<th scope="col" width="10%">Имя</th>
									<th scope="col" width="60%">Содержание заявки</th>
									<th scope="col" width="20%">Действия</th>
								</tr>
									@foreach ($it as $obj)
										<tr>
										@foreach($obj as $tbl)
											@if (is_numeric($tbl))
												<td class="btn btn-danger" id="bit">{{ $tbl }}</td>
											@endif
											@if (is_string($tbl))
												<td>{{ $tbl }}</td>
											@endif
										@endforeach
										<td> 
										<a class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-app="{{ $obj->bitrix }}" data-name="it" name="del">Отменить заявку</a>
										<br>
										<a class="btn btn-success" id="{{ $obj->bitrix }}" name="read" href="http://sd.cloud1.vidimtech.com/appit?id={{ $obj->bitrix }}">Просмотреть заявку</a>
										</td>
										</tr>
									@endforeach
								</table>
							</div>
							@endif
							
							</div>
						</div>
						</form>
					</div>
				<div class="card-footer">
				</div>
			</div>
		</div> <!-- Конец карточки -->
		<div class="col-lg-1">
		</div>
	</div>
</form>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Подтвердите отмену</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Вы уверены что хотите отменить данную заявку?<br>
		Данное действие необратимо и возможно потребует создания новой заявки в дальнейшем.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
        <a type="button" id="route" class="btn btn-danger" href="">Да</a>
		
      </div>
    </div>
  </div>
</div>
@endsection