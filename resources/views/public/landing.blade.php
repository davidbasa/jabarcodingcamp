@extends('public.layout')

@section('content')
<div class="position-relative overflow-hidden bg-light jbb-navbar mt-5">
    <div class="col-md-8 p-sm-2 p-lg-5 mx-auto my-5 banner">
        <h1 class="display-4 fw-normal title">Jabar Bangkit Bersama</h1>
        <p class="lead fw-normal">Jadilah bagian dari gerakan sosial menyebarkan kebahagaiaan ke segala penjuru jawa barat.</p>
        <a class="btn btn-success btn-lg" href="{{ route('campaign.list') }}"><i class="fa-solid fa-hand-holding-heart text-white"></i> Mulai Berdonasi</a>
    </div>
</div>

@for ($i = 0; $i < count($data); $i++)
    @if (count($data[$i]['data']) > 0)
        <div class="container my-4">
            <h3 class="campaign-category">
                <a href="/category/1">
                    Donasi {{ $data[$i]['name'] }} <i class="fa-solid fa-chevron-right"></i>
                </a>
            </h3>
            <div class="row g-4">
                @foreach ($data[$i]['data'] as $item)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card shadow-sm card-campaign">
                            <img src="{{ asset('img/banner/' . $item->banner) }}" alt="{{ $item->name }}" width="100%"/>
                            <div class="card-body">
                                <h4 class="campaign-title">{{ $item->name }}</h4>
                                <div class="progress my-3">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small>Terkumpul</small>
                                    <small>Sisa hari</small>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="total-donation">{{ formatRupiah($item->collected) }}</span>
                                    <small class="text-muted">{{ countRangeDayUntilToday($item->duration) }} hari</small>
                                </div>
                                <a href="{{ route('campaign.detail', $item->slug) }}" class="d-grid mt-3">
                                    <button class="btn btn-success btn-sm text-center">
                                        Donasi Sekarang
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endfor
@endsection