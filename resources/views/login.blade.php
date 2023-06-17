@extends('layouts.external')
@section('content')
<div class="row justify-content-md-center">
    <div class="col-md-12 col-lg-4">
        <div class="card login-box-container">
            <div class="card-body">
                <div class="authent-logo">
                    <img src="{{ url('img/logo.png') }}" alt="" height="50px">
                </div>
                <div class="authent-text">
                    <p>Welcome to RewardLah</p>
                    <p>Please Sign-in to your account.</p>
                </div>
                @include('layouts.message')
                <form method="post" action="{{ route('login.verify') }}">
                    @csrf
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                            <label for="floatingInput">Email address</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                            <label for="floatingPassword">Password</label>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="rememberme">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-info m-b-xs">Sign In</button>
                    </div>
                </form>
                <div class="authent-reg">
                    <p>Not registered? <a href="{{ route('register') }}">Create your company account</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection