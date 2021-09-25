@extends('layouts.admin.template')
@push('page-header', 'Edit Data Metode Pembayaran')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-7">
                        <h4 class="card-title">Edit Data Metode Pembayaran</h4>
                    </div>
                    <div class="col-lg-5">
                        <div class="text-right">
                            <a href="{{ route('payment.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="button" class="btn btn-warning" id="btn-edit"><i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="btn btn-danger" id="btn-reset" style="display: none"><i class="fas fa-times"></i> Reset</button>
                            <button type="submit" class="btn btn-success" id="btn-submit" form="form-update" disabled><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="/admin-area/payment/{{$payment->id}}" method="post" class="form-horizontal" id="form-update">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Metode Pembayaran:</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="name" maxlength="50" placeholder="Metode Pembayaran" autocomplete="off" required value="{{$payment->name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Logo :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="logo" maxlength="50" placeholder="Logo" autocomplete="off" required value="{{$payment->logo}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Akun :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="account" maxlength="50" placeholder="Akun" autocomplete="off" required value="{{$payment->account}}" readonly>
                        </div>
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

@push('script')
    <script>
        $(document).ready(function (){
            $('#btn-edit').on('click', function () {
                $("input[name=name]").attr('readonly', false);
                $("input[name=logo]").attr('readonly', false);
                $("input[name=account]").attr('readonly', false);

                $('#btn-edit').hide();
                $('#btn-reset').show();
                $('#btn-submit').attr('disabled', false);
            });
            $('#btn-reset').on('click', function () {
                $("input[name=name]").attr('readonly', true);
                $("input[name=name]").val('{{ $payment->name }}');
                $("input[name=logo]").attr('readonly', true);
                $("input[name=logo]").val('{{ $payment->logo }}');
                $("input[name=account]").attr('readonly', true);
                $("input[name=account]").val('{{ $payment->account }}');
                $('#btn-reset').hide();
                $('#btn-edit').show();
                $('#btn-submit').attr('disabled', true);
            });
        });
    </script>
@endpush

<!-- 
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
</div> -->


