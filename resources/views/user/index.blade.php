@extends('layout.main-layout')
@section('title', 'Home')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h3>User List ({{ $data['title_company_name'] }})</h3>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary" type="button" onclick="registerUser()">Create User</button>
        </div>
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <td>Company</td>
                <td>Role</td>
                <td>Name</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @if(in_array('MANAGE_COMPANY_USERS',$data['user_permissions']))
                @foreach ($data['user_list'] as $item)
                    <tr>
                        <td> {{$item->company_name}} </td>
                        <td> {{$item->role_name}} </td>
                        <td> {{$item->name}} </td>
                        <td>
                            <button class="btn btn-info btn-sm" type="button" onclick="detailUser({{$item->id}})">View</button>
                            <button class="btn btn-warning btn-sm" type="button" onclick="editUser({{$item->id}})">Edit</button>
                            <button class="btn btn-danger btn-sm" type="button" onclick="deleteUser({{$item->id}})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            @else
                @foreach ($data['user_list'] as $item)
                    <tr>
                        <td> {{$item->company_name}} </td>
                        <td> {{$item->role_name}} </td>
                        <td> {{$item->name}} </td>
                        <td></td>
                    </tr>
                @endforeach
            @endif
            @foreach ($data['other_spv_list'] as $item)
                <tr>
                    <td> {{$item->company_name}} </td>
                    <td> {{$item->role_name}} </td>
                    <td> {{$item->name}} </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
    <script>
        function registerUser(){
            window.location.href="{{route('user.formRegister')}}";
        }
        function detailUser(id){
            url = "{{route('user.detail',':id')}}";
            window.location.href=url.replace(":id",id);
        }
        function editUser(id){
            url = "{{route('user.formEdit',':id')}}";
            window.location.href=url.replace(":id",id);
        }
        function deleteUser(id){
            url = "{{route('user.formDelete',':id')}}";
            window.location.href=url.replace(":id",id);
        }
    </script>
@endsection