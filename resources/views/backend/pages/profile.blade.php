@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'profile')
@section('extraCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
@endsection
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
    <div class="row my-4 ">
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-header">
                    <h5 class="m-0 p-0 text-dark">Contact Details</h5>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label text-dark">First Name</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input type="text" name="first_name" class="form-control" value="{{ Auth::user()->first_name }}" disabled="disabled" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label text-dark">Last Name</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input type="text" name="last_name" class="form-control" value="{{ Auth::user()->last_name }}" disabled="disabled" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label text-dark">Phone</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input type="text" name="phone" class="form-control" placeholder="Your Phone Number">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label text-dark">E-mail</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input class="form-control m-0" value="{{ Auth::user()->email }}" disabled="disabled" readonly>
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->hasRole('participant'))
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label text-dark">Country</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input class="form-control" value="US" disabled="disabled" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label text-dark">State</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select name="state" class="form-control" id="state">
                                            <option>Select Your State</option>

                                            @foreach($us_states as $key => $states)
                                                <option value="{{ $key }}">{{ $key }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label text-dark">City</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        @foreach($us_states as $key => $cities)
                                            <select name="city" class="form-control city" data-state="{{$key}}">
                                                <option>Select Your City</option>
                                                @foreach($cities as $city)
                                                    <option value="{{ $city }}">{{ $city }}</option>
                                                @endforeach

                                            </select>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label text-dark">Zip Code</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input type="text" name="zip_code" class="form-control" placeholder="Your Zip Code">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 d-flex align-items-stretch ">
            <div class="card w-100">
                <div class="card-header">
                    <h5 class="m-0 p-0 text-dark">Personal Details</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.store') }}" method="POST">
                        @csrf
                        @if(Auth::user()->hasRole('participant'))
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label text-dark">Gender</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select name="gender" class="form-control ">
                                            <option value=""> Select Your Gender </option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="non-binary">Non Binary</option>
                                            <option value="prefer-not-to-say">Prefer Not To Say</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label text-dark">Date Of Birth</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input type="date" name="date_of_birth" id="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label text-dark">Ethnicity</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select name="ethnicity" id="" class="form-control">
                                            <option value=""> Select Your Ethnicity </option>
                                            <option value="american-indian-or-alaska-native">American Indian / Alaskan Native</option>
                                            <option value="asian">Asian</option>
                                            <option value="white-caucasian">White/Caucasian</option>
                                            <option value="pacific-islander">Pacific Islander</option>
                                            <option value="african-american">African American</option>
                                            <option value="hispanic">Hispanic</option>
                                            <option value="multiracial">Multiracial</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label text-dark">Company Name</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input type="text" name="company_name" id="" class="form-control" placeholder="Your Company Name">
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label text-dark">Company Size</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select name="company_size" class="form-control">
                                        <option value="">Select Your Company Size</option>
                                        <option value="self-employed">Self Employed</option>
                                        <option value="1to10">1 - 10</option>
                                        <option value="11to50">11 - 50</option>
                                        <option value="51to200">51 - 200</option>
                                        <option value="201to500">201 - 500</option>
                                        <option value="501to1000">501 - 1,000</option>
                                        <option value="1001to5000">1,001 - 5,000</option>
                                        <option value="5001to10000">5,001 - 10,000</option>
                                        <option value="10000plus">10,000+</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label text-dark">Job Title</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input type="text" name="job_title" class="form-control" placeholder="Enter Your Job Title">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label text-dark">Industry</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    @if(Auth::user()->hasRole('participant'))
                                    <select data-placeholder="Type To Search.." name="industries[]" class="chosen-select form-control" multiple tabindex="4">
                                        @foreach($industries as $industry)
                                            <option value="{{ $industry }}">{{ $industry }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    @if(Auth::user()->hasRole('researcher'))
                                        <select name="industries" class="form-control" >
                                            <option>Select Your Industry</option>
                                            @foreach($industries as $industry)
                                                <option value="{{ $industry }}">{{ $industry }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                </div>
                                <div class="col-12 col-md-8">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
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

    <script>
        $('#state').on('change', function (){
            var state = $(this).val();

            $('.city').each(function (index){
                var dataState = $(this).data('state');
                if (dataState == state){
                    $(this).addClass('d-block').attr('disabled', false);
                }else{
                    $(this).removeClass('d-block').attr('disabled', true);
                }
            });
        });
    </script>

{{--    chosen js multi select --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.chosen-select').chosen({max_selected_options: 5}).change( function(obj, result) {
        console.debug("changed: %o", arguments);
        // console.log("selected: " + result.selected);
        });
    </script>

@endsection







