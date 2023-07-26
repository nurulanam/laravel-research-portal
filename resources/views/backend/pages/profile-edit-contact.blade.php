@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Profile')
@section('extraCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
@endsection
@section('mainContent')


    <div class="row">
        <div class="col-12">
            <div class="bg-dark-blue bg-gradient rounded-4 shadow-md p-4 d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-start align-items-center">
                    @if (!empty($profileInfo))
                        @if ($profileInfo->user_avatar == null)
                            <img src="{{ asset('backend/img/profile/undraw_profile.svg') }}" class="img-80" id="preview_profile"
                                 alt="profile-picture">
                        @elseif($profileInfo->user_avatar !== null)
                            <img src="{{ asset('backend/img/profile/' . $profileInfo->user_avatar) }}" class="img-80"
                                 id="preview_profile" alt="profile-picture">
                        @endif
                    @elseif(empty($profileInfo))
                        <img src="{{ asset('backend/img/profile/undraw_profile.svg') }}" class="img-80" id="preview_profile"
                             alt="profile-picture">
                    @endif

                    <div class="ms-3 font">
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

                <div class="float-end">
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

    <div class="row mt-4">
        <div class="col-12 col-md-4">
            <div class="card py-3 px-2 rounded-4 shadow-md">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-12 col-lg-4 mb-2 mb-md-3">
                            <p class="fw-medium">First Name </p>
                        </div>
                        <div class="col-12 col-lg-8 mb-3">
                            <p>{{ Auth::user()->first_name }}</p>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-12 col-lg-4 mb-2 mb-md-3">
                            <p class="fw-medium">Last Name </p>
                        </div>
                        <div class="col-12 col-lg-8 mb-3">
                            <p>{{ Auth::user()->last_name }}</p>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-12 col-lg-4 mb-2 mb-md-3">
                            <p class="fw-medium">Email @if(Auth::user()->hasVerifiedEmail())<span data-toggle="tooltip" data-placement="right" title="Verified"><i class="fa-regular fa-circle-check text-primary"></i></span> @endif </p>
                        </div>
                        <div class="col-12 col-lg-8 mb-3">
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="fw-medium">Skills</p>
                        <button class="btn"><i class="fa-solid fa-pen text-secondary"></i></button>
                    </div>
                    <div>
                        @if(!empty($userSkills))
                            @foreach($userSkills as $skill)
                                <span class="badge bg-primary rounded-pill px-3 py-2 me-2 mb-2 text-capitalize">{{ $skill->skill_name }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="row my-4 mt-md-0 mb-md-4">
                <form action="{{ route('profile.contact.details') }}" method="POST">
                @csrf
                <div class="col-12">
                    <div class="card py-3 px-2 rounded-4 shadow-md">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <p class="font-22 fw-bold">Contact Details</p>
                                <div class="d-flex">
                                    <a href="{{ route('profile.index') }}" class="btn btn-danger btn-sm me-2" onclick="return confirm('Are you sure you want to cancel editing the contact?') ? window.location.href = '{{ route('profile.index') }}' : false;">
                                        <i class="fa-solid fa-arrow-up-from-bracket fa-rotate-270 me-2"></i><span>Back</span>
                                    </a>

                                    <button class="btn btn-primary btn-sm"><i class="fa-solid fa-check me-2"></i><span>Save</span></button>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Phone</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <input type="number" name="phone" class="form-control"
                                           placeholder="Your Phone Number"
                                           @if (!empty($profileInfo)) @if (!empty($profileInfo->phone)) value="{{ $profileInfo->phone }}" @else value="{{ old('phone') }}" @endif
                                           @elseif(empty($profileInfo)) value="{{ old('phone') }}"
                                        @endif>
                                    @error('phone')
                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Paypal</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <input name="paypal_email" class="form-control m-0"
                                           placeholder="Your Paypal E-mail"
                                           @if (!empty($profileInfo)) @if (!empty($profileInfo->paypal_email)) value="{{ $profileInfo->paypal_email }}" @else value="{{ old('paypal_email') }}" @endif
                                           @elseif(empty($profileInfo))
                                               value="{{ old('paypal_email') }}" @endif>
                                    @error('paypal_email')
                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Country</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <input class="form-control" value="US" disabled="disabled" readonly>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">State</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <select name="state" class="form-control" id="state">
                                        <option value="">Select Your State</option>
                                        @foreach ($us_states as $key => $states)
                                            <option value="{{ $key }}"
                                                    @if (!empty($profileInfo)) @if (!empty($profileInfo->state) && $profileInfo->state == $key) selected @elseif(old('state') == $key) selected @endif
                                                    @elseif(empty($profileInfo))
                                                        @if (old('state') == $key) selected @endif
                                                @endif>{{ $key }}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">City</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    @foreach ($us_states as $key => $cities)
                                        <select name="city" class="form-control city"
                                                data-state="{{ $key }}">
                                            <option value="">Select Your City</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city }}"
                                                        @if (!empty($profileInfo)) @if (!empty($profileInfo->city) && $profileInfo->city == $city) selected @elseif(old('city') == $city) selected @endif
                                                        @elseif(empty($profileInfo))
                                                            @if (old('city') == $city) selected @endif
                                                    @endif>{{ $city }}</option>
                                            @endforeach
                                        </select>
                                    @endforeach
                                    @error('city')
                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Zip Code</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <input type="number" name="zip_code" class="form-control"
                                           placeholder="Your Zip Code"
                                           @if (!empty($profileInfo)) @if (!empty($profileInfo->zip_code)) value="{{ $profileInfo->zip_code }}" @else value="{{ old('zip_code') }}" @endif
                                           @elseif(empty($profileInfo)) value="{{ old('zip_code') }}"
                                        @endif>
                                    @error('zip_code')
                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="row my-4">
                <div class="col-12">
                    <div class="card py-3 px-2 rounded-4 shadow-md">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <p class="font-22 fw-bold">Demographics</p>
                                <button class="btn"><i class="fa-solid fa-pen text-secondary"></i></button>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Gender</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
                                            @if(!empty($profileInfo->gender))
                                                @switch($profileInfo->gender)
                                                    @case('male')
                                                        Male
                                                        @break
                                                    @case('female')
                                                        Female
                                                        @break
                                                    @case('non-binary')
                                                        Non Binary
                                                        @break
                                                    @case('prefer-not-to-say')
                                                        Prefer Not To Say
                                                        @break
                                                @endswitch
                                            @else
                                                Please Update Gender
                                            @endif
                                        @endif

                                    </p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Date Of Birth</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
                                            @if (!empty($profileInfo->date_of_birth))
                                                {{ $profileInfo->date_of_birth }}
                                            @endif
                                        @endif</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Ethnicity</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
                                            @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'american-indian-or-alaska-native') American Indian / Alaskan Native @endif
                                            @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'asian') Asian @endif
                                            @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'white-caucasian') White/Caucasian @endif
                                            @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'pacific-islander') Pacific Islander @endif
                                            @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'african-american') African American @endif
                                            @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'hispanic') Hispanic @endif
                                            @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'multiracial') Multiracial @endif
                                            @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'other') Other @endif
                                        @endif
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Education level</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
                                            @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'less-than-a-high-school-diploma') Less Than a High School Diploma @endif
                                            @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'high-school-diploma-or-equivalent') High School Diploma or Equivalent @endif
                                            @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'some-college-no-degree') Some College No Degree @endif
                                            @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'associate-degree') Associate Degree @endif
                                            @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'bachelors-degree') Bachelor's Degree @endif
                                            @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'masters-degree') Master's Degree @endif
                                            @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'professional-degree') Professional Degree @endif
                                            @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'doctorate') Doctorate @endif
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Household Income</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
                                            @if (!empty($profileInfo->household_income))
                                                @switch($profileInfo->household_income)
                                                    @case('less20000') Less than $20,000 @break
                                                    @case('20000to34999') $20,000 – $34,999 @break
                                                    @case('35000to49999') $35,000– $49,999 @break
                                                    @case('50000to74999') $50,000 – $74,999 @break
                                                    @case('75000to99999') $75,000 - $99,999 @break
                                                    @case('100000plus') $100,000 + @break
                                                @endswitch
                                            @else
                                                Please Update Household Income
                                            @endif
                                        @endif

                                    </p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Marital Status</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
                                            @if (!empty($profileInfo->marital_status))
                                                @switch($profileInfo->marital_status)
                                                    @case('single') Single @break
                                                    @case('married') Married @break
                                                    @case('divorced') Divorced @break
                                                    @case('widowed') Widowed @break
                                                    @case('living-with-significant-other') Living with Significant Other @break
                                                @endswitch
                                            @else
                                                Please Update Marital Status
                                            @endif
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card py-3 px-2 rounded-4 shadow-md">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <p class="font-22 fw-bold">Employment</p>
                                <button class="btn"><i class="fa-solid fa-pen text-secondary"></i></button>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Employment Status</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
                                            @if(!empty($profileInfo->employment_status))
                                                @switch($profileInfo->employment_status)
                                                    @case('self-employed')
                                                        Self employed
                                                        @break
                                                    @case('homemaker')
                                                        Homemaker
                                                        @break
                                                    @case('employed-part-time')
                                                        Employed part time
                                                        @break
                                                    @case('employed-full-time')
                                                        Employed full time
                                                        @break
                                                    @case('not-employed-looking-for-work')
                                                        Not employed - Looking for work
                                                        @break
                                                    @case('not-employed-not-looking-for-work')
                                                        Not employed - not looking for work
                                                        @break
                                                    @case('retired')
                                                        Retired
                                                        @break
                                                    @case('unable-to-work')
                                                        Unable to work
                                                        @break
                                                @endswitch
                                            @else
                                                Please Update Employment Status
                                            @endif
                                        @endif

                                    </p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Company Name
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
                                            @if (!empty($profileInfo->company_name))
                                                {{ $profileInfo->company_name }}
                                            @else
                                                Please Update Company Name
                                            @endif
                                        @endif</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Company Size</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
                                            @if(!empty($profileInfo->company_size))
                                                @switch($profileInfo->company_size)
                                                    @case('self-employed')
                                                        Self employed
                                                        @break
                                                    @case('1to10')
                                                        1 - 10
                                                        @break
                                                    @case('11to50')
                                                        11 - 50
                                                        @break
                                                    @case('51to200')
                                                        51 - 200
                                                        @break
                                                    @case('201to500')
                                                        201 - 500
                                                        @break
                                                    @case('501to1000')
                                                        501 - 1,000
                                                        @break
                                                    @case('1001to5000')
                                                        1,001 - 5,000
                                                        @break
                                                    @case('5001to10000')
                                                        5,001 - 10,000
                                                        @break
                                                    @case('10000plus')
                                                        10,000+
                                                        @break
                                                @endswitch
                                            @else
                                                Please Update Company Size
                                            @endif
                                        @endif

                                    </p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Job Title</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
                                            @if (!empty($profileInfo->job_title))
                                                {{ $profileInfo->company_name }}
                                            @else
                                                Please Update Job Title
                                            @endif
                                        @endif</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Industry</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-9 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileIndustry))
                                            @foreach ($industries as $key => $industry)
                                                @if (in_array($key, $profileIndustry))
                                                    <span  class="badge bg-primary rounded-pill px-3 py-2 me-2 mb-2 text-capitalize">{{ $industry }}</span>
                                                @endif
                                            @endforeach
                                        @else
                                            Please Add Industries
                                        @endif

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('extraJs')
    <script>
        $(document).ready(function() {
            var stateVal = $('#state').val();
            $('.city').each(function(index) {
                var dataState = $(this).data('state');
                if (dataState == stateVal) {
                    $(this).addClass('d-block').attr('disabled', false, 'selected');
                } else {
                    $(this).removeClass('d-block').attr('disabled', true);
                }
            });
        });
        $('#state').on('change', function() {
            var state = $(this).val();

            $('.city').each(function(index) {
                var dataState = $(this).data('state');
                if (dataState == state) {
                    $(this).addClass('d-block').attr('disabled', false);
                } else {
                    $(this).removeClass('d-block').attr('disabled', true);
                }
            });
        });
    </script>
@endsection
