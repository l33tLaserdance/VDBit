@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Проверка адреса электронной почты') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Новая ссылка подтверждения электронной почты была выслана на ваш Email-адрес.') }}
                        </div>
                    @endif

                    {{ __('Прежде чем продолжить, проверьте вашу электронную почту на ссылку подтверждения.') }} <!--Before proceeding, please check your email for a verification link.-->
                    {{ __('Если письмы с ссылкой не получено') }}, <a href="{{ route('verification.resend') }}">{{ __('нажмите сюда чтобы получить новое.') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
