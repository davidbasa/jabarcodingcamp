@extends('layouts.admin.template')
@push('page-header', 'Edit Data Kategori Campaign')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-7">
                        <h4 class="card-title">Edit Data Kategori Campaign</h4>
                    </div>
                    <div class="col-lg-5">
                        <div class="text-right">
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="button" class="btn btn-warning" id="btn-edit"><i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="btn btn-danger" id="btn-reset" style="display: none"><i class="fas fa-times"></i> Reset</button>
                            <button type="submit" class="btn btn-success" id="btn-submit" form="form-update" disabled><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', [$edit->id]) }}" method="post" class="form-horizontal" id="form-update">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nama Kategori :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="name" maxlength="50" placeholder="Nama Kategori" autocomplete="off" required value="{{ $edit->name }}" readonly>
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
                $('#btn-edit').hide();
                $('#btn-reset').show();
                $('#btn-submit').attr('disabled', false);
            });
            $('#btn-reset').on('click', function () {
                $("input[name=name]").attr('readonly', true);
                $("input[name=name]").val('{{ $edit->name }}');
                $('#btn-reset').hide();
                $('#btn-edit').show();
                $('#btn-submit').attr('disabled', true);
            });
        });
    </script>
@endpush