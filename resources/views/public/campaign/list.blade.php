@extends('public.layout')

@section('content')
<br><br><br>
<div class="container">
    <h1 class="text-center">List Campaign</h1>
</div>
<div class="container my-4">
    <div class="row g-4">
        @foreach($list as $item)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card shadow-sm card-campaign">
                <img src="{{ asset('img/banner/' . $item->banner) }}" alt="{{ $item->name }}" width="100%"/>
                <div class="card-body">
                    <h4 class="campaign-title">{{ $item->name }}</h4>
                    <small>{!!campaign_category_label($item->category->id, $item->category->name) !!}</small>
                    <div class="progress my-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$item->percentage}}%" aria-valuenow="{{$item->percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Terkumpul</small>
                        <small>Sisa hari</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="total-donation">{{ formatRupiah($item->fund_collected) }}</span>
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
@endsection