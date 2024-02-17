@extends('layout.main-layout')
@section('title', 'Home')
@section('content')
    <div>
        <button class="btn btn-primary" onclick="addUser()">Add New User</button>
    </div>
    <div>
        <table class="table table-bordered table-hover" id="user_list">
            <thead class="table-dark">
                <tr>
                    <td scope="col">Company</td>
                    <td scope="col">Role</td>
                    <td scope="col">Name</td>
                    <td scope="col">Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td scope="row"> {{$item->company_name}} </td>
                        <td scope="row"> {{$item->role_name}} </td>
                        <td scope="row"> {{$item->name}} </td>
                        <td scope="row">
                            <button class="btn btn-primary" onclick="detailUser('+ {{$item->id}} +')">Detail</button>
                            <button class="btn btn-primary" onclick="editUser('+ {{$item->id}} +')">Edit</button>
                            <button class="btn btn-danger" onclick="deleteUser('+ {{$item->id}} +')">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        
    </script>
@endsection