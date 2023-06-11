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
                @if(!empty($profileInfo))
                    @if($profileInfo->user_avatar == null)
                        <img src="{{ asset('backend/img/profile/undraw_profile.svg') }}" class="img-80" id="preview_profile" alt="profile-picture">
                    @elseif($profileInfo->user_avatar !== null)
                        <img src="{{ asset('backend/img/profile/'.$profileInfo->user_avatar) }}" class="img-80" id="preview_profile" alt="profile-picture">
                    @endif
                @elseif(empty($profileInfo))
                    <img src="{{ asset('backend/img/profile/undraw_profile.svg') }}" class="img-80" id="preview_profile" alt="profile-picture">
                @endif

                <div class="ml-3 font">
                    <h4 class="font-weight-bold mb-0">Hey {{ Auth::user()->first_name}} !</h4>
                    <form action="{{ route('profile.avatar') }}" method="POST" class="user mt-1" enctype="multipart/form-data" >
                        @csrf
                        <label for="user_avatar" class="btn p-0  m-0 text-primary">Change Picture</label>
                        <input name="user_avatar" id="user_avatar" style="display: none;" type="file">
                        @error('user_avatar')
                        <p class="text-danger font-13 py-2">{{ $message }}</p>
                        @enderror
                        <button class="btn btn-primary btn-sm btn-user px-4 mx-4 btn-profile-save">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4 ">
        <div class="col-12 col-md-4 d-flex align-items-stretch">
            <button type="button" class="btn btn-primary text-left bg-dark-blue px-5 py-4 w-100" data-toggle="modal" data-target="#contactDetails">
                <span class="d-flex justify-content-start align-items-center">
                    <i class="fas fa-id-card-alt fa-2x mr-3"></i>
                    <span class="font-weight-bold font-18">Contact Details</span>
                </span>
                <p class="mt-2 mb-0"> Basic information about you and how to best reach you. </p>
            </button>
            <!-- Contact Details Modal -->
            <div class="modal fade" id="contactDetails" tabindex="-1" role="dialog" aria-labelledby="contactDetailsLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Contact Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
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
                                                    <option value="">Select Your State</option>

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
                                                        <option value="">Select Your City</option>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->hasRole('participant'))
        <div class="col-12 col-md-4 d-flex align-items-stretch">
            <button type="button" class="btn btn-primary text-left bg-dark-blue px-5 py-4 w-100" data-toggle="modal" data-target="#demographics">
                <span class="d-flex justify-content-start align-items-center">
                    <i class="fas fa-users fa-2x mr-3"></i>
                    <span class="font-weight-bold font-18">Demographics</span>
                </span>
                <p class="mt-2 mb-0">Review your gender, ethnicity, education, and income information.</p>
            </button>
            <div class="modal fade" id="demographics" tabindex="-1" role="dialog" aria-labelledby="demographicsLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Demographics</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('profile.demographics') }}" method="POST">
                            @csrf
                        <div class="modal-body">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <label class="col-form-label text-dark">Gender</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <select name="gender" class="form-control" @if(!empty($profileInfo)) @if($profileInfo->status == 'deactivate') disabled="disabled" @elseif($profileInfo->status == 'active') @endif @elseif(empty($profileInfo)) @endif >
                                                    <option value=""> Select Your Gender </option>
                                                    <option value="male" @if(!empty($profileInfo) && $profileInfo->gender == 'male') selected
                                                            @elseif(empty($profileInfo)) @if(old('gender') == 'male')) selected @endif  @endif >Male</option>
                                                    <option value="female" @if(!empty($profileInfo) && $profileInfo->gender == 'female') selected
                                                            @elseif(empty($profileInfo)) @if(old('gender') == 'female')) selected @endif  @endif >Female</option>
                                                    <option value="non-binary"@if(!empty($profileInfo) && $profileInfo->gender == 'non-binary') selected
                                                            @elseif(empty($profileInfo)) @if(old('gender') == 'non-binary')) selected @endif  @endif >Non Binary</option>
                                                    <option value="prefer-not-to-say" @if(!empty($profileInfo) && $profileInfo->gender == 'prefer-not-to-say') selected
                                                            @elseif(empty($profileInfo)) @if(old('gender') == 'prefer-not-to-say')) selected @endif  @endif >Prefer Not To Say</option>
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
                                                <input type="date" name="date_of_birth" class="form-control" @if(!empty($profileInfo)) @if($profileInfo->status == 'deactivate') value="{{ $profileInfo->date_of_birth }}" disabled="disabled" @elseif($profileInfo->status == 'active') @endif @elseif(empty($profileInfo)) value="{{ old(date_of_birth) }}"  @endif>
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
                                                <select name="ethnicity" id="" class="form-control" @if(!empty($profileInfo)) @if($profileInfo->status == 'deactivate') disabled="disabled" @elseif($profileInfo->status == 'active') @endif @elseif(empty($profileInfo)) @endif>
                                                    <option value=""> Select Your Ethnicity </option>
                                                    <option value="american-indian-or-alaska-native"@if(!empty($profileInfo) && $profileInfo->ethnicity == 'american-indian-or-alaska-native') selected
                                                            @elseif(empty($profileInfo)) @if(old('ethnicity') == 'american-indian-or-alaska-native')) selected @endif  @endif>American Indian / Alaskan Native</option>
                                                    <option value="asian" @if(!empty($profileInfo) && $profileInfo->ethnicity == 'asian') selected
                                                            @elseif(empty($profileInfo)) @if(old('ethnicity') == 'asian')) selected @endif  @endif>Asian</option>
                                                    <option value="white-caucasian" @if(!empty($profileInfo) && $profileInfo->ethnicity == 'white-caucasian') selected
                                                            @elseif(empty($profileInfo)) @if(old('ethnicity') == 'white-caucasian')) selected @endif  @endif>White/Caucasian</option>
                                                    <option value="pacific-islander" @if(!empty($profileInfo) && $profileInfo->ethnicity == 'pacific-islander') selected
                                                            @elseif(empty($profileInfo)) @if(old('ethnicity') == 'pacific-islander')) selected @endif  @endif>Pacific Islander</option>
                                                    <option value="african-american" @if(!empty($profileInfo) && $profileInfo->ethnicity == 'african-american') selected
                                                            @elseif(empty($profileInfo)) @if(old('ethnicity') == 'african-american')) selected @endif  @endif>African American</option>
                                                    <option value="hispanic" @if(!empty($profileInfo) && $profileInfo->ethnicity == 'hispanic') selected
                                                            @elseif(empty($profileInfo)) @if(old('ethnicity') == 'hispanic')) selected @endif  @endif>Hispanic</option>
                                                    <option value="multiracial" @if(!empty($profileInfo) && $profileInfo->ethnicity == 'multiracial') selected
                                                            @elseif(empty($profileInfo)) @if(old('ethnicity') == 'multiracial')) selected @endif  @endif>Multiracial</option>
                                                    <option value="other" @if(!empty($profileInfo) && $profileInfo->ethnicity == 'other') selected
                                                            @elseif(empty($profileInfo)) @if(old('ethnicity') == 'other')) selected @endif  @endif>Other</option>
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
                                                <select name="education_level" id="" class="form-control" @if(!empty($profileInfo)) @if($profileInfo->status == 'deactivate') disabled="disabled" @elseif($profileInfo->status == 'active') @endif @elseif(empty($profileInfo)) @endif >
                                                    <option value=""> Select Your Education Level </option>
                                                    <option value="less-than-a-high-school-diploma" @if(!empty($profileInfo) && $profileInfo->education_level == 'less-than-a-high-school-diploma') selected
                                                            @elseif(empty($profileInfo)) @if(old('education_level') == 'less-than-a-high-school-diploma')) selected @endif  @endif>Less Than a High School Diploma</option>
                                                    <option value="high-school-diploma-or-equivalent" @if(!empty($profileInfo) && $profileInfo->education_level == 'high-school-diploma-or-equivalent') selected
                                                            @elseif(empty($profileInfo)) @if(old('education_level') == 'high-school-diploma-or-equivalent')) selected @endif  @endif>High School Diploma or Equivalent</option>
                                                    <option value="some-college-no-degree" @if(!empty($profileInfo) && $profileInfo->education_level == 'some-college-no-degree') selected
                                                            @elseif(empty($profileInfo)) @if(old('education_level') == 'some-college-no-degree')) selected @endif  @endif>Some College No Degree</option>
                                                    <option value="associate-degree" @if(!empty($profileInfo) && $profileInfo->education_level == 'associate-degree') selected
                                                            @elseif(empty($profileInfo)) @if(old('education_level') == 'associate-degree')) selected @endif  @endif>Associate Degree</option>
                                                    <option value="bachelors-degree" @if(!empty($profileInfo) && $profileInfo->education_level == 'bachelors-degree') selected
                                                            @elseif(empty($profileInfo)) @if(old('education_level') == 'bachelors-degree')) selected @endif  @endif>Bachelor's Degree</option>
                                                    <option value="masters-degree" @if(!empty($profileInfo) && $profileInfo->education_level == 'masters-degree') selected
                                                            @elseif(empty($profileInfo)) @if(old('education_level') == 'masters-degree')) selected @endif  @endif>Master's Degree</option>
                                                    <option value="professional-degree" @if(!empty($profileInfo) && $profileInfo->education_level == 'professional-degree') selected
                                                            @elseif(empty($profileInfo)) @if(old('education_level') == 'professional-degree')) selected @endif  @endif>Professional Degree</option>
                                                    <option value="doctorate" @if(!empty($profileInfo) && $profileInfo->education_level == 'doctorate') selected
                                                            @elseif(empty($profileInfo)) @if(old('education_level') == 'doctorate')) selected @endif  @endif>Doctorate</option>
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
                                                <select name="household_income" id="" class="form-control" @if(!empty($profileInfo)) @if($profileInfo->status == 'deactivate') disabled="disabled" @elseif($profileInfo->status == 'active') @endif @elseif(empty($profileInfo)) @endif >
                                                    <option value=""> Select Your Household Income </option>
                                                    <option value="less20000" @if(!empty($profileInfo) && $profileInfo->household_income == 'less20000') selected
                                                            @elseif(empty($profileInfo)) @if(old('household_income') == 'less20000')) selected @endif  @endif>Less than $20,000</option>
                                                    <option value="20000to34999" @if(!empty($profileInfo) && $profileInfo->household_income == '20000to34999') selected
                                                            @elseif(empty($profileInfo)) @if(old('household_income') == '20000to34999')) selected @endif  @endif>$20,000 – $34,999</option>
                                                    <option value="35000to49999" @if(!empty($profileInfo) && $profileInfo->household_income == '35000to49999') selected
                                                            @elseif(empty($profileInfo)) @if(old('household_income') == '35000to49999')) selected @endif  @endif>$35,000– $49,999</option>
                                                    <option value="50000to74999" @if(!empty($profileInfo) && $profileInfo->household_income == '50000to74999') selected
                                                            @elseif(empty($profileInfo)) @if(old('household_income') == '50000to74999')) selected @endif  @endif>$50,000 – $74,999</option>
                                                    <option value="75000to99999" @if(!empty($profileInfo) && $profileInfo->household_income == '75000to99999') selected
                                                            @elseif(empty($profileInfo)) @if(old('household_income') == '75000to99999')) selected @endif  @endif>$75,000 - $99,999</option>
                                                    <option value="100000plus" @if(!empty($profileInfo) && $profileInfo->household_income == '100000plus') selected
                                                            @elseif(empty($profileInfo)) @if(old('household_income') == '100000plus')) selected @endif  @endif>$100,000 +</option>
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
                                                <select name="marital_status" id="" class="form-control" @if(!empty($profileInfo)) @if($profileInfo->status == 'deactivate') disabled="disabled" @elseif($profileInfo->status == 'active') @endif @elseif(empty($profileInfo)) @endif >
                                                    <option value=""> Select Your Household Income </option>
                                                    <option value="single" @if(!empty($profileInfo) && $profileInfo->marital_status == 'single') selected
                                                        @elseif(empty($profileInfo)) @if(old('household_income') == 'single')) selected @endif  @endif>Single</option>
                                                    <option value="married" @if(!empty($profileInfo) && $profileInfo->marital_status == 'married') selected
                                                        @elseif(empty($profileInfo)) @if(old('household_income') == 'married')) selected @endif  @endif>Married</option>
                                                    <option value="divorced" @if(!empty($profileInfo) && $profileInfo->marital_status == 'divorced') selected
                                                        @elseif(empty($profileInfo)) @if(old('household_income') == 'divorced')) selected @endif  @endif>Divorced</option>
                                                    <option value="widowed" @if(!empty($profileInfo) && $profileInfo->marital_status == 'widowed') selected
                                                        @elseif(empty($profileInfo)) @if(old('household_income') == 'widowed')) selected @endif  @endif>Widowed</option>
                                                    <option value="living-with-significant-other" @if(!empty($profileInfo) && $profileInfo->marital_status == 'living-with-significant-other') selected
                                                        @elseif(empty($profileInfo)) @if(old('household_income') == 'living-with-significant-other')) selected @endif  @endif>Living with Significant Other</option>
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
                                                <label class="col-form-label text-dark">Number of children living in your household?</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <select name="children_in_living" id="" class="form-control" @if(!empty($profileInfo)) @if($profileInfo->status == 'deactivate') disabled="disabled" @elseif($profileInfo->status == 'active') @endif @elseif(empty($profileInfo)) @endif >
                                                    <option value=""> Select Your Children In Living </option>
                                                    <option value="0" @if(!empty($profileInfo) && $profileInfo->children_in_living == '0') selected
                                                        @elseif(empty($profileInfo)) @if(old('household_income') == '0')) selected @endif  @endif>0</option>
                                                    <option value="1" @if(!empty($profileInfo) && $profileInfo->children_in_living == '1') selected
                                                        @elseif(empty($profileInfo)) @if(old('household_income') == '1')) selected @endif  @endif>1</option>
                                                    <option value="2" @if(!empty($profileInfo) && $profileInfo->children_in_living == '2') selected
                                                        @elseif(empty($profileInfo)) @if(old('household_income') == '2')) selected @endif  @endif>2</option>
                                                    <option value="3" @if(!empty($profileInfo) && $profileInfo->children_in_living == '3') selected
                                                        @elseif(empty($profileInfo)) @if(old('household_income') == '3')) selected @endif  @endif>3</option>
                                                    <option value="4" @if(!empty($profileInfo) && $profileInfo->children_in_living == '4') selected
                                                        @elseif(empty($profileInfo)) @if(old('household_income') == '4')) selected @endif  @endif>4</option>
                                                    <option value="5-plus" @if(!empty($profileInfo) && $profileInfo->children_in_living == '5-plus') selected
                                                        @elseif(empty($profileInfo)) @if(old('household_income') == '5-plus')) selected @endif  @endif>5+</option>
                                                </select>
                                                @error('children_in_living')
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
        <div class="col-12 col-md-4 d-flex align-items-stretch">
            <button type="button" class="btn btn-primary text-left bg-dark-blue px-5 py-4 w-100" data-toggle="modal" data-target="#employment">
                <span class="d-flex justify-content-start align-items-center">
                    <i class="fas fa-briefcase fa-2x mr-3"></i>
                    <span class="font-weight-bold font-18">Employment</span>
                </span>
                <p class="mt-2 mb-0">Details around your professional work experience.</p>
            </button>
            <div class="modal fade" id="employment" tabindex="-1" role="dialog" aria-labelledby="demographicsLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Employment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST">
                            @csrf
                        <div class="modal-body">
                                @if(Auth::user()->hasRole('participant'))
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <label class="col-form-label text-dark">Employment Status</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <select name="employment_status" class="form-control">
                                                <option value="">Select Your Employment Status</option>
                                                <option value="self-employed" @if(old('employment_status') == 'self-employed') selected @endif>Self Employed</option>
                                                <option value="homemaker" @if(old('employment_status') == 'homemaker') selected @endif>Homemaker</option>
                                                <option value="employed-part-time" @if(old('employment_status') == 'employed-part-time') selected @endif>Employed part time</option>
                                                <option value="employed-full-time" @if(old('employment_status') == 'employed-full-time') selected @endif>Employed full time</option>
                                                <option value="not-employed-looking-for-work" @if(old('employment_status') == 'not-employed-looking-for-work') selected @endif>Not employed - looking for work</option>
                                                <option value="not-employed-not-looking-for-work" @if(old('employment_status') == 'not-employed-not-looking-for-work') selected @endif>Not employed - not looking for work</option>
                                                <option value="retired" @if(old('employment_status') == 'retired') selected @endif>Retired</option>
                                                <option value="unable-to-work" @if(old('employment_status') == 'unable-to-work') selected @endif>Unable to work</option>
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
                                            <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control" placeholder="Your Company Name">
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
                                                <option value="self-employed" @if(old('company_size') == 'self-employed') selected @endif>Self Employed</option>
                                                <option value="1to10" @if(old('company_size') == '1to10') selected @endif>1 - 10</option>
                                                <option value="11to50" @if(old('company_size') == '11to50') selected @endif>11 - 50</option>
                                                <option value="51to200" @if(old('company_size') == '51to200') selected @endif>51 - 200</option>
                                                <option value="201to500" @if(old('company_size') == '201to500') selected @endif>201 - 500</option>
                                                <option value="501to1000" @if(old('company_size') == '501to1000') selected @endif>501 - 1,000</option>
                                                <option value="1001to5000" @if(old('company_size') == '1001to5000') selected @endif>1,001 - 5,000</option>
                                                <option value="5001to10000" @if(old('company_size') == '5001to10000') selected @endif>5,001 - 10,000</option>
                                                <option value="10000plus" @if(old('company_size') == '10000plus') selected @endif>10,000+</option>
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
                                            <input type="text" name="job_title" value="{{ old('job_title') }}" class="form-control" placeholder="Enter Your Job Title">
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
                                            @if(Auth::user()->hasRole('participant'))
                                                <select data-placeholder="Type To Search.." name="industry[]" class="chosen-select form-control" multiple tabindex="4">
                                                    @foreach($industries as $industry)
                                                        <option value="{{ $industry }}">{{ $industry }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @if(Auth::user()->hasRole('researcher'))
                                                <select name="industry" class="form-control" >
                                                    <option>Select Your Industry</option>
                                                    @foreach($industries as $industry)
                                                        <option value="{{ $industry }}">{{ $industry }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
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
    </div>

@endsection
@section('extraJs')
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
        $('.modal-body .chosen-select').chosen({max_selected_options: 5}).change( function(obj, result) {
        console.debug("changed: %o", arguments);
        // console.log("selected: " + result.selected);
        });
    </script>

@endsection







