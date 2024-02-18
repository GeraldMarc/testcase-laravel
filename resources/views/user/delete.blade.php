@extends('layout.main-layout')
@section('title', 'Delete User')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Delete User</h3>
                </div>
                <div class="card-body">
                    <!-- Begin error message -->
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    <!-- End error message -->
                    <form action="{{route('user.delete',['id' => $id])}}" method="post">
                        @method('DELETE')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name : </label>
                            <input class="form-control" type="text" value="{{$data['name']}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role : </label>
                            <input class="form-control" type="text" value="{{$data['role_name']}}" readonly>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-danger" type="submit">Delete</button>
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