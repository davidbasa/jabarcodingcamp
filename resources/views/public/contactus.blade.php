@extends('public.layout')

@section('content')
<div class="position-relative overflow-hidden bg-light jbb-navbar mt-5">
    <div class="row px-auto">
        <div class="col-md-3 offset-md-3 p-sm-2 p-lg-5 mt-5 text-center">
            <h1 class="fw-normal ">Hubungi Kami</h1>
        </div>
        <div class="col-md-3">
            <center>
                <img
                    src="{{ asset('img/5138237.jpg') }}"
                    class="banner-image"
                    width="250"
                    alt="Banner"
                >
            </center>
        </div>
    </div>
</div>

<div class="container mt-5">
    <p>
        Jika anda memiliki kritik / saran / keluhan yang ingin disampaikan, silahkan hubungi kami melalui kontak berikut: <br>
        <ul>
            <li>Email: <a href="mailto:contact@jabarbangkitbersama.com">contact@jabarbangkitbersama.com</a></li>
            <li>Whatsapp: 6284224858290</li>
        </ul>
    </p>
</div>
@endsection