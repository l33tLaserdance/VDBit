@extends('layouts.admin')

@section('title', 'Работа с пользователями')
@section('content')
<div class="container">
	@csrf
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
				@if (isset($message))
					<div class="alert alert-warning">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
					<strong>Внимание!</strong><p> {{ $message }} </p>
					@if ($messagealarm != 'Нет')
						<p> {{ $messagealarm }} </p>
					@endif
					@if ($messagescud != 'Нет')
						<p> {{ $messagescud }} </p>
					@endif
					@if ($messagesvn != 'Нет')
						<p> {{ $messagesvn }} </p>
					@endif
					@if ($messageit != 'Нет')
						<p> {{ $messageit }} </p>
					@endif
					<p>{{ $messagere }}</p>
				  </div>
				@endif
				@if (session('message'))
				@if (session('message') == 'Редактирование данного пользователя запрещено.')
				  <div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
					<strong>Ошибка.</strong><p> {{ session('message') }} </p>
				  </div>
				@else
				  <div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
					<strong>Успешно!</strong><p> {{ session('message') }} </p>
				  </div>
				@endif
				@endif
                <div class="card-header">
					<div class="row">
						<div class="col-lg-4">
							<button type="submit" class="back" onclick="window.location='{{ route('admin')}}'">
								{{ __('Назад') }}
							</button>
							<button type="submit" class="back" onclick="window.location='{{ route('createuser')}}'">
								{{ __('Создать') }}
							</button>
						</div>
						<div class="col-lg-8" style="text-align: right">
							Пользователи
						</div>
					</div>
				</div>
				<!--<img class="fulllogomain" src="http://sd.cloud1.vidimtech.com/images/vdfulllogo.png">-->
                <div class="card-body">
					<div class="row">
						<div class="col-lg-1">
						</div>
						
						<div class="col-lg-10">
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
								<div class="col-xs-12">
									<table class="table table-bordered table-dark" id="it">
									<tr scope="row">
										<th scope="col" width="10%">ID</th>
										<th scope="col" width="35%">Имя</th>
										<th scope="col" width="35%">Email</th>
										<th scope="col" width="20%">Действия</th>
									</tr>
										@foreach ($users as $obj)
											<tr>
											@foreach($obj as $tbl)
												@if (is_numeric($tbl))
													<td id="id">{{ $tbl }}</td>
												@endif
												@if (is_string($tbl))
													<td>{{ $tbl }}</td>
												@endif
											@endforeach
											@if ($obj->id != 4)
											<td>
												<a class="btn btn-success" id="{{ $obj->id }}" name="read" href="http://sd.cloud1.vidimtech.com/admin/updateuser?id={{ $obj->id }}"><i class="fas fa-user-edit"></i></a>
												<a class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-app="{{ $obj->name }}" data-id="{{ $obj->id }}" name="del"><i class="fas fa-user-slash"></i></a>
											</td>
											@else
											<td>
												<p style="text-align: center;">Действия запрещены.</p>
											</td>
											@endif
											</tr>
										@endforeach
									</table>
								</div>
							</form>
						</div>
						
						<div class="col-lg-1">
						</div>
						</div>
                </div>
				<div class="card-footer main">
				</div>
            </div>
        </div>
    </div>
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
        Вы уверены что хотите удалить пользователя?<br>
		Данное действие отменить невозможно.<br>
		Если у пользователя остались незакрытые заявки, они будут автоматически переданы текущему пользователю.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
        <a type="button" id="route" class="btn btn-danger" href="">Да</a>
		
      </div>
    </div>
  </div>
</div>
@endsection