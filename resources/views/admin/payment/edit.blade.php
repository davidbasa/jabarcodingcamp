@extends('layouts.admin.template')
@section('content')

<div>
    <h2>Edit Metode Pembayaran</h2>
        <form action="/admin-area/payment/{{$payment->id}}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Metode Pembayaran:</label>
                <input type="text" class="form-control" name="name" value="{{$payment->name}}" id="name" placeholder="">
                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="logo">Logo :</label><br>
                <input type="text" class="form-control" name="logo" value="{{$payment->logo}}" id="logo" placeholder="">
                @error('logo')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="account">Akun :</label>
                <input type="text" class="form-control" name="account" value="{{$payment->account}}"id="account" placeholder="">
                @error('account')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
</div>


@endsection