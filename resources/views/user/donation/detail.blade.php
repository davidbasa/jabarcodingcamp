@extends('user.layout')

@section('content')
<br><br><br>
<div class="container my-4">
    <div class="row g-4">
        <div class="col-sm-12 col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4>Donasi: #{{$donation->id}}</h4>
                    <dl>
                        <dt>Campaign</dt>
                        <dd>{{$campaign->name}}</dd>
                        <dt>Komentar</dt>
                        <dd>{!! nl2br($donation->comment) ?? '-' !!}</dd>
                        <dt>Sembunyikan Nama Donatur?</dt>
                        <dd>{{ $donation->anonym ? 'Ya' : 'Tidak' }}</dd>
                        <dt>Jumlah</dt>
                        <dd>{{formatRupiah($donation->amount)}}</dd>
                        <dt>Metode Pembayaran</dt>
                        <dd>{{$payment->name}} | <b>{{$payment->account}}</b></dd>
                        <dt>Dibuat</dt>
                        <dd>{{\Carbon\Carbon::parse($donation->created_at)->translatedFormat('l, d F Y H:i')}}</dd>
                        <dt>Status</dt>
                        <dd>
                            @switch($donation->status)
                                @case('waiting_transfer')
                                <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                                @break
                                @case('cancel')
                                <span class="badge bg-danger">Dibatalkan</span>
                                @break
                                @case('waiting_transfer')
                                <span class="badge bg-success">Berhasil</span>
                                @break
                            @endswitch
                        </dd>
                    </dl>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection