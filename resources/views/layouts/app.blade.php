<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'VD Bitrix') }}</title>
	
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
	<script src="{{ asset('jquery.js') }}" defer></script>
	<script type="text/javascript" src="https://unpkg.com/popper.js" defer></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap-confirmation2/dist/bootstrap-confirmation.min.js" defer></script>
	<script type="module">
		$('#exampleModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('app') // Extract info from data-* attributes
			var type = button.data('name')
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Удаление заявки №' + recipient)
			modal.find('.modal-body input').val(recipient)
			document.getElementById('route').href="http://sd.cloud1.vidimtech.com/main/delete"+type+"?id="+recipient
		})
	</script>
	
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<style>
			@font-face {
				font-family: MarsfontRegular;
				src: url('/fonts/MarsfontRegular.ttf') format('truetype');
			}
			
			#app {
				box-sizing: border-box;
				min-height: 100vh;
			}
			
			.footer {
				background-color: #241919;
				margin-top: 170px;
				color: #f7f7f7;
				padding-top: 54px;
				padding-right: 0;
				padding-bottom: 0;
				padding-left: 0;
				position: inherit;
				bottom: 0;
				left: 0;
				right: 0;
			}
			
			.card-header {
				font-size: 22px;
				background-color: #241919;
				color: #f7f7f7;
				height: 90px;
			}
			
            .vdbtn {
				background-color: #459643;
				color: white;
				font-size: 22px;
				//background: rgb(0,36,36);
				//background: linear-gradient(0deg, rgba(0,36,36,1) 0%, rgba(69,150,67,1) 86%);
				display: inline-block;
			}
			
			a.vdbtn:hover {
				background-color: rgba(38,128,255,.8);
				color: white;
			}
			
			a.vdbtn:focus {
				box-shadow: 0 0 0 .3rem gray;
			}
			
			.fulllogomain {
				right: 20px;
				position: absolute;
				margin-top: 10px;
			}
			
			.fulllogo {
				left: 20px;
				position: absolute;
				height: 48px;
				width: 180px;
			}
			
			a.navbar-brand {
				background-repeat: no-repeat;
				background: url(http://sd.cloud1.vidimtech.com/images/logosite41.png) 100% 100% no-repeat;
				background-size: 60px;
				width: 60px;
				height: 25px;
			}
			
			.card-body h1 {
				margin-top: 25px;
				text-align: center;
				font-family: 'Roboto',Helvetica,Arial,Lucida,sans-serif;
				font-weight: 700;
				font-size: 45px;
				line-height: 1.2em;
			}
			
			.control-label {
				font-size: 18px;
				line-height: 20px;
			}
			
			.sender {
				background: #333;
				border: 0;
				color: #f7f7f7;
				transition: all .5s;
				height: 50px;
				width: auto;
				font-size: 16px;
				margin: 0;
				padding: 12px;
			}
			
			.sender:hover {
				background: #c4c4c4;
				color: #787878;
				transition: all .5s;
			}
			
			.back {
				border-width: 0 !important;
				border-color: rgba(0,0,0,0);
				border-radius: 56px;
				letter-spacing: 1px;
				font-size: 16px;
				text-transform: uppercase !important;
				background-color: rgba(0,177,92,.9);
				padding-top: 18px !important;
				padding-bottom: 18px !important;
				padding-left: 34px !important;
				padding-right: 34px !important;
				color: #fff !important;
				transition: all 300ms ease 0ms;
				margin-left: 10px;
			}
			
			.back:hover {
				background: rgba(38,128,255,.8) !important;
				border-color: rgba(255,255,255,0) !important;
			}
			
			body {
				font-family: MarsfontRegular,Helvetica,Arial,Lucida,sans-serif;
			}
			
			.form-control {
				font-size: 16px;
			}
			
			.star {
				color: red;
			}
			
			.fields {
				font-size: 14px;
			}
			
			.card-footer {
				background-color: #459643;
			}
			
			.main {
				background-color: black;
			}
			
			.arrow::after {
				content: "\f078";
				font-family: FontAwesome;
				font-size: 20px;
				position: absolute;
				right: 10px;
				bottom: 0;
				height: 50px;
				line-height: 50px
			}
			
			.policy {
				text-align: center;
			}
			
			div.row {
				margin-right: 0px;
				margin-left: 0px;
			}
			
			div.logo {
				text-align: center;
			}
			
			table {
				text-align: center;
			}
			
			a[name=read] {
				width: 156px;
				background-color: #459643;
				margin-top: 10px;
				margin-bottom: 10px;
			}
			
			a[name=del] {
				margin-top: 10px;
				width: 156px;
			}
			
			td#bit {
				margin-top: 10px;
				margin-bottom: 10px;
			}
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
				@guest
					@if (Route::has('login'))
					<a class="navbar-brand" href="{{ url('/') }}">
					</a>
					@endif
					@else
					<a class="navbar-brand" href="{{ url('/main') }}">
					</a>
				@endguest
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.scud.index') }}">
									СКУД
                                </a>
                            </li>
							<li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								
									<a class="dropdown-item" href="{{ route('showapplist') }}">
                                        {{ __('Мои заявки') }}
                                    </a>
									
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Выход') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<div class="footer">
	<div class="row">
		<div class="col-lg-3">
		</div>
		<div class="col-lg-2 address">
			<label>Москва, Переведеновский пер., 18</label><br>
			<label>+7 (499) 404-24-20</label><br>
			<label>info@vidim.pro</label>
		</div>
		<div class="col-lg-2 logo">
			<img class="fulllogo" src="http://sd.cloud1.vidimtech.com/images/vdfulllogo.png"><br>
			<label style="padding-top: 70px">Политика конфиденциальности</label>
			<label style="padding-top: 20px; padding-bottom: 50px">© ООО «ВДТех», 2019</label>
		</div>
		<div class="col-lg-2 inst">
		</div>
		<div class="col-lg-3">
		</div>
	</div>
</div>
</html>
