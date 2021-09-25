<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Jabar Bangkit Bersama | Daftar</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
	@include('sweetalert::alert')
<div class="register-box" style="width: 380px">
	<div class="register-logo">
		<strong>Jabar Bangkit Bersama</strong>
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body register-card-body">
			<p class="register-box-msg">Daftarkan akun anda dan mulai berdonasi!</p>

			<form action="{{ route('registered') }}" method="post">
				@csrf
				<div class="input-group">
					<input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
				<div class="input-group mt-3">
					<input type="text" class="form-control" name="email" placeholder="Email" required>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>
				@error('email') <span class="text-danger">Email tersebut telah digunakan!</span> @enderror
				<div class="input-group mt-3">
					<input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="off">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="input-group mt-3">
					<input type="password" class="form-control" name="confirm_password" placeholder="Konfirmasi Password" required autocomplete="off">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				@error('confirm_password') <span class="text-danger">Password tidak sama!</span> @enderror
				<div class="row mt-3">
					<!-- /.col -->
					<div class="col-12">
						<button type="submit" class="btn btn-primary btn-block">Daftar</button>
						<div class="text-center mt-4">
							<a href="{{ route('login') }}">Sudah punya akun? Login disini!</a>
						</div>
					</div>
					<!-- /.col -->
				</div>
			</form>
		</div>
		<!-- /.login-card-body -->
	</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>
</body>
</html>
