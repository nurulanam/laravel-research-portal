@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Edit Eployment')
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
                    @if(Auth::user()->hasRole('participant'))
                    <div class="d-flex justify-content-between">
                        <p class="fw-medium">Skills</p>
                        <a href="{{ route('profile.edit.skill') }}" class="btn" onclick="return confirm('Are you sure you want to cancel editing the emloyment?') ? window.location.href = '{{ route('profile.edit.skill') }}' : false;"><i class="fa-solid fa-pen text-secondary"></i></a>
                    </div>
                    <div>
                        @if(!empty($userSkills))
                            @foreach($userSkills as $skill)
                                <span class="badge bg-primary rounded-pill px-3 py-2 me-2 mb-2 text-capitalize">{{ $skill->skill_name }}</span>
                            @endforeach
                        @endif
                    </div>
                    @endif
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
                                <a href="{{ route('profile.edit.contact') }}" class="btn" onclick="return confirm('Are you sure you want to cancel editing the emloyment?') ? window.location.href = '{{ route('profile.edit.contact') }}' : false;"><i class="fa-solid fa-pen text-secondary"></i></a>
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
                                @if(Auth::user()->hasRole('participant'))
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
                                @endif
                            </div>
                            @if(Auth::user()->hasRole('participant'))
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
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            @if (Auth::user()->hasRole('participant'))
            <div class="row my-4">
                <div class="col-12">
                    <div class="card py-3 px-2 rounded-4 shadow-md">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <p class="font-22 fw-bold">Demographics</p>
                                <a href="{{ route('profile.edit.demographics') }}" class="btn" onclick="return confirm('Are you sure you want to cancel editing the employment?') ? window.location.href = '{{ route('profile.edit.demographics') }}' : false;"><i class="fa-solid fa-pen text-secondary"></i></a>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Gender</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
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
                                                @default
                                                    Update
                                            @endswitch
                                        @else
                                            Update
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
                                            @else Update
                                            @endif
                                        @else Update
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
                                            @switch($profileInfo->ethnicity)
                                                @case('american-indian-or-alaska-native')
                                                    American Indian / Alaskan Native
                                                    @break
                                                @case('asian')
                                                    Asian
                                                    @break
                                                @case('white-caucasian')
                                                    White/Caucasian
                                                    @break
                                                @case('pacific-islander')
                                                    Pacific Islander
                                                    @break
                                                @case('african-american')
                                                    African American
                                                    @break
                                                @case('hispanic')
                                                    Hispanic
                                                    @break
                                                @case('multiracial')
                                                    Multiracial
                                                    @break
                                                @case('other')
                                                    Other
                                                    @break
                                                @default
                                                    Update
                                            @endswitch
                                        @else
                                            Update
                                        @endif

                                    </p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Education level</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
                                            @switch($profileInfo->education_level)
                                                @case('less-than-a-high-school-diploma')
                                                    Less Than a High School Diploma
                                                    @break
                                                @case('high-school-diploma-or-equivalent')
                                                    High School Diploma or Equivalent
                                                    @break
                                                @case('some-college-no-degree')
                                                    Some College No Degree
                                                    @break
                                                @case('associate-degree')
                                                    Associate Degree
                                                    @break
                                                @case('bachelors-degree')
                                                    Bachelor's Degree
                                                    @break
                                                @case('masters-degree')
                                                    Master's Degree
                                                    @break
                                                @case('professional-degree')
                                                    Professional Degree
                                                    @break
                                                @case('doctorate')
                                                    Doctorate
                                                    @break
                                                @default
                                                    Update
                                            @endswitch
                                        @else
                                            Update
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
                                            @switch($profileInfo->household_income)
                                                @case('less20000') Less than $20,000 @break
                                                @case('20000to34999') $20,000 – $34,999 @break
                                                @case('35000to49999') $35,000– $49,999 @break
                                                @case('50000to74999') $50,000 – $74,999 @break
                                                @case('75000to99999') $75,000 - $99,999 @break
                                                @case('100000plus') $100,000 + @break
                                                @default
                                                    Update
                                            @endswitch
                                        @else Update
                                        @endif

                                    </p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Marital Status</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
                                            @switch($profileInfo->marital_status)
                                                @case('single') Single @break
                                                @case('married') Married @break
                                                @case('divorced') Divorced @break
                                                @case('widowed') Widowed @break
                                                @case('living-with-significant-other') Living with Significant Other @break
                                                @default
                                                    Update
                                            @endswitch
                                        @else Update
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Number of children living in your household?</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
                                    <p class="fw-medium text-secondary">
                                        @if (!empty($profileInfo))
                                            @switch($profileInfo->children_in_living)
                                                @case('0') 0 @break
                                                @case('1') 1 @break
                                                @case('2') 2 @break
                                                @case('3') 3 @break
                                                @case('4') 4 @break
                                                @case('5-plus') 5+ @break
                                                @default
                                                    Update
                                            @endswitch
                                        @else Update
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card py-3 px-2 rounded-4 shadow-md">
                        <form action="{{ route('profile.employment') }}" method="POST">
                            @csrf
                        <div class="card-body">
                            <div class="d-md-flex justify-content-md-between mb-3">
                                <p class="font-22 fw-bold">Employment</p>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('profile.index') }}" class="btn btn-danger btn-sm me-2" onclick="return confirm('Are you sure you want to cancel editing the employment?') ? window.location.href = '{{ route('profile.index') }}' : false;">
                                        <i class="fa-solid fa-arrow-up-from-bracket fa-rotate-270 me-2"></i><span>Back</span>
                                    </a>
                                    <button class="btn btn-primary btn-sm"><i class="fa-solid fa-check me-2"></i><span>Save</span></button>
                                </div>
                            </div>
                            <div class="row">
                                @if(Auth::user()->hasRole('participant'))
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Employment Status</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
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
                                @elseif(Auth::user()->hasRole('researcher'))
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                        <p class="fw-medium">Industry</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <select name="industry" class="form-control">
                                            <option value="">Select Your Industry</option>
                                            @foreach ($industries as $key => $industry)
                                                <option value="{{ $key }}"
                                                        @if (isset($profileIndustry))
                                                            @if ($profileIndustry == $key)
                                                                selected="selected"
                                                    @endif
                                                    @endif
                                                >{{ $industry }}</option>
                                            @endforeach
                                        </select>
                                        @error('industry')
                                        <p class="text-danger font-13 py-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Company Name
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
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
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Company Size</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
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
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Job Title</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mb-3">
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
                            <div class="row">
                                @if (Auth::user()->hasRole('participant'))
                                <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                    <p class="fw-medium">Industry</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-9 mb-3">

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
                                    @error('industry')
                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('extraJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.industry-box').select2({
                tags: false,
                maximumSelectionLength: 5,
            }).on('change', function(e) {
                var selectedOptions = $(this).val() || [];
                if (selectedOptions.length > 5) {
                    // Remove extra selections
                    selectedOptions.splice(2);
                    $(this).val(selectedOptions).trigger('change');
                }
            });
        })
    </script>
@endsection
