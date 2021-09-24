<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top jbb-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">Jabar Bangkit Bersama</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('donatur.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('donatur.donasi')}}">Donasi Saya</a>
                </li>
                <li class="nav-item" style="margin-right: 50px;">
                    <a class="nav-link" href="{{route('donatur.profile')}}">Profil</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}">
                        <button class="btn btn-danger btn-sm">Keluar</button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>