@extends('backend.dashboardMaster')
@section('title', 'Change Password')
@section('mainContent')
    <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">
                    <div class="card rounded-4 shadow-md">
                        <div class="card-header rounded-top-4 py-3 bg-dark-blue">
                            <h5 class="font-22 fw-bold text-light mb-0 ">Reset Your Password</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('change-password.store') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="" class="col-form-label text-dark">Current Password</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="password" name="current_password" value="{{ old('current_password') }}" class="form-control" placeholder="Your Current Password">
                                            @error('current_password')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="" class="col-form-label text-dark">New Password</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="password" name="password" id="" class="form-control" placeholder="New Password">
                                            @error('password')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="" class="col-form-label text-dark">Confirm Password</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="password" name="confirm_password" value="{{ old('confirm_password') }}"  class="form-control" placeholder="Confirm Password">
                                            @error('confirm_password')
                                            <p class="text-danger font-13 py-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                        </div>
                                        <div class="col-md-8">
                                            <button class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
