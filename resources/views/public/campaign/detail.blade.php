@extends('public.layout')

@push('styles')
<style>
    .carousel-item.active,
    .carousel-item-next,
    .carousel-item-prev{
        display:block;
    }
</style>
@endpush

@section('content')
<br><br><br>
<div class="container my-4">
    <div class="row g-4">
        <div class="col-sm-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="campaign-banner">
                        <img src="{{ asset('img/banner/' . $data->banner) }}" alt="" width="100%">
                    </div>
                    <div class="campaign-data mt-2">
                        <h3 class="cpTitle">{{$data->name}}</h3>
                        <p>
                            {!! nl2br($data->description) !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5>Informasi Donasi</h5>
                    <div class="cpTarget">
                        Kategori: {{ $data->category->name }}
                    </div>
                    <div class="cpTarget">
                        Target: {{ formatRupiah($data->target) }}
                    </div>
                    <div class="cpDurasi">
                        Sisa Hari: {{ countRangeDayUntilToday($data->duration) }}
                    </div>

                    <div class="cpTerkumpul">
                        Terkumpul: {{ formatRupiah($data->collected) }}
                    </div>

                    <a href="{{ route('donation.create', $data->slug) }}" class="d-grid mt-3">
                        <button class="btn btn-success btn-lg">
                            Berikan Donasi
                        </button>
                    </a>
                </div>
            </div>

            <section class="pt-2">
                <h3 class="mb-3">Komentar Donatur</h3>
                <div id="carouselContent" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach($donations as $idx => $item)
                        <div class="carousel-item {{ $idx === 0 ? 'active' : '' }}">
                            <div class="card">
                                <div class="card-body">
                                    <b>{{ $item->anonym ? 'Anonim' : $item->user->name }} | {{ formatRupiah($item->amount) }}</b>
                                    <p class="my-4">{{nl2br($item->comment)}}</p>
                                    <b>{{ $item->created_at }}</b>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection