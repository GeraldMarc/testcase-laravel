@extends('layout.main-layout')
@section('title', 'Login')
@section('content')
    <div>
        <div>
            <h2>Login</h2>
        </div>
        <div>
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <form action="{{route('guest.login')}}" method="post">
                @csrf
                <div>
                    <span>Username : </span>
                    <input type="text" name="username" id="username" required>
                </div>
                <div>
                    <span>Password : </span>
                    <input type="password" name="password" id="password" required>
                </div>
                <div>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        
    </script>
@endsection