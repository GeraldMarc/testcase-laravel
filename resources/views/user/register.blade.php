@extends('layout.main-layout')
@section('title', 'Register User')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Register User</h3>
                </div>
                <div class="card-body">
                    <!-- Begin error message -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    <!-- End error message -->
                    <form action="{{route('user.register')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name : </label>
                            <input class="form-control" type="text" name="name" value="" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Userame : </label>
                            <input class="form-control" type="text" name="username" value="" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password : </label>
                            <input class="form-control" type="password" name="password" value="" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role : </label>
                            <select class="form-select" name="role" required>
                                <option value="" selected disabled hidden>-- Choose Role --</option>
                                @foreach($data['roles'] as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Register</button>
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