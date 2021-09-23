@extends('user.layout')


@section('content')
<br/>
<div class="mt-5">
    <div class="row">
        <div class="col-sm-12 col-lg-4 offset-lg-4">
            <div class="card">
                <div class="card-header">
                    Pengaturan Profil
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required/>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" required/>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control"  autocomplete="new-password"/>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">Simpan Data <i class="fa-solid fa-floppy-disk text-white"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection