@extends('backend.dashboardMaster')
@section('title', 'profile')
@section('mainContent')
<div class="row">
    <div class="col-12 col-md-6">
        <div class="d-flex justify-content-start align-items-center">
            <img src="{{ asset('backend') }}/img/undraw_profile.svg" id="preview_profile" alt="profile-picture" height="80px" width="80px">
            <div class="ml-3 font">
                <h4 class="font-weight-bold mb-0">{{ Auth::user()->name }}</h4>
                <form action="" method="POST" class="user mt-1" enctype="multipart/form-data" >
                    <label for="profile-pic" class="btn p-0  m-0 text-primary">Change Picture</label>
                    <input id="profile-pic" style="display: none;" type="file">
                    <button class="btn btn-primary btn-sm btn-user px-4 mx-4 btn-profile-save">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('extraJs')
    <script>
        $(document).ready(() => {
            $('#profile-pic').change(function() {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        console.log(event.target.result);
                        $('#preview_profile').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
                $('.btn-profile-save').css("display", "inline-block")
            });
        });
    </script>
@endsection
