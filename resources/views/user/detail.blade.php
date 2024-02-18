@extends('layout.main-layout')
@section('title', 'User Detail')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">User Detail</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Name : </label>
                            <input class="form-control" type="text" value="{{$data['name']}}" readonly>
                        </div>
                        @if(in_array('MANAGE_COMPANY_USERS',$data['user_permissions']))
                            <div class="mb-3">
                                <label class="form-label">Company : </label>
                                <input class="form-control" type="text" value="{{$data['company_name']}}" readonly>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Role : </label>
                            <input class="form-control" type="text" value="{{$data['role_name']}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Permissions : </label>
                            @foreach ($data['permissions'] as $permission)
                                <div class="form-check">
                                    @if(in_array($permission->name,$data['user_permissions']))
                                        <input class="form-check-input" type="checkbox" checked disabled>
                                        <label class="form-check-label">{{$permission->definition}}</label>
                                    @else
                                        <input class="form-check-input" type="checkbox" disabled>
                                        <label class="form-check-label">{{$permission->definition}}</label>
                                    @endif
                                </div>                                
                            @endforeach
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-secondary" type="button" onclick="home()">Return</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function home(){
            window.location.href="{{route('user.index')}}";
        }
    </script>
@endsection