@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Create New Project')
@section('extraCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
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
            <form action="{{ route('project.store') }}" method="post" class="new-project-form">
                @csrf
                <div class="card">
                <div class="card-header bg-dark-blue">
                    <h5 class="text-light mb-0" id="main_title">Project Title</h5>
                </div>
                <div class="card-body">
                    <div class="nav nav-fill my-2">
                        <label class="nav-link shadow-sm step0 border rounded mx-2">Details</label>
                        <label class="nav-link shadow-sm step1 border rounded mx-2">Audience</label>
                        <label class="nav-link shadow-sm step2 border rounded mx-2">Questions</label>
                        <label class="nav-link shadow-sm step3 border rounded mx-2">Summery</label>
                    </div>
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
                                            <input type="radio" name="audience" class="target-audience" id="targetB2b" value="b2b">
                                            <span class="mx-2"><label for="targetB2b">Industry Professionals (B2B)</label></span>
                                        </div>
                                        <div class="">
                                            <input type="radio" name="audience" class="target-audience" id="targetB2c" value="b2c" required>
                                            <span class="mx-2"><label for="targetB2c">Population (B2C)</label></span>
                                        </div>
                                        <div id="projectTopic" style="display: none">
                                            <p class="pt-2" title="Required">Project Topic <span class="text-danger">(Max:2) *</span></p>
                                            <select name="project_topic[]" class="topic-select form-control" multiple >
                                                <option value="arts-and-entertainment">Arts & Entertainment</option>
                                                <option value="automobile-and-vehicles">Automobile & Vehicles</option>
                                                <option value="beauty">Beauty</option>
                                                <option value="business">Business</option>
                                                <option value="computer-and-electronics">Computer & Electronics</option>
                                                <option value="education">Education</option>
                                                <option value="family-and-relationships">Family & Relationships</option>
                                                <option value="finance">Finance</option>
                                                <option value="food-and-drink">Food & Drink</option>
                                                <option value="games">Games</option>
                                                <option value="health-and-wellness">Health & Wellness</option>
                                                <option value="home-and-garden">Home & Garden</option>
                                                <option value="information-technology">Information Technology</option>
                                                <option value="law-and-government">Law & Government</option>
                                                <option value="other">Other</option>
                                                <option value="pets-and-animals">Pets & Animals</option>
                                                <option value="real-estate">Real Estate</option>
                                                <option value="science">Science</option>
                                                <option value="shopping">Shopping</option>
                                                <option value="social-media">Social Media</option>
                                                <option value="sports-and-outdoors">sports & outdoors</option>
                                                <option value="travel">Travel</option>
                                            </select>
                                            <p class="font-13 pt-2">Tagging your projects with topics will better help match your general population project with participants that have indicated interest in these topics. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="Required">Type of Research <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="">
                                            <input type="radio" name="research_type" value="remote" id="typeRemote">
                                            <span class="mx-2"><label for="typeRemote">Remote</label></span>
                                        </div>
                                        <div class="">
                                            <input type="radio" name="research_type" value="in-person" id="typeInPerson" required>
                                            <span class="mx-2"><label for="typeInPerson">In-Person</label></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="Optional">Research Methodology (Optional)</lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <select name="research_method" class="form-control">
                                            <option value="">Select Research Method</option>
                                            <option value="one-on-one">One-on-One</option>
                                            <option value="focus-group">Focus Group</option>
                                            <option value="unmoderated-study">Unmoderated Study</option>
                                            <option value="survey">Survey</option>
                                            <option value="diary-study">Diary Study</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <hr class="my-30">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="Required">Time Required (<span class="text-danger">Minutes</span>)</lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="number" name="required_time" class="form-control" placeholder="Time Required in Minute(s)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="Required">Incentive (<span class="text-danger">Min: $5 - Max: $1000</span>)</lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="d-md-flex">
                                            <input type="number" name="incentive" id="incentive" min="5" max="1000" value="5" class="form-control w-50 my-2 my-md-0 mr-3" placeholder="Total Incentive" readonly="readonly">
                                            <input type="range" id="incentive_range" min="5" max="1000" step="5" value="5" class="form-control-range">
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
                                        <input type="number" name="target_participant" id="target_participant" min="1" max="50" value="1" class="form-control w-50 my-2 my-md-0 mr-3" placeholder="Total Incentive" readonly="readonly">
                                        <input type="range" id="target_participant_range" min="1" max="50" step="1" value="1" class="form-control-range" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">
                                    <lable class="label">Industries <span class="text-danger">(Max:5) *</span></lable>
                                </div>
                                <div class="col-lg-9">
                                    <select name="industry[]" class="industry-select form-control" multiple required>
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
                                    <lable class="label">Company Size (Optional)</lable>
                                </div>
                                <div class="col-lg-9">
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="self-employed" id="self-employed" @if (old('company_size') == 'self-employed') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="self-employed">Self Employed</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="1to10" id="1to10" @if (old('company_size') == '1to10') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="1to10">1 - 10</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="11to50" id="11to50" @if (old('company_size') == '11to50') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="11to50">11 - 50</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="51to200" id="51to200" @if (old('company_size') == '51to200') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="51to200">51 - 200</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="201to500" id="201to500" @if (old('company_size') == '201to500') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="201to500">201 - 500</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="501to1000" id="501to1000" @if (old('company_size') == '501to1000') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="501to1000">501 - 1,000</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="1001to5000" id="1001to5000" @if (old('company_size') == '1001to5000') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="1001to5000">1,001 - 5,000</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="5001to10000" id="5001to10000" @if (old('company_size') == '5001to10000') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="5001to10000">5,001 - 10,000</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="10000plus" id="10000plus" @if (old('company_size') == '10000plus') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="10000plus">10,000+</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="" id="allCompanySize" @if (old('company_size') == 'allCompanySize') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="allCompanySize">All Company Sizes</label></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-30">
                        <div class="form-group all-locations">
                            <div class="row">
                                <div class="col-lg-3">
                                    <lable class="label">Location (Optional)</lable>
                                </div>
                                <div class="col-lg-9">
                                    <div class="location-container">
                                    </div>
                                    <button class="btn btn-primary my-2 add-location">Add City</button>
                                </div>
                            </div>
                        </div>
                        <hr class="my-30">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">
                                    <lable class="label">Skills</lable>
                                </div>
                                <div class="col-lg-9">
                                    <p class="font-13">Select up to 25 skills, knowledge areas, tools and/or certifications you would like to target </p>
                                    <select name="skills[]"  class="form-control w-100 skills-box" multiple="multiple"></select>
                                    @error('skills')
                                    <p class="text-danger font-13 py-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">
                                    <lablel class="label">Household Income (Optional)</lablel>
                                </div>
                                <div class="col-lg-9">
                                    <div class="">
                                        <input type="checkbox" name="household_income[]" value="less20000" id="less20000" @if (old('household_income') == 'less20000') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="less20000">Less than $20,000</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="household_income[]" value="20000to34999" id="20000to34999" @if (old('household_income') == '20000to34999') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="20000to34999">$20,000 – $34,999</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="household_income[]" value="35000to49999" id="35000to49999" @if (old('household_income') == '35000to49999') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="35000to49999">$35,000– $49,999</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="household_income[]" value="50000to74999" id="50000to74999" @if (old('household_income') == '50000to74999') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="50000to74999">$50,000 – $74,999</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="household_income[]" value="75000to99999" id="75000to99999" @if (old('household_income') == '75000to99999') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="75000to99999">$75,000 - $99,999</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="household_income[]" value="100000plus" id="100000plus" @if (old('household_income') == '100000plus') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="100000plus">$100,000 +</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="household_income[]" value="" id="allHouseholeIncome" @if (old('household_income') == 'allHouseholeIncome') checked @endif>
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
                                        <input type="checkbox" name="gender[]" value="male" id="male" @if (old('gender') == 'male') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="male">Male</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="gender[]" value="female" id="female" @if (old('gender') == 'female') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="female">Female</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="gender[]" value="non-binary" id="non-binary" @if (old('gender') == 'non-binary') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="non-binary">Non Binary</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="gender[]" value="prefer-not-to-say" id="prefer-not-to-say" @if (old('gender') == 'prefer-not-to-say') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="prefer-not-to-say">Prefer Not To Say</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="gender[]" value="" id="allGender">
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
                                        <input type="checkbox" name="education_level[]" value="less-than-a-high-school-diploma" id="less-than-a-high-school-diploma" @if (old('education_level') == 'less-than-a-high-school-diploma') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="less-than-a-high-school-diploma">Less Than a High School Diploma</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="high-school-diploma-or-equivalent" id="high-school-diploma-or-equivalent" @if (old('education_level') == 'high-school-diploma-or-equivalent') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="high-school-diploma-or-equivalent">High School Diploma or Equivalent</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="some-college-no-degree" id="some-college-no-degree" @if (old('education_level') == 'some-college-no-degree') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="some-college-no-degree">Some College No Degree</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="associate-degree" id="associate-degree" @if (old('education_level') == 'associate-degree') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="associate-degree">Associate Degree</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="bachelors-degree" id="bachelors-degree" @if (old('education_level') == 'bachelors-degree') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="bachelors-degree">Bachelor's Degree</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="masters-degree" id="masters-degree" @if (old('education_level') == 'masters-degree') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="masters-degree">Master's Degree</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="professional-degree" id="professional-degree" @if (old('education_level') == 'professional-degree') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="professional-degree">Professional Degree</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="doctorate" id="doctorate" @if (old('education_level') == 'doctorate') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="doctorate">Doctorate</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="" id="allEducationLevels">
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
                                        <input type="checkbox" name="ethnicity[]" value="american-indian-or-alaska-native" id="american-indian-or-alaska-native" @if(old('ethnicity') == 'american-indian-or-alaska-native') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="american-indian-or-alaska-native">American Indian / Alaskan Native</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="asian" id="asian" @if(old('ethnicity') == 'asian') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="asian">Asian</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="white-caucasian" id="white-caucasian" @if(old('ethnicity') == 'white-caucasian') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="white-caucasian">White/Caucasian</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="pacific-islander" id="pacific-islander" @if(old('ethnicity') == 'pacific-islander') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="pacific-islander">Pacific Islander</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="african-american" id="african-american" @if(old('ethnicity') == 'african-american') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="african-american">African American</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="hispanic" id="hispanic" @if(old('ethnicity') == 'hispanic') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="hispanic">Hispanic</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="multiracial" id="multiracial" @if(old('ethnicity') == 'multiracial') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="multiracial">Multiracial</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="other" id="other" @if(old('ethnicity') == 'other') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="other">Other</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="" id="allEthnicity" @if(old('ethnicity') == 'all-ethnicity') checked @endif>
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
                                        <input type="checkbox" name="age_range[]" value="18-20" id="18-20" @if(old('age_range') == '18-20') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="18-20">18-20</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="age_range[]" value="21-29" id="21-29" @if(old('age_range') == '21-29') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="21-29">21-29</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="age_range[]" value="30-39" id="30-39" @if(old('age_range') == '30-39') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="30-39">30-39</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="age_range[]" value="40-54" id="40-54" @if(old('age_range') == '40-54') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="40-54">40-54</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="age_range[]" value="55plus" id="55plus" @if(old('age_range') == '55plus') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="55plus">55+</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="age_range[]" value="" id="allAges" @if(old('age_range') == 'all-ages') checked @endif>
                                        <span class="mx-2"><label class="form-check-label" for="allAges">All Ages</label></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div id="questionsField"></div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success" id="addQuestion">Add Question</button>
                        </div>
                    </div>
                    <div class="form-section">
                        <div class="row">
                            <div class="col-12 col-lg-8 offset-lg-2 shadow rounded p-4 my-3">
                                <div class="row">
                                    <div class="col-md-4"><b>Total Incentive</b></div>
                                    <div class="col-md-8 text-right">
                                        <p class="m-0">$<span id="totalIncentive"></span> USD</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><b>Total Service Fees</b></div>
                                    <div class="col-md-8 text-right">
                                        <p class="m-0">$<span id="totalServiceFrees"></span> USD</p>
                                    </div>
                                </div>

                                <hr class="py-30">
                                <div class="row">
                                    <div class="col-md-4"><h4><b>Total Cost</b></h4></div>
                                    <div class="col-md-8 text-right">
                                        <h4 class="m-0"><b>$<span id="totalCost"></span> USD</b></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-navigation mt-3">
                        <button type="button" class="previous btn btn-primary float-left"><span class="mr-2"><i class="fas fa-chevron-left"></i></span> Previous</button>
                        <button type="button" class="next btn btn-primary float-right">Next <span class="ml-2"><i class="fas fa-chevron-right"></i></span></button>
                        <button type="submit" class="btn btn-success float-right">Publish</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
@section('extraJs')
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
    <script src="{{ asset('backend/js/parsley.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name="company_size[]"]').click(function() {
                if ($(this).index('input[name="company_size[]"]') === 9) {
                $('input[name="company_size[]"]').not(this).prop('checked', false);
                } else {
                $('input[name="company_size[]"]').eq(9).prop('checked', false);
                }
            });
            $('input[name="household_income[]"]').click(function() {
                if ($(this).index('input[name="household_income[]"]') === 6) {
                $('input[name="household_income[]"]').not(this).prop('checked', false);
                } else {
                $('input[name="household_income[]"]').eq(6).prop('checked', false);
                }
            });
            $('input[name="gender[]"]').click(function() {
                if ($(this).index('input[name="gender[]"]') === 4) {
                $('input[name="gender[]"]').not(this).prop('checked', false);
                } else {
                $('input[name="gender[]"]').eq(4).prop('checked', false);
                }
            });
            $('input[name="education_level[]"]').click(function() {
                if ($(this).index('input[name="education_level[]"]') === 8) {
                $('input[name="education_level[]"]').not(this).prop('checked', false);
                } else {
                $('input[name="education_level[]"]').eq(8).prop('checked', false);
                }
            });
            $('input[name="ethnicity[]"]').click(function() {
                if ($(this).index('input[name="ethnicity[]"]') === 8) {
                $('input[name="ethnicity[]"]').not(this).prop('checked', false);
                } else {
                $('input[name="ethnicity[]"]').eq(8).prop('checked', false);
                }
            });
            $('input[name="age_range[]"]').click(function() {
                if ($(this).index('input[name="age_range[]"]') === 5) {
                $('input[name="age_range[]"]').not(this).prop('checked', false);
                } else {
                $('input[name="age_range[]"]').eq(5).prop('checked', false);
                }
            });
            $('.topic-select').select2({
                maximumSelectionLength: 2,
                placeholder: "Select Maximum 2 Topics",
                allowClear: true,

            });
            $('.industry-select').select2({
                maximumSelectionLength: 5,
                placeholder: "Select Maximum 5 Industries",
                allowClear: true,

            });

            $('.skills-box').select2({
                minimumInputLength: 2,
                maximumSelectionLength: 25,
                delay: 250,
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
            })
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
                if (curIndex() == 3){
                    let incentive =  $('#incentive_range').val();
                    let participant =  $('#target_participant_range').val();

                    let totalIncentive = (incentive*participant);
                    let serviceFree = (totalIncentive/2);
                    let totalCost = (totalIncentive+serviceFree);

                    $("#totalIncentive").html(totalIncentive);
                    $("#totalServiceFrees").html(serviceFree);
                    $("#totalCost").html(totalCost);
                }
            });
            $sections.each(function(index,section){
                $(section).find(':input').attr('data-parsley-group','block-'+index);
            });
            navigateTo(0);
        });

        $('#incentive_range').on('input', function (){
            let range = $(this).val();
            $('#incentive').val(range);
        });
        $('#target_participant_range').on('input', function (){
            let targetRange = $(this).val();
            $('#target_participant').val(targetRange);
        });
        $('#internal_name').on('keyup', function (){
            let name = $(this).val();
            if (name !== ""){
                $('#main_title').html(name);
            }else {
                $('#main_title').html('Project Title');
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            let addLocation = $(".add-location");
            let locationContainer = $(".location-container");


            function populateStateOptions(selectElement) {
                for (const state in usStateAndCity) {
                    const option = $("<option></option>").val(state).text(state);
                    selectElement.append(option);
                }
            }

            // Function to populate the city select options based on the selected state
            function populateCityOptions(selectElement, selectedState) {
                const cities = usStateAndCity[selectedState];

                // Clear city select options
                selectElement.empty();

                // Add default option for city select
                const defaultOption = $("<option></option>").val("").text("Select City");
                selectElement.append(defaultOption);

                // Populate city select options
                for (const city of cities) {
                    const option = $("<option></option>").val(city).text(city);
                    selectElement.append(option);
                }
            }

            // Function to create a new location set
            function createLocationSet() {
                const locationDiv = $("<div class='location d-flex justify-content-between my-2'></div>");
                const country = $("<input class='form-control mx-1' placeholder='US' disabled='disabled' readonly='readonly'>")
                const stateSelect = $("<select class='states form-control mx-1'></select>");
                const citySelect = $("<select class='cities form-control mx-1' name='city[]' required></select>");
                const deleteButton = $("<button class='btn btn-danger deleteLocation ml-1'><i class='fas fa-trash-alt'></i></button>");

                // Populate state select options
                populateStateOptions(stateSelect);

                // Event handler for the state select change event
                stateSelect.on("change", function() {
                    const selectedState = $(this).val();
                    populateCityOptions(citySelect, selectedState);
                });

                locationDiv.append(country);
                locationDiv.append(stateSelect);
                locationDiv.append(citySelect);
                locationDiv.append(deleteButton);
                locationContainer.append(locationDiv);

                // Automatically select the first state and populate the city options
                const firstState = stateSelect.find("option:first").val();
                stateSelect.val(firstState).trigger("change");
            }

            // Event handler for the "add location" button click
            addLocation.on("click", function() {
                createLocationSet();
            });
            // Event delegation for the delete button click
            locationContainer.on("click", ".deleteLocation", function() {
                $(this).closest(".location").remove();
            });

        });
        let usStateAndCity = @json($us_states);
    </script>
    <script>
        $('.target-audience').on('click', function (){
            if($(this).val() == 'b2c'){
                $('#projectTopic').show();
                $('select.chosen-topic-select').attr('required', true);

            }else{
                $('#projectTopic').hide('')
                $('select.chosen-topic-select').attr('required', false);
            }
        });


        $('#addQuestion').on('click', function (){
            let question = '<div class="form-group border p-3 bg-gradient-light rounded" data-qid="q'+qnum+'">\
                <div class="row">\
                <div class="col-6">\
                <h5>Q'+qnum+'</h5>\
        </div>\
            <div class="col-6 text-right">\
                <button class="btn"><i class="fas fa-trash-alt"></i></button>\
            </div>\
        </div>\
            <div class="question-title mb-3">\
                <textarea name="question_name['+qnum+'][]" class="form-control" placeholder="Please Add A Question Name Here....." rows="1" required></textarea>\
            </div>\
            <div class="question-body">\
                <div class="d-flex align-items-center">\
                    <select name="question_type['+qnum+'][]" class="form-control question_type" data-typeid="'+qnum+'" required>\
                        <option value="" id="">Select a Type</option>\
                        <option value="radio">Radio (Singe Select)</option>\
                        <option value="checkbox">Checkbox (Multi select)</option>\
                        <option value="textarea">Multi-line text box</option>\
                        <option value="text">Single-line text box</option>\
                        <option value="number">Number box</option>\
                        <option value="slider">Slider (number selector)</option>\
                    </select>\
                    <div class="d-flex mx-2">\
                        <input type="checkbox" name="required['+qnum+'][]" id="requiredCheck'+qnum+'" class="mx-2">\
                            <label class="mb-0" for="requiredCheck'+qnum+'">Required</label>\
                    </div>\
                </div>\
                <div id="answer'+qnum+'">\
                </div>\
            </div>\
        </div>';

            $('#questionsField').append(question);
            qnum +=1;

        });
        $('#questionsField').on('change', '.question_type', function (){
            changeQuestionType( $(this) );
        });
        function changeQuestionType( $this ){
            let questionTypeId = $this.data('typeid');
            console.log( $this.val() );

            if($this.val() == 'radio' ){
                questionTypeRadio( questionTypeId );
                $('#requiredCheck'+ questionTypeId).attr('checked', true);
            }else if($this.val() == 'checkbox'){
                questionTypeCheckbox( questionTypeId );
                $('#requiredCheck'+ questionTypeId).attr('checked', true);
            }else if($this.val() == 'textarea'){
                $('#answer'+ questionTypeId).html('');
                $('#requiredCheck'+ questionTypeId).attr('checked', true);
            }else if($this.val() == 'text'){
                $('#answer'+ questionTypeId).html('');
                $('#requiredCheck'+ questionTypeId).attr('checked', true);
            }else if($this.val() == 'number'){
                $('#answer'+ questionTypeId).html('');
                $('#requiredCheck'+ questionTypeId).attr('checked', true);
            }else if($this.val() == 'slider'){
                questionTypeSlide(questionTypeId);
                $('#requiredCheck'+ questionTypeId).attr('checked', true);
            }else if($this.val() == ""){
                $('#answer'+ questionTypeId).html('');
                $('#requiredCheck'+ questionTypeId).attr('checked', false);
            }
        }
        function questionTypeRadio( id ){
            let show = '<div class="radio-answer pt-2" id="radioAnswer'+ id +'">\
                <div class="row align-items-top py-2 radioAnswerItem'+id+'">\
                <div class="col-1">\
                <p class="serial_nom m-0">1</p>\
                </div>\
                    <div class="col-7">\
                        <input type="text" name="answer['+ id +'][]" class="form-control" placeholder="Answer" required>\
                    </div>\
                    <div class="col-3">\
                        <select name="answer_qualify['+ id +'][]" class="form-control" id="" required>\
                            <option value="qualify" selected>Qualify</option>\
                            <option value="disqualify">Disqualify</option>\
                        </select>\
                    </div>\
                    <div class="col-1 text-right">\
                    </div>\
                </div>\
                <div class="row align-items-top py-2 radioAnswerItem'+id+'">\
                    <div class="col-1">\
                        <p class="serial_nom m-0">2</p>\
                    </div>\
                    <div class="col-7">\
                        <input type="text" name="answer['+ id +'][]" class="form-control" placeholder="Answer" required>\
                    </div>\
                    <div class="col-3">\
                        <select name="answer_qualify['+ id +'][]" class="form-control" id="" required>\
                            <option value="qualify" selected>Qualify</option>\
                            <option value="disqualify">Disqualify</option>\
                        </select>\
                    </div>\
                    <div class="col-1 text-right">\
                    </div>\
                </div>\
            </div>\
            <button class="btn btn-primary addRadioAnswer" data-id="'+ id +'"><i class="fas fa-plus mr-2"></i> Answer</button>';
            $('#answer'+ id).html(show);
        }
        function questionTypeCheckbox( id ){
            let show ='<div class="checkbox-answer pt-2" id="checkboxAnswer'+ id +'">\
                <div class="row align-items-top py-2 checkboxAnsweItem="'+ id +'">\
                <div class="col-1">\
                <p class="serial_nom m-0">1</p>\
        </div>\
            <div class="col-7">\
                <input type="text" class="form-control" name="answer['+id+'][]" placeholder="Answer" required>\
            </div>\
            <div class="col-3">\
                <select name="answer_qualify['+ id +'][]" class="form-control" id="" required>\
                    <option value="may-select" selected>May Select</option>\
                    <option value="must-select">Must Select</option>\
                    <option value="disqualify">Disqualify</option>\
                </select>\
            </div>\
            <div class="col-1 text-right">\
            </div>\
        </div>\
            <div class="row align-items-top py-2">\
                <div class="col-1">\
                    <p class="serial_nom m-0">2</p>\
                </div>\
                <div class="col-7">\
                    <input type="text" class="form-control" name="answer['+id+'][]" placeholder="Answer" required>\
                </div>\
                <div class="col-3">\
                    <select name="answer_qualify['+ id +'][]" class="form-control" id="">\
                        <option value="may-select" selected>May Select</option>\
                        <option value="must-select">Must Select</option>\
                        <option value="disqualify">Disqualify</option>\
                    </select>\
                </div>\
                <div class="col-1 text-right">\
                </div>\
            </div>\
        </div>\
        <button class="btn btn-primary" id="addCheckboxAnswer" data-id="'+ id +'"><i class="fas fa-plus mr-2"></i> Answer</button>';
            $('#answer'+ id).html(show);
        }
        function questionTypeSlide(id){
            let show  = '<div class="text-area-answer pt-2">\
                <div class="row align-items-center py-2">\
                <div class="col-4">\
                <label for="" class="col-form-label" title="required">Min Value <span class="text-danger">*</span></label>\
            <input type="number" name="min-value['+id+'][]" class="form-control" required>\
            </div>\
            <div class="col-4">\
                <label for="" class="col-form-label" title="required">Max Value <span class="text-danger">*</span></label>\
                <input type="number" name="max-value['+id+'][]" class="form-control" required>\
            </div>\
            <div class="col-4">\
                <label for="" class="col-form-label" title="required">Step <span class="text-danger">*</span></label>\
                <input type="number" name="steps['+id+'][]" class="form-control" required>\
            </div>\
        </div>\
        </div>';
            $('#answer'+ id).html(show);
        }

        $('#questionsField').on('click', '.addRadioAnswer', function (){
            let id = $(this).data('id');
            let count = $('#radioAnswer'+ id).children().length;
            $('#radioAnswer'+ id).append('<div class="row align-items-top py-2 radioAnswerItem'+id+'">\
                <div class="col-1">\
                    <p class="serial_nom m-0">'+ ++count +'</p>\
                </div>\
                <div class="col-7">\
                    <input type="text" name="answer['+ id +'][]" class="form-control" placeholder="Answer" required>\
                </div>\
                <div class="col-3">\
                    <select name="answer_qualify['+ id +'][]" class="form-control" id="" required>\
                        <option value="qualify" selected>Qualify</option>\
                        <option value="disqualify">Disqualify</option>\
                    </select>\
                </div>\
                <div class="col-1 text-right">\
                </div>\
            </div>');
        });
        $('#questionsField').on('click', '#addCheckboxAnswer', function (){
            let id = $(this).data('id');
            let count = $('#checkboxAnswer'+ id).children().length;
            $('#checkboxAnswer'+ id).append('<div class="row align-items-top py-2 checkboxAnsweItem="'+ id +'">\
                <div class="col-1">\
                <p class="serial_nom m-0">'+ ++count +'</p>\
        </div>\
            <div class="col-7">\
                <input type="text" class="form-control" name="answer['+id+'][]" placeholder="Answer" required>\
            </div>\
            <div class="col-3">\
                <select name="answer_qualify['+ id +'][]" class="form-control" id="" required>\
                    <option value="may-select" selected>May Select</option>\
                    <option value="must-select">Must Select</option>\
                    <option value="disqualify">Disqualify</option>\
                </select>\
            </div>\
            <div class="col-1 text-right">\
            </div>\
        </div>');
        });
        $("#questionsField").on('click', '.radioAnswerRemove', function () {
            let rowId = $(this).data('radioanswerid');
            let fieldId = $(this).data('fieldid');
            $(this).parents('.radioAnswerItem'+fieldId).remove();
        })

        let qnum = 1;
    </script>

@endsection
