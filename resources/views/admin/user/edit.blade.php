@extends('layouts.admin.template')

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


@endsection