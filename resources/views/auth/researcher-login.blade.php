@extends('blankMaster')
@section('title', 'login')
@section('mainContent')
    <!-- Outer Row -->
    <div class="row min-vh-100 justify-content-center align-items-center login">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card border-4 border-primary overflow-hidden shadow-lg my-5 rounded-4">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block" style="background: url({{ asset("backend/img/form-side.jpg") }}); background-position: center; background-size: cover;"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="{{ asset('backend/img/logo.png') }}" alt="">
                                    <h1 class="h4 text-gray-900 my-4">Researchers Login</h1>
                                    <x-auth-session-status class="mb-4" :status="session('status')" />
                                    <form action="{{ route('login', 'researcher') }}" method="POST" class="user">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <input type="email" name="email" class="form-control small rounded-pill py-2"
                                                   id="email" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address...">
                                            @error('email')
                                                <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="password" name="password" class="form-control small rounded-pill py-2"
                                                   id="password" placeholder="Password">
                                            @error('password')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group d-block d-lg-flex justify-content-between align-items-center mb-3">
                                            <div class="form-check small">
                                                <input type="checkbox" name="remember" class="form-check-input" id="remember_me">
                                                <label class="form-check-label" for="remember_me">Remember
                                                    Me</label>
                                            </div>
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-primary small font-weight-500 text-decoration-none ">Forgot Your Password?</a>
                                            @endif
                                        </div>
                                        <button class="btn btn-primary w-100 py-2 rounded-pill">
                                            Login
                                        </button>
                                    </form>
                                    <div class="d-flex justify-content-center pt-4">
                                        <p class="small">Don't have an account?</p>
                                        <a href="{{ route('register', 'researcher') }}" class="font-weight-500 small text-decoration-none ms-3">Researcher</a> <span class="mx-2">/</span>
                                        <a href="{{ route('register', 'participant') }}" class="font-weight-500 small text-decoration-none">Participant</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection
