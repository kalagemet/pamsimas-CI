<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			Sistem Informasi Pamsimas | Gerbang Layanan
		</title>
		<meta name="description" content="Latest updates and statistic charts">
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
		<link href="{{asset('assets/src/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="{{asset('assets/demo/default/media/img/logo/favicon.ico')}}" />
	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1" id="m_login" style="background: linear-gradient(#194799, #1cb5e0);">
				<div class="m-grid__item m-grid__item--fluid m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img src="{{asset('assets/src/media/app/img/logos/logo-1.png')}}">
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">
									SISTEM INFORMASI PAMSIMAS
								</h3>
							</div>
							<form class="m-login__form m-form" id="m-form_login" action="{{ route('login.cabang') }}" method="post">
								{{ csrf_field() }}
								<div class="form-group m-form__group">
									<input class="form-control m-input"   type="text" placeholder="Kode Cabang" name="cabang" onkeyPress="return angka(event)" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
								</div>
								<div class="row m-login__form-sub">
									<div class="col m--align-left m-login__form-left">
										<label class="m-checkbox  m-checkbox--light">
											<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
												Ingat saya
											<span></span>
										</label>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary">
										Masuk
									</button>
								</div>
							</form>
						</div>
						<div class="m-login__signup">
							<div class="m-login__head">
								<h3 class="m-login__title">
									Administrator
								</h3>
								<div class="m-login__desc">
									Administrator Pamsimas Desa
								</div>
							</div>

							<!-- //====================================
							// Login admin
							//==================================== -->

							<form class="m-login__form m-form" id="m-form_login-admin" role="form" action="{{ route('login.admin') }}" method="post">
								{{ csrf_field() }}
								<div class="form-group m-form__group">
									<input class="form-control m-input" onkeyPress="return angka(event)" type="text" placeholder="NIK" name="nik" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
								</div>
								<div class="row m-login__form-sub">
									<div class="col m--align-left m-login__form-left">
										<label class="m-checkbox  m-checkbox--light">
											<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
												Ingat saya
											<span></span>
										</label>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_sigin_admin" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
										Masuk
									</button>
									&nbsp;&nbsp;
									<button id="m_login_signup_cancel" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">
										Kembali
									</button>
								</div>
							</form>
						</div>
						<div class="m-login__account">
							<span class="m-login__account-msg">
								Login Administrator
							</span>
							&nbsp;&nbsp;
							<a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">
								Masuk
							</a>
						</div>
						<div class="spasi"></div>
						<div class="m-login__logo">
							<a href="#">
								<img src="{{asset('assets/demo/default/media/img/logo/logo_pam.png')}}">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<style type="text/css">
			.spasi{
				margin-top:50px;
			}
		</style>
		<script src="{{asset('assets/js/component/number.js')}}" type="text/javascript"></script>
		<!-- end:: Page -->
		<!--begin::Base Scripts -->
		<script src="{{asset('assets/src/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
		<!--end::Base Scripts -->   
		<!--begin::Page Snippets -->
		<script src="{{asset('assets/src/js/snippets/custom/pages/user/login.js')}}" type="text/javascript"></script>
		<!--end::Page Snippets -->
        <script src="{{asset('assets/demo/default/custom/components/base/toastr.js')}}" type="text/javascript"></script>
		<!-- //flash berhasil -->
        <script>
            toastr.options = {
				"closeButton": false,
				"debug": false,
				"newestOnTop": false,
				"progressBar": false,
				"positionClass": "toast-top-center",
				"preventDuplicates": false,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			};
        </script>
        @if(Session::has('alert'))
        <script>
            toastr.error('Password atau Nama/Kode, Salah!!!');
        </script>
        @endif
		@if(Session::has('error'))
        <script>
            toastr.error("{{Session::get('error')}}");
        </script>
		@endif
		@if(Session::has('success'))
        <script>
            toastr.error("{{Session::get('success')}}");
        </script>
		@endif
		@if ($errors->any())
		@foreach ($errors->all() as $item)
		<script type="text/javascript">
			toastr.error("{{$item}}");
		</script>
		@endforeach
		@endif
	</body>
	<!-- end::Body -->
</html>