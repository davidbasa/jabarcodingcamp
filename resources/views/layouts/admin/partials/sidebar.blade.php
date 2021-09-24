	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="{{ route('admin.dashboard') }}" class="brand-link">
			<img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light" style="font-size: 1.1rem">Jabar Bangkit Bersama</span>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="{{ asset('img/default.jpg') }}" class="img-circle elevation-2" alt="Profile Photo">
				</div>
				<div class="info">
					<a href="#" class="d-block">{{ Auth::user()->name }}</a>
				</div>
			</div>

			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
					<li class="nav-header">Masterdata</li>
					<li class="nav-item">
						<a href="{{ route('campaign.index') }}" class="nav-link">
							<i class="fas fa-hand-holding-heart nav-icon"></i>
							<p>Campaign</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('categories.index') }}" class="nav-link">
							<i class="fas fa-grip-horizontal nav-icon"></i>
							<p>Kategori Campaign</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="/admin-area/payment" class="nav-link">
							<i class="far fa-credit-card nav-icon"></i>
							<p>Metode Pembayaran</p>
						</a>
					</li>
					<li class="nav-header">Transaksi</li>
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="fas fa-donate nav-icon"></i>
							<p>Donasi Masuk</p>
						</a>
					</li>
					<li class="nav-header">Admin Area</li>
					<li class="nav-item">
						<a href="/admin-area/user" class="nav-link">
							<i class="fas fa-users-cog nav-icon"></i>
							<p>Manajemen User</p>
						</a>
					</li>
					<li class="nav-header">Logout</li>
					<li class="nav-item">
						<a href="{{ route('logout') }}" class="nav-link">
							<i class="fas fa-sign-out-alt nav-icon"></i>
							<p>Logout</p>
						</a>
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>