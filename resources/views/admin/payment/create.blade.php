@extends('layouts.admin.template')
@push('page-header', 'Tambah Data Metode Pembayaran')


@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Kategori Campaign</h4>
            </div>
            <div class="card-body">
                <form action="{{route('payment.store')}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Metode Pembayaran:</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="name" maxlength="50" placeholder="Metode Pembayaran" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Logo :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="logo" maxlength="50" placeholder="Logo" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Akun :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="account" maxlength="50" placeholder="Akun" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('payment.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        @if ($errors->any())
            <div class="card">
                <div class="card-body">
                    <h5>Terdapat kesalahan: </h5>
                    <div class="text-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection