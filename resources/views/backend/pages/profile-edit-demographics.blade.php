@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Edit Demographics')
@section('extraCss')
    <link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
@endsection
@section('mainContent')

    @include('backend.includes.user-banner')

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
                            <p class="fw-medium">Email @if(Auth::user()->hasVerifiedEmail())<span data-bs-toggle="tooltip" data-bs-placement="right" title="Verified"><i class="fa-regular fa-circle-check text-primary"></i></span> @endif </p>
                        </div>
                        <div class="col-12 col-lg-8 mb-3">
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="fw-medium">Skills</p>
                        <a href="{{ route('profile.edit.skill') }}" class="btn" onclick="return confirm('Are you sure you want to cancel editing?') ? window.location.href = '{{ route('profile.edit.skill') }}' : false;"><i class="fa-solid fa-pen text-secondary"></i></a>
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
                    <div class="col-12">
                        <div class="card py-3 px-2 rounded-4 shadow-md">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <p class="font-22 fw-bold">Contact Details</p>
                                    <a href="{{ route('profile.edit.contact') }}" class="btn" onclick="return confirm('Are you sure you want to cancel editing?') ? window.location.href = '{{ route('profile.edit.contact') }}' : false;"><i class="fa-solid fa-pen text-secondary"></i></a>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                        <p class="fw-medium">Phone</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <p class="fw-medium text-secondary">
                                            @if (!empty($profileInfo))
                                                @if (!empty($profileInfo->phone))
                                                    {{ $profileInfo->phone }}
                                                @else Update
                                                @endif
                                            @else Update
                                            @endif</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                        <p class="fw-medium">Paypal</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <p class="fw-medium text-secondary">
                                            @if (!empty($profileInfo))
                                                @if (!empty($profileInfo->paypal_email))
                                                    {{ $profileInfo->paypal_email }}
                                                @else Update
                                                @endif
                                            @else Update
                                            @endif</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                        <p class="fw-medium">Country</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <p class="fw-medium text-secondary">USA</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                        <p class="fw-medium">State</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <p class="fw-medium text-secondary">
                                            @if (!empty($profileInfo))
                                                @if (!empty($profileInfo->state))
                                                    {{ $profileInfo->state }}
                                                @else Update
                                                @endif
                                            @else Update
                                            @endif</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                        <p class="fw-medium">City</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <p class="fw-medium text-secondary">
                                            @if (!empty($profileInfo))
                                                @if (!empty($profileInfo->city))
                                                    {{ $profileInfo->city }}
                                                @else Update
                                                @endif
                                            @else Update
                                            @endif</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                        <p class="fw-medium">Zip Code</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <p class="fw-medium text-secondary">
                                            @if (!empty($profileInfo))
                                                @if (!empty($profileInfo->zip_code))
                                                    {{ $profileInfo->zip_code }}
                                                @else Update
                                                @endif
                                            @else Update
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>

            <div class="row my-4">
                <div class="col-12">
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
                    <div class="card py-3 px-2 rounded-4 shadow-md">
                        <div class="card-body">
                            <div class="d-md-flex justify-content-md-between mb-3">
                                <p><span class="font-22 fw-bold">Demographics</span>@if (!empty($profileInfo))
                                    @if ($profileInfo->status == 'deactivate')
                                            <span class="ms-2">Need to make changes? Contact us at <a
                                                    href="mailto:support@research.com">support@research.com</a></span>
                                    @elseif($profileInfo->status == 'active')
                                            <span class="ms-2">Be alert; once you change, you are unable to change back.</span>
                                            @endif
                                            @elseif(empty($profileInfo))
                                                <span class="ms-2">Be alert; once you change, you are unable to change back.</span>
                                                    @endif</p>

                                <div class="d-flex">
                                    <a href="{{ route('profile.index') }}" class="btn btn-danger btn-sm me-2" @if (!empty($profileInfo))
                                        @if ($profileInfo->status == 'deactivate')
                                        @elseif($profileInfo->status == 'active')
                                            onclick="return confirm('Are you sure you want to cancel editing the demographics?') ? window.location.href = '{{ route('profile.index') }}' : false;"
                                                @endif
                                                @elseif(empty($profileInfo))
                                                    onclick="return confirm('Are you sure you want to cancel editing the demographics?') ? window.location.href = '{{ route('profile.index') }}' : false;"
                                                        @endif >
                                        <i class="fa-solid fa-arrow-up-from-bracket fa-rotate-270 me-2"></i><span>Back</span>
                                    </a>
                                    @if (!empty($profileInfo))
                                        @if ($profileInfo->status == 'deactivate')
                                        @elseif($profileInfo->status == 'active')
                                            <button class="btn btn-primary btn-sm"><i class="fa-solid fa-check me-2"></i><span>Save</span></button>
                                        @endif
                                    @elseif(empty($profileInfo))
                                        <button class="btn btn-primary btn-sm"><i class="fa-solid fa-check me-2"></i><span>Save</span></button>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Gender</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
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
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Date Of Birth</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
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
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Ethnicity</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
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
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Education level</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
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
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Household Income</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
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
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Marital Status</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
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
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Number of children living in your household?</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
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
                    </div>
                    @if (!empty($profileInfo))
                        @if ($profileInfo->status == 'active')
                        </form>
                        @elseif ($profileInfo->status == 'deactivate')
                        @endif
                    @else
                        </form>
                    @endif
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card py-3 px-2 rounded-4 shadow-md">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <p class="font-22 fw-bold">Employment</p>
                                <a href="{{ route('profile.edit.employment') }}" class="btn" onclick="return confirm('Are you sure you want to cancel editing?') ? window.location.href = '{{ route('profile.edit.employment') }}' : false;"><i class="fa-solid fa-pen text-secondary"></i></a>

                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Employment Status</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
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
                                                @default
                                                    Update
                                            @endswitch
                                        @else Update
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
                                            @else Update
                                            @endif
                                        @else Update
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
                                                @default
                                                    Update
                                            @endswitch
                                        @else Update
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
                                                {{ $profileInfo->job_title }}
                                            @else Update
                                            @endif
                                        @else Update
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
                                        @else Update
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
@endsection
