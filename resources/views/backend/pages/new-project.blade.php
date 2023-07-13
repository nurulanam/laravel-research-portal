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
    <div class="row mb-4">
        <div class="col-12">
            <form action="{{ route('project.store') }}" method="post" class="new-project-form">
                @csrf
                <div class="card shadow p-2">
                <div class="card-header bg-dark-blue">
                    <h5 class="text-light mb-0" id="main_title">Project Title</h5>
                </div>
                <div class="card-body">
                    <div class="nav nav-fill my-2">
                        <label class="nav-link shadow-sm step0 border rounded-pill mx-2">Details</label>
                        <label class="nav-link shadow-sm step1 border rounded-pill mx-2">Audience</label>
                        <label class="nav-link shadow-sm step2 border rounded-pill mx-2">Questions</label>
                        <label class="nav-link shadow-sm step3 border rounded-pill mx-2">Summery</label>
                    </div>
                    <div class="form-section">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="required">Internal Project Name <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" name="internal_name" id="internal_name" class="form-control" value="{{ old('internal_name') }}" placeholder="Internal Project Name" required>
                                        @error('internal_name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
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
                                        <input type="text" name="project_title" value="{{ old('project_title') }}" class="form-control" placeholder="Project Title" required>
                                        @error('project_title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="required">Project Details <span class="text-danger">*</span></lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <textarea name="project_details" class="form-control" placeholder="Project Full Details" rows="5" required>{{ old('project_details') }}</textarea>
                                        @error('project_details')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
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
                                            <input type="radio" name="audience" class="target-audience" id="targetB2b" @if (old('audience') == 'b2b') checked value="{{ old('audience') }}" @else value="b2b" @endif>
                                            <span class="mx-2"><label for="targetB2b">Industry Professionals (B2B)</label></span>
                                        </div>
                                        <div class="">
                                            <input type="radio" name="audience" class="target-audience" id="targetB2c" @if (old('audience') == 'b2c') checked value="{{ old('audience') }}" @else value="b2c" @endif required>
                                            <span class="mx-2"><label for="targetB2c">Population (B2C)</label></span>
                                        </div>
                                        @error('audience')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <div id="projectTopic" style="display: none">
                                            <p class="pt-2" title="Required">Project Topic <span class="text-danger">(Max:2) *</span></p>
                                            <select name="project_topic[]" class="topic-select form-control" multiple disabled>
                                                <option value="arts-and-entertainment" {{ in_array('arts-and-entertainment', old('project_topic', [])) ? 'selected' : '' }}>Arts & Entertainment</option>
                                                <option value="automobile-and-vehicles" {{ in_array('automobile-and-vehicles', old('project_topic', [])) ? 'selected' : '' }}>Automobile & Vehicles</option>
                                                <option value="beauty" {{ in_array('beauty', old('project_topic', [])) ? 'selected' : '' }}>Beauty</option>
                                                <option value="business" {{ in_array('business', old('project_topic', [])) ? 'selected' : '' }}>Business</option>
                                                <option value="computer-and-electronics" {{ in_array('computer-and-electronics', old('project_topic', [])) ? 'selected' : '' }}>Computer & Electronics</option>
                                                <option value="education" {{ in_array('education', old('project_topic', [])) ? 'selected' : '' }}>Education</option>
                                                <option value="family-and-relationships" {{ in_array('family-and-relationships', old('project_topic', [])) ? 'selected' : '' }}>Family & Relationships</option>
                                                <option value="finance" {{ in_array('finance', old('project_topic', [])) ? 'selected' : '' }}>Finance</option>
                                                <option value="food-and-drink" {{ in_array('food-and-drink', old('project_topic', [])) ? 'selected' : '' }}>Food & Drink</option>
                                                <option value="games" {{ in_array('games', old('project_topic', [])) ? 'selected' : '' }}>Games</option>
                                                <option value="health-and-wellness" {{ in_array('health-and-wellness', old('project_topic', [])) ? 'selected' : '' }}>Health & Wellness</option>
                                                <option value="home-and-garden" {{ in_array('home-and-garden', old('project_topic', [])) ? 'selected' : '' }}>Home & Garden</option>
                                                <option value="information-technology" {{ in_array('information-technology', old('project_topic', [])) ? 'selected' : '' }}>Information Technology</option>
                                                <option value="law-and-government" {{ in_array('law-and-government', old('project_topic', [])) ? 'selected' : '' }}>Law & Government</option>
                                                <option value="other" {{ in_array('other', old('project_topic', [])) ? 'selected' : '' }}>Other</option>
                                                <option value="pets-and-animals" {{ in_array('pets-and-animals', old('project_topic', [])) ? 'selected' : '' }}>Pets & Animals</option>
                                                <option value="real-estate" {{ in_array('real-estate', old('project_topic', [])) ? 'selected' : '' }}>Real Estate</option>
                                                <option value="science" {{ in_array('science', old('project_topic', [])) ? 'selected' : '' }}>Science</option>
                                                <option value="shopping" {{ in_array('shopping', old('project_topic', [])) ? 'selected' : '' }}>Shopping</option>
                                                <option value="social-media" {{ in_array('social-media', old('project_topic', [])) ? 'selected' : '' }}>Social Media</option>
                                                <option value="sports-and-outdoors" {{ in_array('sports-and-outdoors', old('project_topic', [])) ? 'selected' : '' }}>sports & outdoors</option>
                                                <option value="travel" {{ in_array('travel', old('project_topic', [])) ? 'selected' : '' }}>Travel</option>
                                            </select>
                                            <p class="font-13 pt-2">Tagging your projects with topics will better help match your general population project with participants that have indicated interest in these topics. </p>
                                            @error('project_topic')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
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
                                            <input type="radio" name="research_type" value="remote" @if(old('research_type') == 'remote') checked @endif id="typeRemote">
                                            <span class="mx-2"><label for="typeRemote">Remote</label></span>
                                        </div>
                                        <div class="">
                                            <input type="radio" name="research_type" value="in-person" @if(old('research_type') == 'in-person') checked @endif id="typeInPerson" required>
                                            <span class="mx-2"><label for="typeInPerson">In-Person</label></span>
                                        </div>
                                        @error('research_type')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
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
                                            <option value="one-on-one" @if(old('research_method') == 'one-on-one') selected @endif>One-on-One</option>
                                            <option value="focus-group" @if(old('research_method') == 'focus-group') selected @endif>Focus Group</option>
                                            <option value="unmoderated-study"@if(old('research_method') == 'unmoderated-study') selected @endif>Unmoderated Study</option>
                                            <option value="survey"@if(old('research_method') == 'survey') selected @endif>Survey</option>
                                            <option value="diary-study"@if(old('research_method') == 'diary-study') selected @endif>Diary Study</option>
                                        </select>
                                        @error('research_method')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        <hr class="my-30">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <lable class="label" title="In Minutes">Time Required (Optional)</lable>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="number" name="required_time" class="form-control" @if(old('required_time')) value="{{ old('required_time') }}" @endif placeholder="Time Required in Minute(s)">
                                        @error('required_time')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
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
                                            <input type="number" name="incentive" id="incentive" min="5" max="1000"  @if(old('incentive')) value="{{ old('incentive') }}" @else value="5" @endif class="form-control w-50 my-2 my-md-0 mr-3" placeholder="Total Incentive" readonly="readonly">
                                            <input type="range" id="incentive_range" min="5" max="1000" step="5" @if(old('incentive')) value="{{ old('incentive') }}" @else value="5" @endif class="form-control-range">
                                        </div>
                                        @error('incentive')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
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
                                        <input type="number" name="target_participant" id="target_participant" min="1" max="50" @if(old('target_participant')) value="{{ old('target_participant') }}" @else value="1" @endif  class="form-control w-50 my-2 my-md-0 mr-3" placeholder="Total Incentive" readonly="readonly">
                                        <input type="range" id="target_participant_range" min="1" max="50" step="1" @if(old('target_participant')) value="{{ old('target_participant') }}" @else value="1" @endif  class="form-control-range" required>
                                    </div>
                                    @error('target_participant')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
                                        @foreach ($industries as $key => $industry)
                                            <option value="{{ $key }}" @if (is_array(old('industry')) && in_array($key, old('industry'))) selected @endif>{{ $industry }}</option>
                                        @endforeach
                                    </select>
                                    @error('industry')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
                                        <input type="checkbox" name="company_size[]" value="self-employed" id="self-employed" {{ in_array('self-employed', old('company_size', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="self-employed">Self Employed</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="1to10" id="1to10" {{ in_array('1to10', old('company_size', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="1to10">1 - 10</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="11to50" id="11to50" {{ in_array('11to50', old('company_size', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="11to50">11 - 50</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="51to200" id="51to200" {{ in_array('51to200', old('company_size', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="51to200">51 - 200</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="201to500" id="201to500" {{ in_array('201to500', old('company_size', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="201to500">201 - 500</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="501to1000" id="501to1000" {{ in_array('501to1000', old('company_size', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="501to1000">501 - 1,000</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="1001to5000" id="1001to5000" {{ in_array('1001to5000', old('company_size', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="1001to5000">1,001 - 5,000</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="5001to10000" id="5001to10000" {{ in_array('5001to10000', old('company_size', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="5001to10000">5,001 - 10,000</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="10000plus" id="10000plus" {{ in_array('10000plus', old('company_size', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="10000plus">10,000+</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="company_size[]" value="" id="allCompanySize" {{ empty(old('company_size')) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="allCompanySize">All Company Sizes</label></span>
                                    </div>
                                    @error('company_size')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
                                    <select name="skills[]"  class="form-control w-100 skills-box" multiple="multiple">

                                    </select>
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
                                        <input type="checkbox" name="household_income[]" value="less20000" id="less20000" {{ in_array('less20000', old('household_income', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="less20000">Less than $20,000</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="household_income[]" value="20000to34999" id="20000to34999" {{ in_array('20000to34999', old('household_income', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="20000to34999">$20,000 – $34,999</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="household_income[]" value="35000to49999" id="35000to49999" {{ in_array('35000to49999', old('household_income', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="35000to49999">$35,000– $49,999</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="household_income[]" value="50000to74999" id="50000to74999" {{ in_array('50000to74999', old('household_income', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="50000to74999">$50,000 – $74,999</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="household_income[]" value="75000to99999" id="75000to99999" {{ in_array('75000to99999', old('household_income', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="75000to99999">$75,000 - $99,999</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="household_income[]" value="100000plus" id="100000plus" {{ in_array('100000plus', old('household_income', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="100000plus">$100,000 +</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="household_income[]" value="" id="allHouseholeIncome" {{ empty(old('household_income')) ? 'checked' : ''  }}>
                                        <span class="mx-2"><label class="form-check-label" for="allHouseholeIncome">All Household Income</label></span>
                                    </div>
                                    @error('household_income')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
                                        <input type="checkbox" name="gender[]" value="male" id="male" {{ in_array('male', old('gender', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="male">Male</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="gender[]" value="female" id="female" {{ in_array('female', old('gender', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="female">Female</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="gender[]" value="non-binary" id="non-binary" {{ in_array('non-binary', old('gender', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="non-binary">Non Binary</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="gender[]" value="prefer-not-to-say" id="prefer-not-to-say" {{ in_array('prefer-not-to-say', old('gender', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="prefer-not-to-say">Prefer Not To Say</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="gender[]" value="" id="allGender" {{ empty(old('gender')) ? 'checked' : ''  }}>
                                        <span class="mx-2"><label class="form-check-label" for="allGender">All Gender</label></span>
                                    </div>
                                    @error('gender')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
                                        <input type="checkbox" name="education_level[]" value="less-than-a-high-school-diploma" id="less-than-a-high-school-diploma" {{ in_array('less-than-a-high-school-diploma', old('education_level', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="less-than-a-high-school-diploma">Less Than a High School Diploma</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="high-school-diploma-or-equivalent" id="high-school-diploma-or-equivalent" {{ in_array('high-school-diploma-or-equivalent', old('education_level', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="high-school-diploma-or-equivalent">High School Diploma or Equivalent</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="some-college-no-degree" id="some-college-no-degree" {{ in_array('some-college-no-degree', old('education_level', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="some-college-no-degree">Some College No Degree</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="associate-degree" id="associate-degree" {{ in_array('associate-degree', old('education_level', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="associate-degree">Associate Degree</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="bachelors-degree" id="bachelors-degree" {{ in_array('bachelors-degree', old('education_level', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="bachelors-degree">Bachelor's Degree</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="masters-degree" id="masters-degree" {{ in_array('masters-degree', old('education_level', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="masters-degree">Master's Degree</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="professional-degree" id="professional-degree" {{ in_array('professional-degree', old('education_level', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="professional-degree">Professional Degree</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="doctorate" id="doctorate" {{ in_array('doctorate', old('education_level', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="doctorate">Doctorate</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="education_level[]" value="" id="allEducationLevels" {{ empty(old('education_level')) ? 'checked' : ''  }}>
                                        <span class="mx-2"><label class="form-check-label" for="allEducationLevels">All Education Levels</label></span>
                                    </div>
                                    @error('education_level')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
                                        <input type="checkbox" name="ethnicity[]" value="american-indian-or-alaska-native" id="american-indian-or-alaska-native" {{ in_array('american-indian-or-alaska-native', old('ethnicity', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="american-indian-or-alaska-native">American Indian / Alaskan Native</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="asian" id="asian" {{ in_array('asian', old('ethnicity', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="asian">Asian</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="white-caucasian" id="white-caucasian" {{ in_array('white-caucasian', old('ethnicity', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="white-caucasian">White/Caucasian</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="pacific-islander" id="pacific-islander" {{ in_array('pacific-islander', old('ethnicity', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="pacific-islander">Pacific Islander</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="african-american" id="african-american" {{ in_array('african-american', old('ethnicity', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="african-american">African American</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="hispanic" id="hispanic" {{ in_array('hispanic', old('ethnicity', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="hispanic">Hispanic</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="multiracial" id="multiracial" {{ in_array('multiracial', old('ethnicity', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="multiracial">Multiracial</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="other" id="other" {{ in_array('other', old('ethnicity', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="other">Other</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="ethnicity[]" value="" id="allEthnicity" {{ empty(old('ethnicity')) ? 'checked' : ''  }}>
                                        <span class="mx-2"><label class="form-check-label" for="allEthnicity">All Ethnicity</label></span>
                                    </div>
                                    @error('ethnicity')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
                                        <input type="checkbox" name="age_range[]" value="18-20" id="18-20" {{ in_array('18-20', old('age_range', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="18-20">18-20</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="age_range[]" value="21-29" id="21-29" {{ in_array('21-29', old('age_range', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="21-29">21-29</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="age_range[]" value="30-39" id="30-39" {{ in_array('30-39', old('age_range', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="30-39">30-39</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="age_range[]" value="40-54" id="40-54" {{ in_array('40-54', old('age_range', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="40-54">40-54</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="age_range[]" value="55plus" id="55plus" {{ in_array('55plus', old('age_range', [])) ? 'checked' : '' }}>
                                        <span class="mx-2"><label class="form-check-label" for="55plus">55+</label></span>
                                    </div>
                                    <div class="">
                                        <input type="checkbox" name="age_range[]" value="" id="allAges">
                                        <span class="mx-2"><label class="form-check-label" for="allAges">All Ages</label></span>
                                    </div>
                                    @error('age_range')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-section">
                        <div id="questionsField">
                            <div class="form-group border p-3 bg-gradient-light rounded full-question" data-qid="q1">
                                <div class="row">
                                    <div class="col-6">
                                        <h5>Q1</h5>
                                    </div>
                                    <div class="col-6 text-right">
{{--                                        <button class="btn"><i class="fas fa-trash-alt"></i></button>--}}
                                    </div>
                                </div>
                                <div class="question-title mb-3">
                                    <textarea name="question_name[1][]" class="form-control" placeholder="Please Add A Question Name Here....." rows="1" required></textarea>
                                </div>
                                <div class="question-body">
                                    <div class="d-flex align-items-center">
                                        <select name="question_type[1][]" class="form-control question_type" data-typeid="1" required>
                                            <option value="" id="">Select a Type</option>
                                            <option value="radio">Radio (Singe Select)</option>
                                            <option value="checkbox">Checkbox (Multi select)</option>
                                            <option value="textarea">Multi-line text box</option>
                                            <option value="text">Single-line text box</option>
                                            <option value="number">Number box</option>
                                            <option value="slider">Slider (number selector)</option>
                                        </select>
                                        <div class="d-flex mx-2">
                                            <input type="checkbox" name="required[1][]" id="requiredCheck1" class="mx-2">
                                            <label class="mb-0" for="requiredCheck1">Required</label>
                                        </div>
                                    </div>
                                    <div id="answer1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success" id="addQuestion">Add Question</button>
                        </div>
                    </div>
                    <div class="form-section" >
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
                                <div class="d-flex justify-content-center">
                                    <select name="status" class="form-control w-25 publish-status rounded-pill" required>
                                        <option value="" class="bg-success text-light" selected>Please Select Status</option>
                                        <option value="draft">Draft</option>
                                        <option value="publish">Publish</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-navigation mt-3">
                        <button type="button" class="previous btn btn-primary btn-custom float-left"><span class="mr-2"><i class="fas fa-chevron-left"></i></span> Previous</button>
                        <button type="button" class="next btn btn-primary btn-custom float-right">Next <span class="ml-2"><i class="fas fa-chevron-right"></i></span></button>

                        <button type="submit" class="btn btn-success mx-1 publish-btn btn-custom float-right">Select Status</button>

                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
@section('extraJs')
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

            }).on('change', function(e) {
                var selectedOptions = $(this).val() || [];
                if (selectedOptions.length > 2) {
                    // Remove extra selections
                    selectedOptions.splice(2);
                    $(this).val(selectedOptions).trigger('change');
                }
            });

            $('.industry-select').select2({
                maximumSelectionLength: 5,
                placeholder: "Select Maximum 5 Industries",
                allowClear: true,

            }).on('change', function(e) {
                var selectedOptions = $(this).val() || [];
                if (selectedOptions.length > 5) {
                    // Remove extra selections
                    selectedOptions.splice(5);
                    $(this).val(selectedOptions).trigger('change');
                }
            });
            setTimeout(function() {
                var selectedSkills = {!! json_encode(old('skills', [])) !!};
                if (!Array.isArray(selectedSkills)) {
                    selectedSkills = [selectedSkills];
                }

                $('.skills-box').select2({
                    minimumInputLength: 2,
                    maximumSelectionLength: 25,
                    delay: 300,
                    ajax: {
                        method: 'POST',
                        url: "{{ route('skills.api') }}",
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        delay: 250,
                        data: function(params) {
                            return {
                                search: params.term
                            };
                        },
                        processResults: function(response) {
                            var options = response.options.map(function(skill) {
                                return { id: skill.skill_name, text: skill.skill_name };
                            });

                            return {
                                results: options
                            };
                        },
                        cache: false
                    }
                });

                // Fetch the data for the selected skills and create options
                var fetchCount = 0;

                function fetchSkillData(skillName) {
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('skills.api') }}",
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: { search: skillName },
                        success: function(response) {
                            console.log(response);
                            var opt = '<option value=\"'+response.options[0].skill_name+'\" selected>'+response.options[0].skill_name+'</option>';
                            $('.skills-box').append(opt).trigger('change');
                            fetchCount++;

                            if (fetchCount === selectedSkills.length) {
                                $('.skills-box').trigger('change');
                            }
                        },
                        error: function() {
                            fetchCount++;
                            if (fetchCount === selectedSkills.length) {
                                $('.skills-box').trigger('change');
                            }
                        }
                    });
                }

                if (selectedSkills.length > 0) {
                    selectedSkills.forEach(function(skillName) {
                        fetchSkillData(skillName);
                    });
                }
            }, 1000); // Delay of 1000 milliseconds (1 second)
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


                    $('.publish-status').on('change', function (){
                        let status = $(this).val();
                        console.log(status);
                        if (status == 'draft'){
                            $('.publish-btn').html('Draft');
                        }else if (status == 'publish'){
                            $('.publish-btn').html('Publish');
                        }else if(status == ""){
                            $('.publish-btn').html('Select Status');
                        }
                    });
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
                const locationDiv = $("<div class='location d-lg-flex justify-content-between my-2'></div>");
                const country = $("<input class='form-control mx-1 my-2 my-lg-0' placeholder='US' disabled='disabled' readonly='readonly'>")
                const stateSelect = $("<select class='states form-control mx-1 my-2 my-lg-0'></select>");
                const citySelect = $("<select class='cities form-control mx-1 my-2 my-lg-0' name='cities[]' required></select>");
                const deleteButton = $("<button class='btn btn-danger deleteLocation ml-1 my-2 my-lg-0'><i class='fas fa-trash-alt'></i></button>");

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
        $(document).ready(function() {
            const audienceValue = $('input[name="audience"].target-audience:checked').val();

            if (audienceValue === 'b2c') {
                $('#projectTopic').show();
                $('select.topic-select').prop('required', true).prop('disabled', false);
            }

            $('input[name="audience"].target-audience').on('click', function() {
                const currentValue = $(this).val();
                if (currentValue === 'b2c') {
                    $('#projectTopic').show();
                    $('select.topic-select').prop('required', true).prop('disabled', false);
                } else {
                    $('#projectTopic').hide();
                    $('select.topic-select').prop('required', false).prop('disabled', true);
                }
            });
        });

        $('#addQuestion').on('click', function (){
            // var itemCount = $('#questionsField').children('.full-question').length;
            // let qnum = ++itemCount;

            let question = '<div class="form-group border p-3 bg-gradient-light rounded full-question" data-qid="q'+qnum+'">\
                <div class="row">\
                <div class="col-6">\
                <h5>Q'+qnum+'</h5>\
        </div>\
            <div class="col-6 text-right">\
                <button class="btn btn-delete-question"><i class="fas fa-trash-alt"></i></button>\
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
            <input type="number" name="min_value['+id+'][]" class="form-control" required>\
            </div>\
            <div class="col-4">\
                <label for="" class="col-form-label" title="required">Max Value <span class="text-danger">*</span></label>\
                <input type="number" name="max_value['+id+'][]" class="form-control" required>\
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
        });

        let qnum = 2;
        $('#questionsField').on('click', '.btn-delete-question', function (){
            $(this).closest(".full-question").remove();
        })
    </script>

@endsection
