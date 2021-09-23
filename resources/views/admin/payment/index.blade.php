@extends('layouts.admin.template')
@section('content')

<a href="/admin-area/payment/create" class="btn btn-primary my-2">Tambah</a>
        <table class="table">
            <thead class="thead-light">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Metode Pembayaran</th>
                <th scope="col">Logo</th>
                <th scope="col">Akun</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payment as $key=>$value)
                    <tr>
                        <td>{{$key + 1}}</th>
                        <td>{{$value->name}}</td>
                        <td>{{$value->logo}}</td>
                        <td>{{$value->account}}</td>
                        <td>
                            <a href="/admin-area/payment/{{$value->id}}/edit" class="btn btn-primary">Edit</a>
                            <form action="/admin-area/payment/{{$value->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger my-1" value="Delete">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr colspan="3">
                        <td>No data</td>
                    </tr>  
                @endforelse              
            </tbody>
        </table>




@endsection