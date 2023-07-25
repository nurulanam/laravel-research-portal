@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'profile')
@section('extraCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
@endsection
@section('mainContent')


    <div class="row">
        <div class="col-12">
            <div class="bg-dark-blue bg-gradient rounded-4 shadow-md p-4 d-flex justify-content-lg-between align-items-center">
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

    <div class="row my-4">
        <div class="col-12 col-md-4">
            <div class="card rounded-4 shadow-md">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="col-4">
                            <p class="font-weight-500">First Name </p>
                        </div>
                        <div class="col-8">
                            <p>{{ Auth::user()->first_name }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div class="col-4">
                            <p class="font-weight-500">Last Name </p>
                        </div>
                        <div class="col-8">
                            <p>{{ Auth::user()->last_name }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div class="col-4">
                            <p class="font-weight-500">Email @if(Auth::user()->hasVerifiedEmail())<span data-toggle="tooltip" data-placement="right" title="Verified"><i class="fa-regular fa-circle-check text-primary"></i></span> @endif </p>
                        </div>
                        <div class="col-8">
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="font-weight-500">Skills</p>
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
    </div>

    <div class="row my-2">
        <div class="col-12 col-md-6 col-lg-6 my-3">
            <div class="card shadow p-2">
                <div class="card-header d-flex justify-content-start align-items-center bg-dark-blue">
                    <i class="fas fa-id-card-alt mr-3"></i>
                    <h2 class="font-18 text-light font-weight-bold mb-0">Contact Details</h2>
                </div>
            <div class="card-body">
            <form action="{{ route('profile.contact.details') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label text-dark">First Name</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" name="first_name" class="form-control rounded-pill"
                                       value="{{ Auth::user()->first_name }}" disabled="disabled" readonly>
                                @error('first_name')
                                <p class="text-danger font-13 py-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label text-dark">Last Name</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" name="last_name" class="form-control rounded-pill"
                                       value="{{ Auth::user()->last_name }}" disabled="disabled" readonly>
                                @error('last_name')
                                <p class="text-danger font-13 py-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label text-dark">E-mail @if(Auth::user()->hasVerifiedEmail())<span data-toggle="tooltip" data-placement="right" title="Verified"><i class="fas fa-check-circle text-success"></i></span> @endif </label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input class="form-control rounded-pill m-0" value="{{ Auth::user()->email }}"
                                       disabled="disabled" readonly>
                                @error('email')
                                <p class="text-danger font-13 py-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label text-dark">Phone</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="number" name="phone" class="form-control rounded-pill"
                                       placeholder="Your Phone Number"
                                       @if (!empty($profileInfo)) @if (!empty($profileInfo->phone)) value="{{ $profileInfo->phone }}" @else value="{{ old('phone') }}" @endif
                                       @elseif(empty($profileInfo)) value="{{ old('phone') }}"
                                    @endif>
                                @error('phone')
                                <p class="text-danger font-13 py-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->hasRole('participant'))
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label text-dark">Paypal E-mail</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input name="paypal_email" class="form-control rounded-pill m-0"
                                           placeholder="Your Paypal E-mail"
                                           @if (!empty($profileInfo)) @if (!empty($profileInfo->paypal_email)) value="{{ $profileInfo->paypal_email }}" @else value="{{ old('paypal_email') }}" @endif
                                           @elseif(empty($profileInfo))
                                               value="{{ old('paypal_email') }}" @endif>
                                    @error('paypal_email')
                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label text-dark">Country</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input class="form-control rounded-pill" value="US" disabled="disabled" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label text-dark">State</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select name="state" class="form-control rounded-pill" id="state">
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
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="col-form-label text-dark">City</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    @foreach ($us_states as $key => $cities)
                                        <select name="city" class="form-control rounded-pill city"
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label text-dark">Zip Code</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="number" name="zip_code" class="form-control rounded-pill"
                                       placeholder="Your Zip Code"
                                       @if (!empty($profileInfo)) @if (!empty($profileInfo->zip_code)) value="{{ $profileInfo->zip_code }}" @else value="{{ old('zip_code') }}" @endif
                                       @elseif(empty($profileInfo)) value="{{ old('zip_code') }}"
                                    @endif>
                                @error('zip_code')
                                <p class="text-danger font-13 py-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endif
                <div class="row">
                        <div class="col-12 col-md-4">

                        </div>
                        <div class="col-12 col-md-8">
                            <button class="btn btn-outline-primary btn-custom mt-4">Save changes</button>
                        </div>
                    </div>
            </form>
            </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6 my-3">
            @if (Auth::user()->hasRole('participant'))
                <div class="col-12 mb-3 d-flex align-items-stretch">
                    <button type="button" class="btn btn-primary text-left bg-dark-blue p-2 px-lg-5 py-lg-4 w-100"
                            data-toggle="modal" data-target="#demographics">
                    <span class="d-flex justify-content-start align-items-center">
                        <i class="fas fa-users fa-2x mr-3"></i>
                        <span class="font-weight-bold font-18">Demographics</span>
                    </span>
                        <p class="mt-2 mb-0">Review your gender, ethnicity, education, and income information.</p>
                    </button>
                    <div class="modal fade" id="demographics" tabindex="-1" role="dialog"
                         aria-labelledby="demographicsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Demographics</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @if (!empty($profileInfo))
                                    @if ($profileInfo->status == 'deactivate')
                                    @elseif($profileInfo->status == 'active')
                                        <form action="{{ route('profile.demographics') }}" method="POST">
                                            @csrf
                                            @endif
                                            @elseif(empty($profileInfo))
                                                <form action="{{ route('profile.demographics') }}" method="POST">
                                                    @csrf
                                                    @endif

                                                    <div class="modal-body">
                                                        @if (!empty($profileInfo))
                                                            @if ($profileInfo->status == 'deactivate')
                                                                <p>Need to make changes? Contact us at <a
                                                                        href="mailto:support@thirdstateresearch.com">support@thirdstateresearch.com</a>
                                                                </p>
                                                            @elseif($profileInfo->status == 'active')
                                                                <p>Please fill out the form correctly. Once you fill it out, you can't change it.
                                                                </p>
                                                            @endif
                                                        @elseif(empty($profileInfo))
                                                            <p>Please fill out the form correctly. Once you fill it out, you can't change it.</p>
                                                        @endif

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    <label class="col-form-label text-dark">Gender</label>
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <select name="gender" class="form-control"
                                                                            @if (!empty($profileInfo)) @if ($profileInfo->status == 'deactivate') disabled="disabled" @elseif($profileInfo->status == 'active') @endif
                                                                    @elseif(empty($profileInfo)) @endif >
                                                                        <option value=""> Select Your Gender </option>
                                                                        <option value="male"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->gender) && $profileInfo->gender == 'male') selected
                                                                                @elseif (old('gender') == 'male') selected @endif
                                                                                @elseif(empty($profileInfo))
                                                                                    @if (old('gender') == 'male') selected @endif @endif>Male</option>
                                                                        <option value="female"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->gender) && $profileInfo->gender == 'female') selected
                                                                                @elseif (old('gender') == 'female') selected @endif
                                                                                @elseif(empty($profileInfo))
                                                                                    @if (old('gender') == 'female') selected @endif @endif >Female</option>
                                                                        <option value="non-binary"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->gender) && $profileInfo->gender == 'non-binary') selected
                                                                                @elseif (old('gender') == 'non-binary') selected @endif
                                                                                @elseif(empty($profileInfo))
                                                                                    @if (old('gender') == 'non-binary') selected @endif @endif >Non Binary</option>
                                                                        <option value="prefer-not-to-say"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->gender) && $profileInfo->gender == 'prefer-not-to-say') selected
                                                                                @elseif (old('gender') == 'prefer-not-to-say') selected @endif
                                                                                @elseif(empty($profileInfo))
                                                                                    @if (old('gender') == 'prefer-not-to-say') selected @endif @endif >Prefer Not To Say</option>
                                                                    </select>
                                                                    @error('gender')
                                                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    <label class="col-form-label text-dark">Date Of Birth</label>
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <input type="date" name="date_of_birth" class="form-control"
                                                                           @if (!empty($profileInfo)) @if ($profileInfo->status == 'deactivate')
                                                                               @if (!empty($profileInfo->date_of_birth)) value="{{ $profileInfo->date_of_birth }}" @endif
                                                                           disabled="disabled" @elseif($profileInfo->status == 'active')
                                                                               @if (!empty($profileInfo->date_of_birth)) value="{{ $profileInfo->date_of_birth }}" @else value="{{ old('date_of_birth') }}" @endif
                                                                        @endif
                                                                    @elseif(empty($profileInfo))
                                                                        @endif>
                                                                    @error('date_of_birth')
                                                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    <label class="col-form-label text-dark">Ethnicity</label>
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <select name="ethnicity" id="" class="form-control"
                                                                            @if (!empty($profileInfo)) @if ($profileInfo->status == 'deactivate') disabled="disabled" @elseif($profileInfo->status == 'active') @endif
                                                                    @elseif(empty($profileInfo)) @endif>
                                                                        <option value=""> Select Your Ethnicity </option>
                                                                        <option value="american-indian-or-alaska-native"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'american-indian-or-alaska-native') selected @elseif(old('ethnicity') == 'american-indian-or-alaska-native') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('ethnicity') == 'american-indian-or-alaska-native') selected @endif
                                                                            @endif>American Indian / Alaskan Native</option>
                                                                        <option value="asian"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'asian') selected @elseif(old('ethnicity') == 'asian') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('ethnicity') == 'asian') selected @endif
                                                                            @endif>Asian</option>
                                                                        <option value="white-caucasian"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'white-caucasian') selected @elseif(old('ethnicity') == 'white-caucasian') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('ethnicity') == 'white-caucasian') selected @endif
                                                                            @endif>White/Caucasian</option>
                                                                        <option value="pacific-islander"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'pacific-islander') selected @elseif(old('ethnicity') == 'pacific-islander') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('ethnicity') == 'pacific-islander') selected @endif
                                                                            @endif>Pacific Islander</option>
                                                                        <option value="african-american"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'african-american') selected @elseif(old('ethnicity') == 'african-american') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('ethnicity') == 'african-american') selected @endif
                                                                            @endif>African American</option>
                                                                        <option value="hispanic"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'hispanic') selected @elseif(old('ethnicity') == 'hispanic') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('ethnicity') == 'hispanic') selected @endif
                                                                            @endif>Hispanic</option>
                                                                        <option value="multiracial"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'multiracial') selected @elseif(old('ethnicity') == 'multiracial') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('ethnicity') == 'multiracial') selected @endif
                                                                            @endif>Multiracial</option>
                                                                        <option value="other"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->ethnicity) && $profileInfo->ethnicity == 'other') selected @elseif(old('ethnicity') == 'other') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('ethnicity') == 'other') selected @endif
                                                                            @endif>Other</option>
                                                                    </select>
                                                                    @error('ethnicity')
                                                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    <label class="col-form-label text-dark">Education Level</label>
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <select name="education_level" id="" class="form-control"
                                                                            @if (!empty($profileInfo)) @if ($profileInfo->status == 'deactivate') disabled="disabled" @elseif($profileInfo->status == 'active') @endif
                                                                    @elseif(empty($profileInfo)) @endif >
                                                                        <option value=""> Select Your Education Level </option>
                                                                        <option value="less-than-a-high-school-diploma"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'less-than-a-high-school-diploma') selected @elseif(old('education_level') == 'less-than-a-high-school-diploma') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('education_level') == 'less-than-a-high-school-diploma') selected @endif
                                                                            @endif>Less Than a High School Diploma</option>
                                                                        <option value="high-school-diploma-or-equivalent"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'high-school-diploma-or-equivalent') selected @elseif(old('education_level') == 'high-school-diploma-or-equivalent') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('education_level') == 'high-school-diploma-or-equivalent') selected @endif
                                                                            @endif>High School Diploma or Equivalent</option>
                                                                        <option value="some-college-no-degree"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'some-college-no-degree') selected @elseif(old('education_level') == 'some-college-no-degree') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('education_level') == 'some-college-no-degree') selected @endif
                                                                            @endif>Some College No Degree</option>
                                                                        <option value="associate-degree"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'associate-degree') selected @elseif(old('education_level') == 'associate-degree') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('education_level') == 'associate-degree') selected @endif
                                                                            @endif>Associate Degree</option>
                                                                        <option value="bachelors-degree"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'bachelors-degree') selected @elseif(old('education_level') == 'bachelors-degree') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('education_level') == 'bachelors-degree') selected @endif
                                                                            @endif>Bachelor's Degree</option>
                                                                        <option value="masters-degree"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'masters-degree') selected @elseif(old('education_level') == 'masters-degree') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('education_level') == 'masters-degree') selected @endif
                                                                            @endif>Master's Degree</option>
                                                                        <option value="professional-degree"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'professional-degree') selected @elseif(old('education_level') == 'professional-degree') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('education_level') == 'professional-degree') selected @endif
                                                                            @endif>Professional Degree</option>
                                                                        <option value="doctorate"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->education_level) && $profileInfo->education_level == 'doctorate') selected @elseif(old('education_level') == 'doctorate') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('education_level') == 'doctorate') selected @endif
                                                                            @endif>Doctorate</option>
                                                                    </select>
                                                                    @error('education_level')
                                                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    <label class="col-form-label text-dark">Household Income</label>
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <select name="household_income" id="" class="form-control"
                                                                            @if (!empty($profileInfo)) @if ($profileInfo->status == 'deactivate') disabled="disabled" @elseif($profileInfo->status == 'active') @endif
                                                                    @elseif(empty($profileInfo)) @endif >
                                                                        <option value=""> Select Your Household Income </option>
                                                                        <option value="less20000"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->household_income) && $profileInfo->household_income == 'less20000') selected @elseif(old('household_income') == 'less20000') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('household_income') == 'less20000') selected @endif
                                                                            @endif>Less than $20,000</option>
                                                                        <option value="20000to34999"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->household_income) && $profileInfo->household_income == '20000to34999') selected @elseif(old('household_income') == '20000to34999') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('household_income') == '20000to34999') selected @endif
                                                                            @endif>$20,000 – $34,999</option>
                                                                        <option value="35000to49999"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->household_income) && $profileInfo->household_income == '35000to49999') selected @elseif(old('household_income') == '35000to49999') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('household_income') == '35000to49999') selected @endif
                                                                            @endif>$35,000– $49,999</option>
                                                                        <option value="50000to74999"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->household_income) && $profileInfo->household_income == '50000to74999') selected @elseif(old('household_income') == '50000to74999') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('household_income') == '50000to74999') selected @endif
                                                                            @endif>$50,000 – $74,999</option>
                                                                        <option value="75000to99999"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->household_income) && $profileInfo->household_income == '75000to99999') selected @elseif(old('household_income') == '75000to99999') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('household_income') == '75000to99999') selected @endif
                                                                            @endif>$75,000 - $99,999</option>
                                                                        <option value="100000plus"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->household_income) && $profileInfo->household_income == '100000plus') selected @elseif(old('household_income') == '100000plus') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('household_income') == '100000plus') selected @endif
                                                                            @endif>$100,000 +</option>
                                                                    </select>
                                                                    @error('household_income')
                                                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    <label class="col-form-label text-dark">Marital Status</label>
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <select name="marital_status" id="" class="form-control"
                                                                            @if (!empty($profileInfo)) @if ($profileInfo->status == 'deactivate') disabled="disabled" @elseif($profileInfo->status == 'active') @endif
                                                                    @elseif(empty($profileInfo)) @endif >
                                                                        <option value=""> Select Your Marital Status</option>
                                                                        <option value="single"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->marital_status) && $profileInfo->marital_status == 'single') selected @elseif(old('marital_status') == 'single') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('marital_status') == 'single') selected @endif
                                                                            @endif>Single</option>
                                                                        <option value="married"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->marital_status) && $profileInfo->marital_status == 'married') selected @elseif(old('marital_status') == 'married') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('marital_status') == 'married') selected @endif
                                                                            @endif>Married</option>
                                                                        <option value="divorced"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->marital_status) && $profileInfo->marital_status == 'divorced') selected @elseif(old('marital_status') == 'divorced') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('marital_status') == 'divorced') selected @endif
                                                                            @endif>Divorced</option>
                                                                        <option value="widowed"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->marital_status) && $profileInfo->marital_status == 'widowed') selected @elseif(old('marital_status') == 'widowed') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('marital_status') == 'widowed') selected @endif
                                                                            @endif>Widowed</option>
                                                                        <option value="living-with-significant-other"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->marital_status) && $profileInfo->marital_status == 'living-with-significant-other') selected @elseif(old('marital_status') == 'living-with-significant-other') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('marital_status') == 'living-with-significant-other') selected @endif
                                                                            @endif>Living with Significant Other</option>
                                                                    </select>
                                                                    @error('marital_status')
                                                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    <label class="col-form-label text-dark">Number of children living in your
                                                                        household?</label>
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <select name="children_in_living" id="" class="form-control"
                                                                            @if (!empty($profileInfo)) @if ($profileInfo->status == 'deactivate') disabled="disabled" @elseif($profileInfo->status == 'active') @endif
                                                                    @elseif(empty($profileInfo)) @endif >
                                                                        <option value=""> Select Your Children In Living </option>
                                                                        <option value="0"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->children_in_living) && $profileInfo->children_in_living == '0') selected @elseif(old('children_in_living') == '0') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('children_in_living') == '0') selected @endif
                                                                            @endif>0</option>
                                                                        <option value="1"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->children_in_living) && $profileInfo->children_in_living == '1') selected @elseif(old('children_in_living') == '1') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('children_in_living') == '1') selected @endif
                                                                            @endif>1</option>
                                                                        <option value="2"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->children_in_living) && $profileInfo->children_in_living == '2') selected @elseif(old('children_in_living') == '2') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('children_in_living') == '2') selected @endif
                                                                            @endif>2</option>
                                                                        <option value="3"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->children_in_living) && $profileInfo->children_in_living == '3') selected @elseif(old('children_in_living') == '3') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('children_in_living') == '3') selected @endif
                                                                            @endif>3</option>
                                                                        <option value="4"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->children_in_living) && $profileInfo->children_in_living == '4') selected @elseif(old('children_in_living') == '4') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('children_in_living') == '4') selected @endif
                                                                            @endif>4</option>
                                                                        <option value="5-plus"
                                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->children_in_living) && $profileInfo->children_in_living == '5-plus') selected @elseif(old('children_in_living') == '5-plus') selected @endif
                                                                                @elseif(empty($profileInfo)) @if (old('children_in_living') == '5-plus') selected @endif
                                                                            @endif>5+</option>
                                                                    </select>
                                                                    @error('children_in_living')
                                                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            @if (!empty($profileInfo))
                                                                @if ($profileInfo->status == 'deactivate')
                                                                @elseif($profileInfo->status == 'active')
                                                                    <button class="btn btn-primary">Save changes</button>
                                                                @endif
                                                            @elseif(empty($profileInfo))
                                                                <button class="btn btn-primary">Save changes</button>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    @if (!empty($profileInfo))
                                                        @if ($profileInfo->status == 'deactivate')
                                                        @elseif($profileInfo->status == 'active')
                                                </form>
                                            @endif
                                            @elseif(empty($profileInfo))
                                        </form>
                                    @endif



                            </div>
                        </div>
                    </div>

                </div>
            @endif    <div class="col-12 mb-3 d-flex align-items-stretch">
                <button type="button" class="btn btn-primary text-left bg-dark-blue p-2 px-lg-5 py-lg-4 w-100"
                        data-toggle="modal" data-target="#employment">
            <span class="d-flex justify-content-start align-items-center">
                <i class="fas fa-briefcase fa-2x mr-3"></i>
                <span class="font-weight-bold font-18">Employment</span>
            </span>
                    <p class="mt-2 mb-0">Details around your professional work experience.</p>
                </button>
                <div class="modal fade" id="employment" tabindex="-1" role="dialog" aria-labelledby="employmentLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Employment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('profile.employment') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    @if (Auth::user()->hasRole('participant'))
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <label class="col-form-label text-dark">Employment Status</label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <select name="employment_status" class="form-control">
                                                        <option value="">Select Your Employment Status</option>
                                                        <option value="self-employed"
                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->employment_status) && $profileInfo->employment_status == 'self-employed') selected @elseif(old('employment_status') == 'self-employed') selected @endif
                                                                @elseif(empty($profileInfo))
                                                                    @if (old('employment_status') == 'self-employed') selected @endif @endif>Self Employed
                                                        </option>
                                                        <option value="homemaker"
                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->employment_status) && $profileInfo->employment_status == 'homemaker') selected @elseif(old('employment_status') == 'homemaker') selected @endif
                                                                @elseif(empty($profileInfo))
                                                                    @if (old('employment_status') == 'homemaker') selected @endif @endif>Homemaker
                                                        </option>
                                                        <option value="employed-part-time"
                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->employment_status) && $profileInfo->employment_status == 'employed-part-time') selected @elseif(old('employment_status') == 'employed-part-time') selected @endif
                                                                @elseif(empty($profileInfo))
                                                                    @if (old('employment_status') == 'employed-part-time') selected @endif @endif>Employed part
                                                            time</option>
                                                        <option value="employed-full-time"
                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->employment_status) && $profileInfo->employment_status == 'employed-full-time') selected @elseif(old('employment_status') == 'employed-full-time') selected @endif
                                                                @elseif(empty($profileInfo))
                                                                    @if (old('employment_status') == 'employed-full-time') selected @endif @endif>Employed full
                                                            time</option>
                                                        <option value="not-employed-looking-for-work"
                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->employment_status) && $profileInfo->employment_status == 'not-employed-looking-for-work') selected @elseif(old('employment_status') == 'not-employed-looking-for-work') selected @endif
                                                                @elseif(empty($profileInfo))
                                                                    @if (old('employment_status') == 'not-employed-looking-for-work') selected @endif @endif>Not employed -
                                                            looking for work</option>
                                                        <option value="not-employed-not-looking-for-work"
                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->employment_status) && $profileInfo->employment_status == 'not-employed-not-looking-for-work') selected @elseif(old('employment_status') == 'not-employed-not-looking-for-work') selected @endif
                                                                @elseif(empty($profileInfo))
                                                                    @if (old('employment_status') == 'not-employed-not-looking-for-work') selected @endif @endif>Not employed -
                                                            not looking for work</option>
                                                        <option value="retired"
                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->employment_status) && $profileInfo->employment_status == 'retired') selected @elseif(old('employment_status') == 'retired') selected @endif
                                                                @elseif(empty($profileInfo))
                                                                    @if (old('employment_status') == 'retired') selected @endif @endif>Retired
                                                        </option>
                                                        <option value="unable-to-work"
                                                                @if (!empty($profileInfo)) @if (!empty($profileInfo->employment_status) && $profileInfo->employment_status == 'unable-to-work') selected @elseif(old('employment_status') == 'unable-to-work') selected @endif
                                                                @elseif(empty($profileInfo))
                                                                    @if (old('employment_status') == 'unable-to-work') selected @endif @endif>Unable to work
                                                        </option>
                                                    </select>
                                                    @error('employment_status')
                                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                                    @enderror
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
                                                <input type="text" name="company_name" class="form-control"
                                                       placeholder="Your Company Name"
                                                       @if (!empty($profileInfo)) @if (!empty($profileInfo->company_name)) value="{{ $profileInfo->company_name }}" @else value="{{ old('company_name') }}" @endif
                                                       @elseif(empty($profileInfo)) value="{{ old('company_name') }}"
                                                    @endif>

                                                @error('company_name')
                                                <p class="text-danger font-13 py-2">{{ $message }}</p>
                                                @enderror
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
                                                    <option value="self-employed"
                                                            @if (!empty($profileInfo)) @if (!empty($profileInfo->company_size) && $profileInfo->company_size == 'self-employed') selected @elseif(old('company_size') == 'self-employed') selected @endif
                                                            @elseif(empty($profileInfo))
                                                                @if (old('company_size') == 'self-employed') selected @endif @endif>Self Employed
                                                    </option>
                                                    <option value="1to10"
                                                            @if (!empty($profileInfo)) @if (!empty($profileInfo->company_size) && $profileInfo->company_size == '1to10') selected @elseif(old('company_size') == '1to10') selected @endif
                                                            @elseif(empty($profileInfo))
                                                                @if (old('company_size') == '1to10') selected @endif @endif>1 - 10</option>
                                                    <option value="11to50"
                                                            @if (!empty($profileInfo)) @if (!empty($profileInfo->company_size) && $profileInfo->company_size == '11to50') selected @elseif(old('company_size') == '11to50') selected @endif
                                                            @elseif(empty($profileInfo))
                                                                @if (old('company_size') == '11to50') selected @endif @endif>11 - 50</option>
                                                    <option value="51to200"
                                                            @if (!empty($profileInfo)) @if (!empty($profileInfo->company_size) && $profileInfo->company_size == '51to200') selected @elseif(old('company_size') == '51to200') selected @endif
                                                            @elseif(empty($profileInfo))
                                                                @if (old('company_size') == '51to200') selected @endif @endif>51 - 200</option>
                                                    <option value="201to500"
                                                            @if (!empty($profileInfo)) @if (!empty($profileInfo->company_size) && $profileInfo->company_size == '201to500') selected @elseif(old('company_size') == '201to500') selected @endif
                                                            @elseif(empty($profileInfo))
                                                                @if (old('company_size') == '201to500') selected @endif @endif>201 - 500</option>
                                                    <option value="501to1000"
                                                            @if (!empty($profileInfo)) @if (!empty($profileInfo->company_size) && $profileInfo->company_size == '501to1000') selected @elseif(old('company_size') == '501to1000') selected @endif
                                                            @elseif(empty($profileInfo))
                                                                @if (old('company_size') == '501to1000') selected @endif @endif>501 - 1,000
                                                    </option>
                                                    <option value="1001to5000"
                                                            @if (!empty($profileInfo)) @if (!empty($profileInfo->company_size) && $profileInfo->company_size == '1001to5000') selected @elseif(old('company_size') == '1001to5000') selected @endif
                                                            @elseif(empty($profileInfo))
                                                                @if (old('company_size') == '1001to5000') selected @endif @endif>1,001 - 5,000
                                                    </option>
                                                    <option value="5001to10000"
                                                            @if (!empty($profileInfo)) @if (!empty($profileInfo->company_size) && $profileInfo->company_size == '5001to10000') selected @elseif(old('company_size') == '5001to10000') selected @endif
                                                            @elseif(empty($profileInfo))
                                                                @if (old('company_size') == '5001to10000') selected @endif @endif>5,001 - 10,000
                                                    </option>
                                                    <option value="10000plus"
                                                            @if (!empty($profileInfo)) @if (!empty($profileInfo->company_size) && $profileInfo->company_size == '10000plus') selected @elseif(old('company_size') == '10000plus') selected @endif
                                                            @elseif(empty($profileInfo))
                                                                @if (old('company_size') == '10000plus') selected @endif @endif>10,000+</option>
                                                </select>
                                                @error('company_size')
                                                <p class="text-danger font-13 py-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <label class="col-form-label text-dark">Job Title</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input type="text" name="job_title" class="form-control"
                                                       placeholder="Enter Your Job Title"
                                                       @if (!empty($profileInfo)) @if (!empty($profileInfo->job_title)) value="{{ $profileInfo->job_title }}" @else value="{{ old('job_title') }}" @endif
                                                       @elseif(empty($profileInfo)) value="{{ old('job_title') }}"
                                                    @endif>
                                                @error('job_title')
                                                <p class="text-danger font-13 py-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <label class="col-form-label text-dark">Industry</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                @if (Auth::user()->hasRole('participant'))
                                                    <select name="industry[]"  class="form-control w-100 industry-box" multiple="multiple">
                                                        @foreach ($industries as $key => $industry)
                                                            <option value="{{ $key }}"
                                                                    @if (!empty($profileIndustry))
                                                                        @foreach ($profileIndustry as $item)
                                                                            @if ($item == $key)
                                                                                selected="selected"
                                                                @endif
                                                                @endforeach
                                                                @endif
                                                            >{{ $industry }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                @if (Auth::user()->hasRole('researcher'))
                                                    <select name="industry" class="form-control">
                                                        <option value="">Select Your Industry</option>
                                                        @foreach ($industries as $key => $industry)
                                                            <option value="{{ $key }}"
                                                                    @if (!empty($profileIndustry))
                                                                        @if ($profileIndustry == $key)
                                                                                selected="selected"
                                                                @endif
                                                                @endif
                                                            >{{ $industry }}</option>
                                                            @endforeach
                                                    </select>
                                                @endif
                                                @error('industry')
                                                <p class="text-danger font-13 py-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->hasRole('participant'))
                <div class="col-12 mb-3 d-flex align-items-stretch">
                    <button type="button" class="btn btn-primary text-left bg-dark-blue p-2 px-lg-5 py-lg-4 w-100"
                            data-bs-toggle="modal" data-bs-target="#skills">
            <span class="d-flex justify-content-start align-items-center">
                <i class="fas fa-wrench fa-2x mr-3"></i>
                <span class="font-weight-bold font-18">Skills</span>
            </span>
                        <p class="mt-2 mb-0">Show off your expertise in specific skills, tools, or software. </p>
                    </button>
                    <div class="modal fade" id="skills" tabindex="-1" role="dialog" aria-labelledby="skillsLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Skills</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('skills.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="font-13">Enter up to 25 professional skills, tools, and certifications to help us match you to projects.</p>
                                                    <select name="skills[]"  class="form-control w-100 skill-box" multiple="multiple">
                                                        @if(!empty($userSkills))
                                                            @foreach($userSkills as $skill)
                                                                <option value="{{ $skill->skill_name }}" selected>{{ $skill->skill_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('skills')
                                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('extraJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(() => {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
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
            $('.industry-box').select2({
                tags: false,
                maximumSelectionLength: 5,
            })
            $('.skill-box').select2({
                tags: true,
                minimumInputLength: 2,
                maximumSelectionLength: 25,
                ajax: {
                    method: 'POST',
                    url: "{{ route('skills.api') }}",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    delay: 250,
                    data: function (params){
                      return{
                          search: params.term
                      }
                    },
                    processResults: function(response) {
                        return {
                            results: $.map(response.options, function (obj) {
                                return {'id': obj.skill_name, 'text': obj.skill_name}
                            })
                        }
                    },
                    cache: false,
                }
            });
        });
    </script>

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
