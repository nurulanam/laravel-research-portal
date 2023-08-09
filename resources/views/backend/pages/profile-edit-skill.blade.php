@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Profile')
@section('extraCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
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
                            <p class="fw-medium">Email @if(Auth::user()->hasVerifiedEmail())<span data-toggle="tooltip" data-placement="right" title="Verified"><i class="fa-regular fa-circle-check text-primary"></i></span> @endif </p>
                        </div>
                        <div class="col-12 col-lg-8 mb-3">
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    @if(Auth::user()->hasRole('participant'))
                        <form action="{{ route('profile.store.skill') }}" method="POST">
                            @csrf
                        <div class="d-md-flex justify-content-md-between">
                            <p class="fw-medium">Skills</p>
                            <div class="d-flex">
                                <a href="{{ route('profile.index') }}" class="btn btn-danger btn-sm me-2" onclick="return confirm('Are you sure you want to cancel editing the skills?') ? window.location.href = '{{ route('profile.index') }}' : false;">
                                    <i class="fa-solid fa-arrow-up-from-bracket fa-rotate-270 me-2"></i><span>Back</span>
                                </a>
                                <button class="btn btn-primary btn-sm"><i class="fa-solid fa-check me-2"></i><span>Save</span></button>
                            </div>
                        </div>
                        <div class="mt-4">
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
                        </form>
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
                                <a href="{{ route('profile.edit.contact') }}" class="btn" onclick="return confirm('Are you sure you want to cancel editing the skills?') ? window.location.href = '{{ route('profile.edit.contact') }}' : false;"><i class="fa-solid fa-pen text-secondary"></i></a>
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
            @if (Auth::user()->hasRole('participant'))
                <div class="row my-4">
                    <div class="col-12">
                        <div class="card py-3 px-2 rounded-4 shadow-md">

                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <p class="font-22 fw-bold">Demographics</p>
                                    <a href="{{ route('profile.edit.demographics') }}" class="btn" onclick="return confirm('Are you sure you want to cancel editing the skills?') ? window.location.href = '{{ route('profile.edit.demographics') }}' : false;"><i class="fa-solid fa-pen text-secondary"></i></a>
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
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <p class="font-22 fw-bold">Employment</p>
                                <a href="{{ route('profile.edit.employment') }}" class="btn" onclick="return confirm('Are you sure you want to cancel editing the skills?') ? window.location.href = '{{ route('profile.edit.employment') }}' : false;"><i class="fa-solid fa-pen text-secondary"></i></a>

                            </div>
                            <div class="row">
                                @if(Auth::user()->hasRole('participant'))
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
                                @elseif(Auth::user()->hasRole('researcher'))
                                    <div class="col-12 col-md-6 col-lg-3 mb-2 mb-md-3">
                                        <p class="fw-medium">Industry</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <p class="fw-medium text-secondary">
                                            @if (!empty($profileIndustry) && isset($industries[$profileIndustry]))
                                                <span class="badge bg-primary rounded-pill px-3 py-2 me-2 mb-2 text-capitalize">{{ $industries[$profileIndustry] }}</span>
                                            @else
                                                Update
                                            @endif
                                        </p>
                                    </div>
                                @endif
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
                            @if(Auth::user()->hasRole('participant'))
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('extraJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
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
            }).on('change', function(e) {
                var selectedOptions = $(this).val() || [];
                if (selectedOptions.length > 25) {
                    // Remove extra selections
                    selectedOptions.splice(2);
                    $(this).val(selectedOptions).trigger('change');
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
