@extends('layouts.external')
@section('content')
<div class="row justify-content-md-center">
    <div class="col-md-12 col-lg-6">
        <div class="card login-box-container">
            <div class="card-body">
                <div class="authent-logo">
                    <img src="{{ url('img/logo.png') }}" alt="" style="height: 50px;">
                </div>
                <div class="authent-text">
                    <p>Welcome to RewardLah</p>
                    <p>Enter your company details to create your company account</p>
                </div>
                @include('layouts.message')
                <form method="post" action="{{ route('register.store') }}">
                    @csrf
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="company_name" class="form-control" id="companyName" placeholder="Company Name" required>
                            <label for="companyName">Company Name</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="company_ssm" class="form-control" id="ssmNo" placeholder="SSM No." required>
                            <label for="ssmNo">SSM No.</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="company_address" class="form-control" id="address" placeholder="Address" required>
                            <label for="company_address">Address</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            <label for="name">Your Name</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                            <label for="email">Email address</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="password" name="password_confirmation" class="form-control" id="floatingPassword1" placeholder="Confirm Password" required>
                            <label for="floatingPassword">Confirm Password</label>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">I agree the <a href="#">Terms and Conditions</a></label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary m-b-xs">Register</button>
                    </div>
                </form>
                <div class="authent-login">
                    <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection