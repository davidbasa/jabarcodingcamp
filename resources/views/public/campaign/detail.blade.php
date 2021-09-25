@extends('public.layout')

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
                        Target: {{ formatRupiah($data->target) }}
                    </div>
                    <div class="cpDurasi">
                        Sisa Hari: {{ countRangeDayUntilToday($data->duration) }}
                    </div>

                    <div class="cpTerkumpul">
                        Terkumpul: Rp. 14.645.623
                    </div>

                    <a href="{{ route('donation.create', $data->slug) }}" class="d-grid mt-3">
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