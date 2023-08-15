@extends('blankMaster')
@section('title', 'Register')
@section('mainContent')
    <!-- Outer Row -->
    <div class="row min-vh-100 justify-content-center align-items-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card overflow-hidden border-4 border-primary  shadow-lg my-5 rounded-4">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block " style="background: url({{ asset("backend/img/form-side.jpg") }}); background-position: center; background-size: cover;"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="{{ asset('backend/img/logo.png') }}" alt="">
                                    <h1 class="h4 text-gray-900 my-4">Register Here</h1>
                                    <x-auth-session-status class="mb-4" :status="session('status')" />
                                    <form action="{{ route('register') }}" method="POST" class="user">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <input type="text" name="first_name" class="form-control small rounded-pill py-2"
                                                   id="first_name" aria-describedby="first_name"
                                                   placeholder="Enter Your First Name">
                                            @error('first_name')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="text" name="last_name" class="form-control small rounded-pill py-2"
                                                   id="last_name" aria-describedby="last_name"
                                                   placeholder="Enter Your Last Name">
                                            @error('last_name')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
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
                                                   id="password" placeholder="Password" required>
                                            @error('password')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="password" name="password_confirmation" class="form-control small rounded-pill py-2"
                                                   id="password_confirmation" aria-describedby="password_confirmation"
                                                   placeholder="Confirm Password" required>
                                            @error('password_confirmation')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="form-check small d-flex justify-content-start align-items-center">
                                                <input type="radio" name="role" value="researcher" class="form-check-input" id="researcher">
                                                <label class="form-check-label pt-1 ms-2" for="researcher">I'm Researcher</label>
                                            </div>
                                            <div class="form-check small d-flex align-items-center">
                                                <input type="radio" name="role" value="participant" class="form-check-input" id="participant">
                                                <label class="form-check-label pt-1 ms-2" for="participant">I'm Participant</label>
                                            </div>
                                            @error('role')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary rounded-pill py-2 w-100">
                                            Register
                                        </button>
                                    </form>
                                    <div class="d-flex justify-content-between pt-4 small">
                                        <p>Already have an account?</p>
                                        <div class="d-flex">
                                            <a href="{{ route('researcher.login') }}" class="font-weight-500 text-decoration-none">Researcher</a>
                                            <span class="mx-2">/</span>
                                            <a href="{{ route('participant.login') }}" class="font-weight-500 text-decoration-none">Participant</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection
