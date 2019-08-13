@extends('layouts.app')

@section('title', 'Главное меню')
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
				@if (Auth::user()->name == 'NewReg')
                <div class="card-header" style="height: 190px">
				@else
				<div class="card-header">
				@endif
					{{ __('Главное меню') }}
					<div class="form-group row mb-0">
                            <div class="col-lg-12 col-form-label">
                                <a class="btn vdbtn container-fluid" href="{{ route('showapplist') }}">
                                    {{ __('Мои заявки') }}
                                </a>
                            </div>
                    </div>
					@if (Auth::user()->name == 'NewReg')
					<div class="form-group row mb-0">
                            <div class="col-lg-12 col-form-label">
                                <a class="btn vdbtn container-fluid" href="{{ route('admin') }}">
                                    {{ __('Администрирование') }}
                                </a>
                            </div>
                    </div>	
					@endif
				</div>
				<!--<img class="fulllogomain" src="http://sd.cloud1.vidimtech.com/images/vdfulllogo.png">-->
                <div class="card-body">
                        @csrf

                        <div class="form-group row mb-0">
                            <div class="col-lg-12 col-form-label">
                                <a class="btn vdbtn container-fluid" href="/main/it">
                                    {{ __('IT-поддержка') }}
                                </a>
                            </div>
                        </div>
						
						<div class="form-group row mb-0">
                            <div class="col-lg-12 col-form-label">
                                <a class="btn vdbtn container-fluid" href="/main/alarm">
                                    {{ __('Обслуживание охранной сигнализации') }}
                                </a>
                            </div>
                        </div>
						
						<div class="form-group row mb-0">
                            <div class="col-lg-12 col-form-label">
                                <a class="btn vdbtn container-fluid" href="/main/svn">
                                    {{ __('Обслуживание СВН') }}
                                </a>
                            </div>
                        </div>
						
						<div class="form-group row mb-0">
                            <div class="col-lg-12 col-form-label">
                                <a class="btn vdbtn container-fluid" href="/main/scud">
                                    {{ __('Обслуживание СКУД') }}
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
                                        {{ __('Выход') }}
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