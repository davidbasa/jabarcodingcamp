@extends('public.layout')

@section('content')
<br><br><br>
<div class="container my-4">
    <div class="row g-4">
        <div class="col-sm-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="campaign-banner">
                        <img src="https://imgix.kitabisa.com/e88b7578-7707-4043-a77f-f662d9ee429e.jpg?ar=16:9&w=664&auto=format,compress" alt="" width="100%">
                    </div>
                    <div class="campaign-data mt-2">
                        <h3 class="cpTitle">Judul Campaign</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5>Informasi Donasi</h5>
                    <div class="cpTarget">
                        Target: Rp 15.000.000
                    </div>
                    <div class="cpDurasi">
                        Sisa Hari: 99
                    </div>

                    <div class="cpTerkumpul">
                        Terkumpul: Rp. 14.645.623
                    </div>

                    <a href="{{ route('donation.create', 'contoh') }}" class="d-grid mt-3">
                        <button class="btn btn-success btn-lg text-center">
                            Berikan Donasi
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection