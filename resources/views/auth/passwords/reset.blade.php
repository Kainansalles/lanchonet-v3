<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
	<meta charset="utf-8" />
	<title>{{ config('app.name', 'Laravel') }}</title>
	<meta name="description" content="Lanchonet - formulário de resete senha do admin">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!--begin::Web font -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
	</script>
	<!--end::Web font -->
	<!--begin::Base Styles -->
	<link href="{{ asset('css/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Base Styles -->
	<link rel="shortcut icon" href="{{ asset('img/oficial-logo-ico.ico') }}" />
</head>
<!-- end::Head -->
<!-- end::Body -->
<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
	<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url({{ asset('img/bg-3.jpg') }});">
		<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
			<div class="m-login__container">
				<div class="m-login__logo">
					<a href="#">
						<img src="{{ asset('img/oficial-logo-email.png') }}">
					</a>
				</div>
				<div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title">
                            Alteração de senha
                        </h3>
                        <div class="m-login__desc">
                            Insira os dados abaixo para confirmar a alteração da senha:
                        </div>
                    </div>
					<form class="m-login__form m-form" action="{{ route('password.update') }}" method="POST">
						@csrf
						<input type="hidden" name="token" value="{{ $token }}">
						
						<div class="form-group m-form__group">
							<input class="form-control m-input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Email" autocomplete="off">
							@if ($errors->has('email'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group m-form__group">
							<input class="form-control m-input m-login__form-input--last {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Senha" name="password">
							@if ($errors->has('password'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
                        </div>

						<div class="form-group m-form__group">
                            <input id="password-confirm" type="password" class="form-control m-input m-login__form-input--last" name="password_confirmation" placeholder="Confirmar senha">
						</div>

						<div class="m-login__form-action">
							<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
								Resetar senha
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end:: Page -->
<!--begin::Base Scripts -->
<script src="{{ asset('js/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Page Snippets -->
</body>
<!-- end::Body -->
</html>









