@extends('layouts.admin')

@section('title', 'Меню администратора')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
				@if (session('message'))
				  <div class="alert alert-success">
					<strong>Успешно!</strong> {{ session('message') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
				  </div>
				@endif
                <div class="card-header">
					{{ __('Меню администратора') }}
					<div class="form-group row mb-0">
                            <div class="col-lg-12 col-form-label">
                                <a class="btn vdbtn container-fluid" href="{{ route('main') }}">
                                    {{ __('Вернуться к приложению') }}
                                </a>
                            </div>
                    </div>
				</div>
				<!--<img class="fulllogomain" src="http://sd.cloud1.vidimtech.com/images/vdfulllogo.png">-->
                <div class="card-body">
                        @csrf

                        <div class="form-group row mb-0">
                            <div class="col-lg-12 col-form-label">
                                <a class="btn vdbtn container-fluid" href="{{ route('users') }}">
                                    {{ __('Работа с пользователями') }}
                                </a>
                            </div>
                        </div>
                </div>
				<div class="card-footer main">
						<form method="POST" action="{{ route('logout') }}">
						<div class="form-group row mb-0">
                            <div class="col-lg-12 col-form-label">
                                <a class="btn vdbtn container-fluid" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Выход из приложения') }}
                                </a>
                            </div>
                        </div>
						</form>
					</div>
            </div>
        </div>
    </div>
</div>
@endsection