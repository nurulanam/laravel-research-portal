<div class="row">
    <div class="col-12">
        <div class="bg-dark-blue bg-gradient text-center text-md-start rounded-4 shadow-md p-4 d-md-flex justify-content-md-between align-items-center">
            <div class="d-md-flex justify-content-md-start align-items-center">
                @if (!empty($profileInfo))
                    @if ($profileInfo->user_avatar == null)
                        <img src="{{ asset('backend/img/profile/undraw_profile.svg') }}" class="img-80 object-fit-cover" id="preview_profile"
                             alt="profile-picture">
                    @elseif($profileInfo->user_avatar !== null)
                        <img src="{{ asset('backend/img/profile/' . $profileInfo->user_avatar) }}" class="img-80 object-fit-cover"
                             id="preview_profile" alt="profile-picture">
                    @endif
                @elseif(empty($profileInfo))
                    <img src="{{ asset('backend/img/profile/undraw_profile.svg') }}" class="img-80" id="preview_profile"
                         alt="profile-picture">
                @endif

                <div class="ms-md-3 font">
                    <h4 class="font-weight-bold text-white mb-0">Hey {{ Auth::user()->first_name }} !</h4>
                    <form action="{{ route('profile.avatar') }}" method="POST" class="user mt-1"
                          enctype="multipart/form-data">
                        @csrf
                        <label for="user_avatar" class="btn p-0 m-0 text-warning">Change Picture</label>
                        <input name="user_avatar" id="user_avatar" style="display: none;" type="file" accept=".jpg, .jpeg, .png">
                        @error('user_avatar')
                        <p class="text-danger font-13 py-2">{{ $message }}</p>
                        @enderror
                        <button class="btn btn-primary btn-sm rounded-pill btn-profile-save" title="Click To Save"><i class="fa-solid fa-check-circle"></i><span class="ms-2">Save</span></button>
                    </form>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3 mt-md-0 float-md-end">
                <a href="{{ route('change-password.index') }}" class="btn btn-primary me-2"><span><i class="fas fa-key me-2"></i></span>Change Password</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        $('#user_avatar').change(function() {
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
