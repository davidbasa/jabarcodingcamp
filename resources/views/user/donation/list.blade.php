@extends('user.layout')


@section('content')
<div class="position-relative overflow-hidden bg-light jbb-navbar mt-5">
    <div class="row px-auto">
        <div class="col-md-3 offset-md-3 text-center d-flex p-5">
            <h1 class="fw-normal m-auto">Riwayat Donasi Saya</h1>
        </div>
        <div class="col-md-3">
            <center>
                <img
                    src="{{ asset('img/10820.jpg') }}"
                    class="banner-image"
                    alt="Banner"
                >
            </center>
        </div>
    </div>
</div>

<div class="container my-4">

    <div class="row g-4">
        @foreach($last_donation as $item)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card shadow-sm card-campaign">
                <img src="{{ asset('img/banner/' . $item->campaign->banner) }}" alt="{{ $item->campaign->name }}" width="100%"/>
                <div class="card-body">
                    <h4 class="campaign-title">{{ $item->campaign->name }}</h4>
                    <small>{!!donation_status_label($item->status) !!}</small>
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Jumlah Donasi</small>
                        <small>Tanggal</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="total-donation">{{ formatRupiah($item->amount) }}</span>
                        <small class="text-muted">{{ $item->created_at }}</small>
                    </div>
                    <a href="{{ route('donatur.donasi.detail', $item->id) }}" class="d-grid mt-3">
                        <button class="btn btn-success btn-sm text-center">
                            Detail Donasi
                        </button>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection