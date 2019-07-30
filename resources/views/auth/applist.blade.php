@extends('layouts.app')

@section('content')
<div class="container">
<form method="POST" action="{{ route('showapplist') }}">
	@csrf
	<div class="row justify-content-center">
		<div class="col-lg-2">
		</div>
		<div class="col-lg-8">
			<div class="card"> <!-- Начало карточки -->
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
						<h1>Ваши заявки</h1><br>
						<div class="form-group">
							<div class="col-xs-9">
								<label for="scud" class="control-label col-xs-2">Заявки на обслуживание СКУД</label><br>
							</div>
							@if (empty($scud[0]))
								<p>У вас нет заявок на обслуживание СКУД.</p>
							@elseif (!empty($svn))
							<div class="col-xs-9">
								<table class="table table-bordered table-dark" id="scud">
								<tr scope="row">
									<th scope="col" width="15%">Номер заявки</th>
									<th scope="col" width="15%">Имя</th>
									<th scope="col" width="70%">Содержание заявки</th>
								</tr>
									@foreach ($scud as $obj)
										<tr scope="row">
										@foreach($obj as $tbl)
											@if (is_numeric($tbl))
												<td class="btn btn-danger"> {{ $tbl }}</td>
											@elseif (is_string($tbl))
												<td> {{ $tbl }}</td>
											@endif
										@endforeach
										</tr>
									@endforeach
								</table>
							@endif
							
								<div class="col-xs-9">
								<label for="scud" class="control-label col-xs-2">Заявки на обслуживание СВН</label><br>
							</div>
							@if (empty($svn[0]))
								<p>У вас нет заявок на обслуживание СВН.</p>
							@elseif (!empty($svn))
							<div class="col-xs-9">
								<table class="table table-bordered table-dark" id="svn">
								<tr scope="row">
									<th scope="col" width="15%">Номер заявки</th>
									<th scope="col" width="15%">Имя</th>
									<th scope="col" width="70%">Содержание заявки</th>
								</tr>
									@foreach ($svn as $obj)
										<tr scope="row">
										@foreach($obj as $tbl)
											@if (is_numeric($tbl))
												<td class="btn btn-danger">{{ $tbl }}</td>
											@elseif (is_string($tbl))
												<td>{{ $tbl }}</td>
											@endif
										@endforeach
										</tr>
									@endforeach
								</table>
							</div>
							@endif
							
							<div class="col-xs-9">
								<label for="alarm" class="control-label col-xs-2">Заявки на обслуживание охранной сигнализации</label><br>
							</div>
							@if (empty($alarm[0]))
								<p>У вас нет заявок на обслуживание охранной сигнализации.</p>
							@elseif (!empty($alarm))
							<div class="col-xs-9">
								<table class="table table-bordered table-dark" id="alarm">
								<tr scope="row">
									<th scope="col" width="15%">Номер заявки</th>
									<th scope="col" width="15%">Имя</th>
									<th scope="col" width="70%">Содержание заявки</th>
								</tr>
									@foreach ($alarm as $obj)
										<tr scope="row">
										@foreach($obj as $tbl)
											@if (is_numeric($tbl))
												<td class="btn btn-danger">{{ $tbl }}</td>
											@elseif (is_string($tbl))
												<td>{{ $tbl }}</td>
											@endif
										@endforeach
										</tr>
									@endforeach
								</table>
							</div>
							@endif
							
							<div class="col-xs-9">
								<label for="it" class="control-label col-xs-2">Заявки на обслуживание охранной сигнализации</label><br>
							</div>
							@if (empty($it[0]))
								<p>У вас нет заявок на обслуживание охранной сигнализации.</p>
							@elseif (!empty($it))
							<div class="col-xs-9">
								<table class="table table-bordered table-dark" id="it">
								<tr scope="row">
									<th scope="col" width="15%">Номер заявки</th>
									<th scope="col" width="15%">Имя</th>
									<th scope="col" width="70%">Содержание заявки</th>
								</tr>
									@foreach ($it as $obj)
										<tr scope="row">
										@foreach($obj as $tbl)
											@if (is_numeric($tbl))
												<td class="btn btn-danger">{{ $tbl }}</td>
											@endif
											@if (is_string($tbl))
												<td>{{ $tbl }}</td>
											@endif
										@endforeach
										</tr>
									@endforeach
								</table>
							</div>
							@endif
							
							</div>
						</div>
					</div>
				<div class="card-footer">
				</div>
			</div>
		</div> <!-- Конец карточки -->
		<div class="col-lg-2">
		</div>
	</div>
</form>
</div>
@endsection