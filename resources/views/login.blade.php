@extends('layout.main-layout')
@section('title', 'Login')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Login</h3>
                </div>
                <div class="card-body">
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Username : </label>
                            <input class="form-control" type="text" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password : </label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Submit</button>
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
        
    </script>
@endsection