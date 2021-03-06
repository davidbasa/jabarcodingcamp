<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Jabar Bangkit Bersama</title>
	<link rel="shortcut icon" href="{{ asset('img/logo/favicon.ico') }}" type="image/x-icon">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href=" {{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href=" {{ asset('css/adminlte.min.css') }}">
	@stack('head')
</head>
<body class="hold-transition sidebar-mini">
	@include('sweetalert::alert')
	<!-- Site wrapper -->
	<div class="wrapper">
		@include('layouts.admin.partials.header')
		@include('layouts.admin.partials.sidebar')
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-12">
							<h1>@stack('page-header')</h1>
						</div>
					</div>
				</div>
			</section>
			<section class="content">
				@yield('content')
			</section>
		</div>
		<!-- /.content-wrapper -->
		@include('layouts.admin.partials.footer')
	</div>
	<!-- ./wrapper -->
	<!-- jQuery -->
	<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('js/adminlte.min.js') }}"></script>

	@stack('script')
</body>
</html>
