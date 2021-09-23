@extends('layouts.admin.template')
@section('content')

<div>
    <h2>Tambah Metode Pembayaran</h2>
        <form action="{{route('payment.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Metode Pembayaran:</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="">
                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="logo">Logo :</label><br>
                <input type="text" class="form-control" name="logo" id="logo" placeholder="">
                @error('logo')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="account">Akun :</label>
                <input type="text" class="form-control" name="account" id="account" placeholder="">
                @error('akun')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
</div>


@endsection