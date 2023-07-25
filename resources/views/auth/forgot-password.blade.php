@extends('blankMaster')
@section('title', 'login')
@section('mainContent')
    <!-- Outer Row -->
    <div class="row min-vh-100 justify-content-center align-items-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card overflow-hidden border-4 border-primary shadow-lg my-5 rounded-4">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block" style="background: url({{ asset("backend/img/form-side.jpg") }}); background-position: center; background-size: cover;"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="{{ asset('backend/img/logo.png') }}" alt="">
                                    <h1 class="h4 text-gray-900 my-4">Forgot your password?</h1>
                                    <p class="mb-3">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                                    <x-auth-session-status class="mb-4" :status="session('status')" />
                                    <form method="POST" action="{{ route('password.email') }}" class="user">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <input type="email" name="email" class="form-control small rounded-pill py-2"
                                                   id="email" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address...">
                                            @error('email')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary btn-user w-100 small rounded-pill py-2">
                                            Email Password Reset Link
                                        </button>
                                    </form>
                                        <div class="d-flex justify-content-between pt-4 small">
                                        <p>Don't have an account?</p>
                                        <a href="{{ route('register') }}" class="font-weight-500 text-decoration-none">Register Here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection
