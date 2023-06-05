@extends('backend.dashboardMaster')
@section('title', 'profile')
@section('mainContent')
<div class="row">
    <div class="col-12 col-md-6">
        <div class="d-flex justify-content-start align-items-center">
            <img src="{{ asset('backend') }}/img/undraw_profile.svg" alt="profile-picture" height="80px" width="80px">
            <div class="ml-3 font">
                <h4 class="font-weight-bold">{{ Auth::user()->name }}</h4>
                <form action="" method="POST" class="" enctype="multipart/form-data">
                    <label for="profile-pic" class="btn p-0  m-0 text-primary">Change Picture</label>
                    <input id="profile-pic" style="display: none;" type="file">
                </form>
{{--                <form action="" method="POST" enctype="multipart/form-data">--}}
{{--                    <div class="d-flex justify-content-start align-items-center">--}}
{{--                        <input class="input-file" type="file">--}}
{{--                        <button class="btn text-light btn-upload">Upload</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
            </div>
        </div>
    </div>
</div>

@endsection
