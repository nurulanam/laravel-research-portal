@extends('blankMaster')
@section('title', 'Register')
@section('mainContent')
    <!-- Outer Row -->
    <div class="row min-vh-100 justify-content-center align-items-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="{{ asset('backend/img/logo.png') }}" alt="">
                                    <h1 class="h4 text-gray-900 my-4">Register Here</h1>
                                    <x-auth-session-status class="mb-4" :status="session('status')" />
                                    <form action="{{ route('register') }}" method="POST" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control form-control-user"
                                                   id="name" aria-describedby="name"
                                                   placeholder="Enter Your Full Name">
                                            @error('name')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                   id="email" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address...">
                                            @error('email')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                   id="password" placeholder="Password" required>
                                            @error('password')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" class="form-control form-control-user"
                                                   id="password_confirmation" aria-describedby="password_confirmation"
                                                   placeholder="Confirm Password" required>
                                            @error('password_confirmation')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio small d-flex justify-content-start align-items-center">
                                                <input type="radio" name="role" value="researcher" class="custom-control-input" id="researcher">
                                                <label class="custom-control-label radio-label" for="researcher">I'm Researcher</label>
                                            </div>
                                            <div class="custom-control custom-radio small d-flex align-items-center">
                                                <input type="radio" name="role" value="participant" class="custom-control-input" id="participant">
                                                <label class="custom-control-label radio-label" for="participant">I'm Participant</label>
                                            </div>
                                            @error('role')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Register
                                        </button>
                                    </form>
                                    <div class="d-flex justify-content-between pt-4">
                                        <p>Already have an account?</p>
                                        <a href="{{ route('login') }}">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection
