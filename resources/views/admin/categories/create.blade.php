@extends('layouts.admin.template')
@push('page-header', 'Tambah Data Kategori Campaign')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Kategori Campaign</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="post" class="form-horizontal">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nama Kategori :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="name" maxlength="50" placeholder="Nama Kategori" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
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