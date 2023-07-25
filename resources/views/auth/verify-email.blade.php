@extends('blankMaster')
@section('title', 'Verify Email')
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
                                    <h1 class="h4 text-gray-900 my-4">Please Verify Your E-Mail</h1>
                                    <p class="mb-3">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                                    <x-auth-session-status class="mb-4" :status="session('status')" />
                                    @if (session('status') == 'verification-link-sent')
                                        <p class="text-danger">A new verification link has been sent to the email address you provided during registration.</p>
                                    @endif
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('verification.send') }}" method="POST" class="user mx-2">
                                            @csrf
                                            <button class="btn btn-primary btn-user w-100 px-4 py-2 rounded-pill">
                                                Resend Verification Email
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('logout') }}" class="user mx-2">
                                            @csrf
                                            <button class="btn btn-danger btn-user w-100 px-4 py-2 rounded-pill">
                                                Log Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection
