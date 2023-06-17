@extends('backend.dashboardMaster')
@section('title', 'Create New Project')
@section('extraCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
    <style>
        .form-section{
            display: none;
        }
        .form-section.current{
            display: inline;
        }
        .parsley-errors-list{
            color:red;
            font-size: 13px;
            padding: 5px 10px;
            margin: 0 !important;
        }
        .my-30{
            margin: 30px 0;
        }
    </style>
@endsection
@section('mainContent')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark-blue">
                    <h5 class="text-light mb-0"id="main_title">Project Title</h5>
                </div>
                <div class="card-body">
                    <div class="nav nav-fill my-2">
                        <label class="nav-link shadow-sm step0 border rounded mx-2">Details</label>
                        <label class="nav-link shadow-sm step1 border rounded mx-2">Audience</label>
                        <label class="nav-link shadow-sm step2 border rounded mx-2">Questions</label>
                        <label class="nav-link shadow-sm step3 border rounded mx-2">Summery</label>
                    </div>
                    <form action="" class="new-project-form my-4">
                        <div class="form-section">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="required">Internal Project Name <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" name="internal_name" id="internal_name" class="form-control" placeholder="Internal Project Name" required>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-30">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="required">Project Title <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" name="project_title" class="form-control" placeholder="Project Title" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="required">Project Details <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <textarea name="project_details" class="form-control" placeholder="Project Full Details" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-30">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="required">Target Audience <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="radio" name="audience">
                                            <span class="mx-2">Industry Professionals (B2B)</span>
                                        </div>
                                        <div class="">
                                            <input type="radio" name="audience" required>
                                            <span class="mx-2">General Population (B2C)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label">Type of Research</lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="radio" name="research_type">
                                            <span class="mx-2">Remote</span>
                                        </div>
                                        <div class="">
                                            <input type="radio" name="research_type">
                                            <span class="mx-2">In-Person</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-30">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label">Research Methodology</lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <select name="research_method" class="form-control">
                                            <option value="">Select Research Method</option>
                                            <option value="One-on-One">One-on-One</option>
                                            <option value="Focus Group">Focus Group</option>
                                            <option value="Unmoderated-Study">Unmoderated Study</option>
                                            <option value="Survey">Survey</option>
                                            <option value="Diary-Study">Diary Study</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label">Time Required (<span class="text-danger">Minutes</span>)</lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="number" name="required_time" class="form-control" placeholder="Time Required in Minute(s)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label">Incentive (<span class="text-danger">Min: $5 - Max: $1000</span>)</lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="d-md-flex">
                                            <input type="number" name="required_time" id="required_time" min="5" max="1000" value="5" class="form-control w-50 my-2 my-md-0 mr-3" placeholder="Total Incentive" disabled="disabled" readonly="readonly">
                                            <input type="range" name="" id="required_time_range" min="5" max="1000" step="5" value="5" class="form-control-range">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label">Target number of participants <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="d-md-flex">
                                            <input type="number" name="target_participant" id="target_participant" min="1" max="50" value="1" class="form-control w-50 my-2 my-md-0 mr-3" placeholder="Total Incentive" disabled="disabled" readonly="readonly">
                                            <input type="range" name="" id="target_participant_range" min="1" max="50" step="1" value="1" class="form-control-range" required>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label">Industries <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <select data-placeholder="Select Maximum 5 Industries.." name="industry[]"
                                                class="chosen-select form-control" multiple tabindex="4">

                                            @foreach ($industries as $industry)
                                                <option value="{{ $industry }}" @if (old('industry') == $industry) selected @endif>{{ $industry }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label">Company Size <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="checkbox" name="company_size" value="self-employed" id="self-employed" @if (old('company_size') == 'self-employed') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="self-employed">Self Employed</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="company_size" value="1to10" id="1to10" @if (old('company_size') == '1to10') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="1to10">1 - 10</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="company_size" value="11to50" id="11to50" @if (old('company_size') == '11to50') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="11to50">11 - 50</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="company_size" value="51to200" id="51to200" @if (old('company_size') == '51to200') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="51to200">51 - 200</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="company_size" value="201to500" id="201to500" @if (old('company_size') == '201to500') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="201to500">201 - 500</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="company_size" value="501to1000" id="501to1000" @if (old('company_size') == '501to1000') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="501to1000">501 - 1,000</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="company_size" value="1001to5000" id="1001to5000" @if (old('company_size') == '1001to5000') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="1001to5000">1,001 - 5,000</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="company_size" value="5001to10000" id="5001to10000" @if (old('company_size') == '5001to10000') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="5001to10000">5,001 - 10,000</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="company_size" value="10000plus" id="10000plus" @if (old('company_size') == '10000plus') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="10000plus">10,000+</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="company_size" value="allCompanySize" id="allCompanySize" @if (old('company_size') == 'allCompanySize') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="allCompanySize">All Company Sizes</label></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-30">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label">Location</lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="d-flex justify-content-between">
                                            <div class="country w-100 mx-lg-1">
                                                <input type="text" class="form-control" value="US" placeholder="US" disabled="disabled" readonly="readonly">
                                            </div>
                                            <div class="state w-100 mx-lg-1">
                                                <select name="state" class="form-control w-100" id="state">
                                                    <option value="">Select Your State</option>
                                                    @foreach ($us_states as $key => $states)
                                                        <option value="{{ $key }}"
                                                                @if (old('state') == $key) selected @endif>{{ $key }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="state-city w-100 mx-lg-1">
                                                @foreach ($us_states as $key => $cities)
                                                    <select name="city" class="form-control w-100 city"
                                                            data-state="{{ $key }}">
                                                        <option value="">Select Your City</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city }}" @if (old('city') == $city) selected @endif>{{ $city }}</option>
                                                        @endforeach
                                                    </select>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr class="my-30">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lablel class="label">Household Income (Optional)</lablel>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="checkbox" name="household_income" value="less20000" id="less20000" @if (old('household_income') == 'less20000') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="less20000">Less than $20,000</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="household_income" value="20000to34999" id="20000to34999" @if (old('household_income') == '20000to34999') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="20000to34999">$20,000 – $34,999</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="household_income" value="35000to49999" id="35000to49999" @if (old('household_income') == '35000to49999') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="35000to49999">$35,000– $49,999</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="household_income" value="50000to74999" id="50000to74999" @if (old('household_income') == '50000to74999') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="50000to74999">$50,000 – $74,999</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="household_income" value="75000to99999" id="75000to99999" @if (old('household_income') == '75000to99999') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="75000to99999">$75,000 - $99,999</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="household_income" value="100000plus" id="100000plus" @if (old('household_income') == '100000plus') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="100000plus">$100,000 +</label></span>
                                        </div><div class="">
                                            <input type="checkbox" name="household_income" value="allHouseholeIncome" id="allHouseholeIncome" @if (old('household_income') == 'allHouseholeIncome') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="allHouseholeIncome">All Household Income</label></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lablel class="label">Gender (Optional)</lablel>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="checkbox" name="gender" value="male" id="male" @if (old('gender') == 'male') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="male">Male</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="gender" value="female" id="female" @if (old('gender') == 'female') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="female">Female</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="gender" value="non-binary" id="non-binary" @if (old('gender') == 'non-binary') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="non-binary">Non Binary</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="gender" value="prefer-not-to-say" id="prefer-not-to-say" @if (old('gender') == 'prefer-not-to-say') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="prefer-not-to-say">Prefer Not To Say</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="gender" value="all-gender" id="allGender">
                                            <span class="mx-2"><label class="form-check-label" for="allGender">All Gender</label></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lablel class="label">Education Level (Optional)</lablel>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="checkbox" name="education_level" value="less-than-a-high-school-diploma" id="less-than-a-high-school-diploma" @if (old('education_level') == 'less-than-a-high-school-diploma') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="less-than-a-high-school-diploma">Less Than a High School Diploma</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="education_level" value="high-school-diploma-or-equivalent" id="high-school-diploma-or-equivalent" @if (old('education_level') == 'high-school-diploma-or-equivalent') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="high-school-diploma-or-equivalent">High School Diploma or Equivalent</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="education_level" value="some-college-no-degree" id="some-college-no-degree" @if (old('education_level') == 'some-college-no-degree') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="some-college-no-degree">Some College No Degree</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="education_level" value="associate-degree" id="associate-degree" @if (old('education_level') == 'associate-degree') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="associate-degree">Associate Degree</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="education_level" value="bachelors-degree" id="bachelors-degree" @if (old('education_level') == 'bachelors-degree') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="bachelors-degree">Bachelor's Degree</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="education_level" value="masters-degree" id="masters-degree" @if (old('education_level') == 'masters-degree') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="masters-degree">Master's Degree</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="education_level" value="professional-degree" id="professional-degree" @if (old('education_level') == 'professional-degree') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="professional-degree">Professional Degree</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="education_level" value="doctorate" id="doctorate" @if (old('education_level') == 'doctorate') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="doctorate">Doctorate</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="education_level" value="all-education-levels" id="allEducationLevels">
                                            <span class="mx-2"><label class="form-check-label" for="allEducationLevels">All Education Levels</label></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lablel class="label">Ethnicity (Optional)</lablel>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="checkbox" name="ethnicity" value="american-indian-or-alaska-native" id="american-indian-or-alaska-native" @if(old('ethnicity') == 'american-indian-or-alaska-native') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="american-indian-or-alaska-native">American Indian / Alaskan Native</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="ethnicity" value="asian" id="asian" @if(old('ethnicity') == 'asian') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="asian">Asian</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="ethnicity" value="white-caucasian" id="white-caucasian" @if(old('ethnicity') == 'white-caucasian') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="white-caucasian">White/Caucasian</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="ethnicity" value="pacific-islander" id="pacific-islander" @if(old('ethnicity') == 'pacific-islander') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="pacific-islander">Pacific Islander</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="ethnicity" value="african-american" id="african-american" @if(old('ethnicity') == 'african-american') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="african-american">African American</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="ethnicity" value="hispanic" id="hispanic" @if(old('ethnicity') == 'hispanic') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="hispanic">Hispanic</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="ethnicity" value="multiracial" id="multiracial" @if(old('ethnicity') == 'multiracial') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="multiracial">Multiracial</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="ethnicity" value="other" id="other" @if(old('ethnicity') == 'other') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="other">Other</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="ethnicity" value="all-ethnicity" id="allEthnicity" @if(old('ethnicity') == 'all-ethnicity') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="allEthnicity">All Ethnicity</label></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lablel class="label">Age Range (Optional)</lablel>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="checkbox" name="age_range" value="18-20" id="18-20" @if(old('age_range') == '18-20') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="18-20">18-20</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="age_range" value="21-29" id="21-29" @if(old('age_range') == '21-29') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="21-29">21-29</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="age_range" value="30-39" id="30-39" @if(old('age_range') == '30-39') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="30-39">30-39</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="age_range" value="40-54" id="40-54" @if(old('age_range') == '40-54') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="40-54">40-54</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="age_range" value="55plus" id="55plus" @if(old('age_range') == '55plus') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="55plus">55+</label></span>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="age_range" value="all-ages" id="allAges" @if(old('age_range') == 'all-ages') checked @endif>
                                            <span class="mx-2"><label class="form-check-label" for="allAges">All Ages</label></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div id="questionsField">
                                <div class="form-group border p-3 bg-gradient-light rounded" data-qid="q1">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Q1</h5>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button class="btn"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                    <div class="question-title mb-3">
                                        <textarea name="question_name" class="form-control" placeholder="Please Add A Question Name Here....." rows="1" ></textarea>
                                    </div>
                                    <div class="question-body">
                                       <div class="d-flex align-items-center">
                                           <select name="question_type" class="form-control question_type" id="questionType">
                                               <option label="Radio (Singe Select)" value="radio" id="questionTypeRadio">Radio (Singe Select)</option>
                                               <option label="Checkbox (Multi select)" value="checkbox" id="questionTypeCheckbox">Checkbox (Multi select)</option>
                                               <option label="Multi-line text box" value="text-area" id="questionTypeTextarea">Multi-line text box</option>
                                               <option label="Single-line text box" value="input-text" id="questionTypeTextbox">Single-line text box</option>
                                               <option label="Number box" value="input-number" id="questionTypeNumber">Number box</option>
                                               <option label="Slider (number selector)" value="input-slider" id="questionTypeSlider">Slider (number selector)</option>
                                           </select>
                                           <div class="d-flex mx-2">
                                               <input type="checkbox" name="req" id="requiredCheck" class="mx-2">
                                               <label class="mb-0" for="requiredCheck">Required</label>
                                           </div>
                                       </div>
                                        <div id="answer">

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-success" id="addQuestion">Add Question</button>
                            </div>
                        </div>
                        <div class="form-section">
                            <label for="">Address:</label>
                            <textarea name="address" class="form-control mb-3" cols="30" rows="5" required></textarea>
                        </div>
                        <div class="form-navigation mt-3">
                            <button type="button" class="previous btn btn-primary float-left"><span class="mr-2"><i class="fas fa-chevron-left"></i></span> Previous</button>
                            <button type="button" class="next btn btn-primary float-right">Next <span class="ml-2"><i class="fas fa-chevron-right"></i></span></button>
                            <button type="submit" class="btn btn-success float-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extraJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#required_time_range').on('input', function (){
            let range = $(this).val();
            $('#required_time').val(range);
        });
        $('#target_participant_range').on('input', function (){
            let range = $(this).val();
            $('#target_participant').val(range);
        });
        $('#internal_name').on('keyup', function (){
            let name = $(this).val();
            if (name !== ""){
                $('#main_title').html(name);
            }else {
                $('#main_title').html('Project Title');
            }



        });
        $(function(){
            var $sections=$('.form-section');

            function navigateTo(index){

                $sections.removeClass('current').eq(index).addClass('current');

                $('.form-navigation .previous').toggle(index>0);
                var atTheEnd = index >= $sections.length - 1;
                $('.form-navigation .next').toggle(!atTheEnd);
                $('.form-navigation [Type=submit]').toggle(atTheEnd);


                const step= document.querySelector('.step'+index);
                step.style.backgroundColor="#092D5F";
                step.style.color="white";
            }

            function curIndex(){
                return $sections.index($sections.filter('.current'));
            }

            $('.form-navigation .previous').click(function(){
                navigateTo(curIndex() - 1);

                const curOldIndex = curIndex()+1;
                const backStep= document.querySelector('.step'+curOldIndex);
                backStep.style.backgroundColor="#fff";
                backStep.style.color="#858796";
            });

            $('.form-navigation .next').click(function(){
                $('.new-project-form').parsley().whenValidate({
                    group:'block-'+curIndex()
                }).done(function(){
                    navigateTo(curIndex()+1);
                });
            });

            $sections.each(function(index,section){
                $(section).find(':input').attr('data-parsley-group','block-'+index);
            });

            navigateTo(0);

        });


    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"
            integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.chosen-select').chosen({
            max_selected_options: 5
        }).change(function(obj, result) {
            console.debug("changed: %o", arguments);
            // console.log("selected: " + result.selected);
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
    <script>
        $(document).ready(function (){
            let questionType = $('#questionType').val();
            if(questionType == 'radio'){
                questionTypeRadio();
            }else if(questionType == 'checkbox'){
                questionTypeCheckbox();
            }else if(questionType == 'text-area'){
                $('#answer').html('');
                $('#requiredCheck').attr('checked', true);
            }else if(questionType == 'input-text'){
                $('#answer').html('');
                $('#requiredCheck').attr('checked', true);
            }else if(questionType == 'input-number'){
                $('#answer').html('');
                $('#requiredCheck').attr('checked', true);
            }else if(questionType == 'input-slider'){
                questionTypeSlide();
            }
        });
        $('#questionType').on('change', function (){

            let questionType = $(this).val();
            if(questionType == 'radio'){
                questionTypeRadio();
            }else if(questionType == 'checkbox'){
                questionTypeCheckbox();
            }else if(questionType == 'text-area'){
                $('#answer').html('');
                $('#requiredCheck').attr('checked', true);
            }else if(questionType == 'input-text'){
                $('#answer').html('');
                $('#requiredCheck').attr('checked', true);
            }else if(questionType == 'input-number'){
                $('#answer').html('');
                $('#requiredCheck').attr('checked', true);
            }else if(questionType == 'input-slider'){
                questionTypeSlide();
            }
        });
        function questionTypeRadio(){
            let show = '<div class="radio-answer pt-2">\
                <div class="row align-items-center py-2">\
                <div class="col-1">\
                <p class="serial_nom m-0">1</p>\
        </div>\
            <div class="col-7">\
                <input type="text" class="form-control" placeholder="Answer" required>\
            </div>\
            <div class="col-3">\
                <select name="qualify-or-not" class="form-control" id="">\
                    <option value="qualify" selected>Qualify</option>\
                    <option value="disqualify">Disqualify</option>\
                </select>\
            </div>\
            <div class="col-1 text-right">\
                <button class="btn btn-danger remove "><i class="fas fa-trash-alt"></i></button>\
            </div>\
        </div>\
            <div class="row align-items-center py-2">\
                <div class="col-1">\
                    <p class="serial_nom m-0">2</p>\
                </div>\
                <div class="col-7">\
                    <input type="text" class="form-control" placeholder="Answer" required>\
                </div>\
                <div class="col-3">\
                    <select name="qualify-or-not" class="form-control" id="">\
                        <option value="qualify" selected>Qualify</option>\
                        <option value="disqualify">Disqualify</option>\
                    </select>\
                </div>\
                <div class="col-1 text-right">\
                    <button class="btn btn-danger remove "><i class="fas fa-trash-alt"></i></button>\
                </div>\
            </div>\
            <button class="btn btn-primary" id="addAnswer"><i class="fas fa-plus mr-2"></i> Answer</button>\
        </div>';
            $('#answer').html(show);
        }
        function questionTypeCheckbox(){
            let show ='<div class="checkbox-answer pt-2">\
                <div class="row align-items-center py-2">\
                <div class="col-1">\
                <p class="serial_nom m-0">1</p>\
        </div>\
            <div class="col-7">\
                <input type="text" class="form-control" placeholder="Answer" required>\
            </div>\
            <div class="col-3">\
                <select name="qualify-or-not" class="form-control" id="">\
                    <option value="may-select" selected>May Select</option>\
                    <option value="must-select">Must Select</option>\
                    <option value="disqualify">Disqualify</option>\
                </select>\
            </div>\
            <div class="col-1 text-right">\
                <button class="btn btn-danger remove "><i class="fas fa-trash-alt"></i></button>\
            </div>\
        </div>\
            <div class="row align-items-center py-2">\
                <div class="col-1">\
                    <p class="serial_nom m-0">2</p>\
                </div>\
                <div class="col-7">\
                    <input type="text" class="form-control" placeholder="Answer" required>\
                </div>\
                <div class="col-3">\
                    <select name="qualify-or-not" class="form-control" id="">\
                        <option value="may-select" selected>May Select</option>\
                        <option value="must-select">Must Select</option>\
                        <option value="disqualify">Disqualify</option>\
                    </select>\
                </div>\
                <div class="col-1 text-right">\
                    <button class="btn btn-danger remove "><i class="fas fa-trash-alt"></i></button>\
                </div>\
            </div>\
            <button class="btn btn-primary" id="addAnswer"><i class="fas fa-plus mr-2"></i> Answer</button>\
        </div>';
            $('#answer').html(show);
        }
        function questionTypeSlide(){
            let show  = '<div class="text-area-answer pt-2">\
                <div class="row align-items-center py-2">\
                <div class="col-4">\
                <label for="" class="col-form-label">Min Value</label>\
            <input type="number" name="min-value" class="form-control" required>\
            </div>\
            <div class="col-4">\
                <label for="" class="col-form-label">Max Value</label>\
                <input type="number" name="max-value" class="form-control" required>\
            </div>\
            <div class="col-4">\
                <label for="" class="col-form-label">Step</label>\
                <input type="number" name="steps" class="form-control">\
            </div>\
        </div>\
        </div>';
            $('#answer').html(show);
        }


        $('#addQuestion').on('click', function (){
            let q = '<div class="form-group border p-3 bg-gradient-light rounded" data-qid="q2">\
                <div class="row">\
                <div class="col-6">\
                <h5>Q1</h5>\
        </div>\
            <div class="col-6 text-right">\
                <button type="button" class="btn remove-this" data-remove="q2"><i class="fas fa-trash-alt"></i></button>\
            </div>\
        </div>\
            <div class="question_title mb-3">\
                <textarea name="question_name" class="form-control" placeholder="Please Add A Question Name Here....." rows="1" ></textarea>\
            </div>\
            <div class="question_body">\
                <div class="d-flex align-items-center">\
                    <select name="question_type" class="form-control question_type">\
                        <option label="Radio (Singe Select)" value="radio">Radio (Singe Select)</option>\
                        <option label="Checkbox (Multi select)" value="checkbox">Checkbox (Multi select)</option>\
                        <option label="Multi-line text box" value="text-area">Multi-line text box</option>\
                        <option label="Single-line text box" value="input-text">Single-line text box</option>\
                        <option label="Number box" value="input-number">Number box</option>\
                        <option label="Slider (number selector)" value="input-slider">Slider (number selector)</option>\
                    </select>\
                    <div class="d-flex mx-2">\
                        <input type="checkbox" name="" id="requiredCheck" class="mx-2">\
                            <label class="mb-0" for="requiredCheck">Required</label>\
                    </div>\
                </div>\
            </div>\
        </div>'
            $('#questionsField').append(q);
        });
    </script>
@endsection
