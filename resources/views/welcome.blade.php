@extends('blankMaster')
@section('title', 'Welcome')
@section('mainContent')
    <!-- Outer Row -->
    <div class="row min-vh-100 justify-content-center align-items-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card overflow-hidden border-4 border-primary shadow-lg my-5 rounded-4">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block" style="background: url({{ asset("backend/img/form-side.jpg") }}); background-position: center; background-size: cover;"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="{{ asset('backend/img/logo.png') }}" alt="">
                                    <h1 class="h4 text-gray-900 my-4">Welcome!</h1>
                                    <p>Third Estate Research is a simple and affordable qualitative market research option for business of all sizes and budgets.</p>
                                </div>
                                <hr class="my-4">
                                @guest
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('login') }}" class="btn btn-primary btn-custom mx-2">Researcher Login</a>
                                        <a href="{{ route('login') }}" class="btn btn-primary btn-custom mx-2">Participant Login</a>
{{--                                        <a href="{{ route('register') }}" class="btn btn-primary btn-custom mx-2">Register</a>--}}
                                    </div>
                                    <div class="d-flex justify-content-center pt-4">
                                        <p class="small">Don't have an account?</p>
                                        <a href="{{ route('register') }}" class="font-weight-500 small text-decoration-none ms-3">Register Here</a>
                                    </div>
                                @endguest
                                @auth
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('dashboard.index') }}" class="btn btn-primary btn-custom mx-2">Dashboard</a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection
