@extends('public.layout')

@push('styles')
    <style>
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance:textfield;
        }
    </style>
@endpush

@section('content')
<br><br><br>
<div class="container my-4">
    <div class="row g-4">
        <div class="col-sm-12 col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4>Donasi {{$campaign->name}}</h4>
                    <form method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="amount" class="form-label">Jumlah Donasi</label>
                            <input type="number" name="amount" id="amount" class="form-control" required/>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Doa/Komentar</label>
                            <textarea name="comment" id="comment" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="payment" class="form-label">Cara Pembayaran</label>
                            <select name="payment" id="payment" class="form-control" required>
                                <option value="">Pilih Cara Pembayaran</option>
                                @foreach($payment as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="anonym" name="anonym" value="true">
                                <label class="form-check-label" for="anonym">Sembunyikan identitas?</label>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Buat Donasi</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection