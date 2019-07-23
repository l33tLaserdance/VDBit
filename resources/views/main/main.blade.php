@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Главное меню') }}</div>
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