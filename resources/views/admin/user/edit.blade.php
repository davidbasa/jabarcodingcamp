@extends('layouts.admin.template')
@push('page-header', 'Edit Data User')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-7">
                        <h4 class="card-title">Edit Data User</h4>
                    </div>
                    <div class="col-lg-5">
                        <div class="text-right">
                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="button" class="btn btn-warning" id="btn-edit"><i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="btn btn-danger" id="btn-reset" style="display: none"><i class="fas fa-times"></i> Reset</button>
                            <button type="submit" class="btn btn-success" id="btn-submit" form="form-update" disabled><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="/admin-area/user/{{$users->id}}" method="post" class="form-horizontal" id="form-update">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nama User :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="name" maxlength="50" placeholder="Nama User " autocomplete="off" required value="{{$users->name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Email :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="email" maxlength="50" placeholder="Email" autocomplete="off" required value="{{$users->email}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="role">Role :</label><br>
                        <select class="col-lg-5" id="role" name="role">
                            <option value="1" {{ $users->role_id == 1 ? 'selected="selected"' : '' }}>Admin</option>
                            <option value="2" {{ $users->role_id == 2 ? 'selected="selected"' : '' }}>Donatur</option>
                        </select>
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
                $("input[name=email]").attr('readonly', false);
                $('#btn-edit').hide();
                $('#btn-reset').show();
                $('#btn-submit').attr('disabled', false);
            });
            $('#btn-reset').on('click', function () {
                $("input[name=name]").attr('readonly', true);
                $("input[name=name]").val('{{ $users->name }}');
                $("input[name=email]").attr('readonly', true);
                $("input[name=email]").val('{{ $users->email }}');
                $('#btn-reset').hide();
                $('#btn-edit').show();
                $('#btn-submit').attr('disabled', true);
            });
        });
    </script>
@endpush


<!-- @extends('layouts.admin.template')

@section('content')

<div class="container">

<h3>Edit User</h3>
<form action="/admin-area/user/{{$users->id}}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Nama User :</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$users->name}}" placeholder="">
                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email :</label><br>
                <input type="text" class="form-control" name="email" id="email" value="{{$users->email}}" placeholder="">
                @error('email')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">Role :</label><br>
                <select id="role" name="role">
                    <option value="1" {{ $users->role_id === 1 ? 'selected': "" }}>Admin</option>
                    <option value="2" {{ $users->role_id === 2 ? 'selected': "" }}>Donatur</option>
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update Data</button>
        </form>



</div>


@endsection -->