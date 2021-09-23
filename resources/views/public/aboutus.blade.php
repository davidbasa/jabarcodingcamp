@extends('public.layout')

@section('content')
<div class="position-relative overflow-hidden bg-light jbb-navbar mt-5">
    <div class="row px-auto">
        <div class="col-md-3 offset-md-3 p-sm-2 p-lg-5 mt-5 text-center">
            <h1 class="fw-normal ">Tentang Jabar Bangkit Bersama</h1>
        </div>
        <div class="col-md-3">
            <center>
                <img
                    src="{{ asset('img/2650149.jpg') }}"
                    class="banner-image"
                    alt="Banner"
                >
            </center>
        </div>
    </div>
</div>

<div class="container mt-5">
    <p>
        <b><i>Jabar Bangkit Bersama</i></b> Situs donasi dan menggalang dana (fundraising) untuk inisiatif, campaign dan program sosial. Mari bergotong royong membangun Indonesia!
    </p>
</div>
@endsection