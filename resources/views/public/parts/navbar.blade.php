<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top jbb-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">Jabar Bangkit Bersama</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('campaign.list') }}">Program Donasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('aboutus') }}">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contactus') }}">Hubungi Kami</a>
                </li>
                <li class="nav-item">
                    @if(auth()->check())
                        <a href="{{ auth()->user()->role_id == 1 ? route('admin.dashboard') : route('donatur.dashboard') }}">
                            <button class="btn btn-success btn-sm">{{ auth()->user()->role_id == 1 ? 'Admin' : 'User' }} Area</button>
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <button class="btn btn-success btn-sm">Login/Daftar</button>
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>