@extends('layouts.admin.template')

@section('content')

<div class="container">
    <h3>List Users</h3>
        <table class="table">
            <thead class="thead-light">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama User</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $key=>$value)
                    <tr>
                        <td>{{$key + 1}}</th>
                        <td>{{$value->name}}</td>
                        <td>{{$value->email}}</td>
                        <td>{{$value->rn}}</td>
                        <td>
                            <a href="/admin-area/user/{{$value->id}}/edit" class="btn btn-primary">Edit</a>
                            <form action="/game/{{$value->id}}" method="POST">
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


</div>

@endsection