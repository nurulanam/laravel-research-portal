@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Dashboard')
@section('extraCss')

@endsection
@section('mainContent')
    <div class="row">
        <div class="col-12 col-md-6">
            <h2 class="text-dark">Hey {{ Auth::user()->first_name }} !</h2>
        </div>
    </div>
    @if (Auth::user()->hasRole('participant'))
        <div class="row">
            <div class="col-12">
                <div class="card bg-transparent">
                    <div class="d-flex justify-content-start align-items-center w-100 mr-2">
                        <form action="{{ route('dashboard.index') }}" method="get" class="w-100" id="searchForm">
                            @csrf
                            <div class="input-group mr-sm-2">
                                <input type="text" name="search" class="form-control main-search"
                                    @if (request('search')) value="{{ request('search') }}" @endif
                                    placeholder="Search Projects By Keyword">
                                <div class="hidden">
                                    <input type="radio" class="d-none audience-b2b" name="audience" value="b2b"
                                        {{ request('target_audience') === 'b2b' ? 'checked' : '' }}>
                                    <input type="radio" class="d-none audience-b2c" name="audience" value="b2c"
                                        {{ request('target_audience') === 'b2c' ? 'checked' : '' }}>
                                    <input type="radio" class="d-none research-type-in-person" name="research_type"
                                        value="in-person" {{ request('project_type') === 'in-person' ? 'checked' : '' }}>
                                    <input type="radio" class="d-none research-type-remote" name="research_type"
                                        value="remote" {{ request('project_type') === 'remote' ? 'checked' : '' }}>
                                    <input type="number" class="d-none incentive-min" name="min_incentive" min="0"
                                        @if (request('min_incentive')) value="{{ request('min_incentive') }}" @endif>
                                    <input type="number" class="d-none incentive-max" name="max_incentive" min="1"
                                        @if (request('max_incentive')) value="{{ request('max_incentive') }}" @endif>
                                    <input type="number" class="d-none time-min" name="min_time" min="0"
                                        @if (request('min_time')) value="{{ request('min_time') }}" @endif>
                                    <input type="number" class="d-none time-max" name="max_time" min="1"
                                        @if (request('max_time')) value="{{ request('max_time') }}" @endif>
                                </div>

                                <button class="btn btn-primary btn-sm px-3"><i class="fas fa-search"></i> Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-12 col-lg-3 mb-4 mb-lg-0">
                <div class="card rounded-4 shadow-md">
                    <div class="card-header rounded-top-4 bg-dark-blue py-3">
                        <h5 class="text-light mb-0">Filter Projects</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.index') }}" method="GET" id="filterForm">
                            @csrf
                            <div class="form-group mb-3">
                                <p class="text-dark font-weight-500 pb-3">Audience</p>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="form-radio audience-b2b me-2" name="target_audience"
                                        value="b2b" id="radioB2B" {{ request('target_audience') === 'b2b' ? 'checked' : '' }}>
                                    <label class="radio-label mb-0" for="radioB2B">Industry professional</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="form-radio audience-b2c me-2" name="target_audience"
                                        value="b2c" id="radioB2C" {{ request('target_audience') === 'b2c' ? 'checked' : '' }}>
                                    <label class="radio-label mb-0" for="radioB2C">General population</label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <p class="text-dark font-weight-500 pb-3">Project Type</p>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="form-radio research-type-in-person me-2"
                                        name="project_type" value="in-person" id="inPerson"
                                        {{ request('project_type') === 'in-person' ? 'checked' : '' }}>
                                    <label class="radio-label mb-0" for="inPerson">In-Person</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="form-radio research-type-remote me-2" name="project_type"
                                        value="remote" id="remote"
                                        {{ request('project_type') === 'remote' ? 'checked' : '' }}>
                                    <label class="radio-label mb-0" for="remote">Remote</label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <p class="text-dark font-weight-500 pb-3">Compensation</p>
                                <div class="d-flex align-items-center">
                                    <input type="number" class="form-control rounded-pill incentive-min me-2" name="min_incentive"
                                        min="0" placeholder="Min" id="minIncentive"
                                        @if (request('min_incentive')) value="{{ request('min_incentive') }}" @endif>
                                    <input type="number" class="form-control rounded-pill incentive-max" name="max_incentive"
                                        min="1" placeholder="Max" id="maxIncentive"
                                        @if (request('max_incentive')) value="{{ request('max_incentive') }}" @endif>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <p class="text-dark font-weight-500 pb-3">Time (minutes)</p>
                                <div class="d-flex align-items-center">
                                    <input type="number" class="form-control rounded-pill time-min me-2" name="min_time"
                                        id="minTime" min="0" placeholder="Min"
                                        @if (request('min_time')) value="{{ request('min_time') }}" @endif>
                                    <input type="number" class="form-control rounded-pill time-max" name="max_time"
                                        id="maxTime" min="1" placeholder="Max"
                                        @if (request('max_time')) value="{{ request('max_time') }}" @endif>
                                </div>
                            </div>
                            <div class="hidden">
                                <input type="text" name="search" class="d-none main-search"
                                    @if (request('search')) value="{{ request('search') }}" @endif>

                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button class="btn btn-primary rounded-pill w-100 me-2">Filter</button>
                                <a href="{{ route('dashboard.index') }}" class="btn btn-danger rounded-pill w-100">Clear</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9 ">
                @if(empty($userIndustries))
                    <div class="alert alert-info rounded-4 shadow-md" role="alert">
                        Please update your profile to see projects that match your industry preferences.
                    </div>
                @elseif ($projects->count() > 0)
                    @foreach ($projects as $key => $project)
                        <div class="card p-4 mb-3 rounded-4 shadow-md">
                            <div class="d-flex justify-content-between align-items-centerl">
                                <a href="#" type="button" data-id="{{ $project->id }}" class="text-primary show-details text-capitalize text-decoration-none modal-project-title">
                                    <h4>
                                        {{ $project->study_title }}</h4>
                                </a>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu">
                                        <button type="button" class="dropdown-item copyProjectLink" data-slug="{{ $project->slug }}" data-id="{{ $project->id }}" href="#"><i class="fas fa-clone text-primary me-2"></i>
                                            Copy Project link</button>
                                        <a class="dropdown-item" href="#"><i class="fas fa-eye-slash text-primary me-2"></i>
                                            Hide Project</a>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start align-items-center">
                                <p class="text-primary font-weight-bold mb-0">${{ $project->participant_incentive }}</p>
                                <i class="fas fa-grip-lines-vertical mx-2"></i>
                                <p class="text-dark mb-0">@if($project->published_at) {{ \Carbon\Carbon::parse($project->published_at)->diffForHumans() }} @else {{ \Carbon\Carbon::parse($project->updated_at)->diffForHumans() }}  @endif</p>
                                @if($project->required_time)
                                    <i class="fas fa-grip-lines-vertical mx-2"></i>
                                    <p class="text-dark mb-0">{{ $project->required_time }} Minutes</p>
                                @endif

                                <i class="fas fa-grip-lines-vertical mx-2"></i>
                                @if($project->project_type == 'remote')
                                    <p class="text-dark mb-0 text-capitalize">Remote</p>
                                @elseif($project->project_type == 'in-person')
                                    <p class="text-dark mb-0 text-capitalize">In Person</p>
                                @endif
                                @if($project->research_type)
                                    <i class="fas fa-grip-lines-vertical mx-2"></i>
                                    @if($project->research_type == 'one-on-one')
                                        <p class="text-dark mb-0 text-capitalize">One-on-One</p>
                                    @elseif($project->research_type == 'focus-group')
                                        <p class="text-dark mb-0 text-capitalize">Focus Group</p>
                                    @elseif($project->research_type == 'unmoderated-study')
                                        <p class="text-dark mb-0 text-capitalize">Unmoderated Study</p>
                                    @elseif($project->research_type == 'survey')
                                        <p class="text-dark mb-0 text-capitalize">Survey</p>
                                    @elseif($project->research_type == 'diary-study')
                                        <p class="text-dark mb-0 text-capitalize">Diary Study</p>
                                    @endif
                                @endif


                            </div>
                            <p class="text-dark mt-2 mb-0">{{ Str::limit($project->study_description, 300) }} <a
                                    href="#" type="button" class="btn btn-sm text-primary show-details" data-id="{{ $project->id }}">[ See Details ]</a></p>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger rounded-4" role="alert">
                        Opps... No Projects Found.
                    </div>
                @endif
                @if(empty($userIndustries)) @else
                        <div class="d-flex justify-content-center justify-content-lg-start">
                            {{ $projects->links() }}
                        </div>
                @endif
                <div class="modal fade project-details-modal" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl float-lg-end w-100 me-lg-3">
                        <div class="modal-content rounded-4">
                            <div class="modal-header border-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-lg-5 " style="min-height: 86vh; min-width: 100%">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h3 class="project-title text-capitalize text-dark"></h3>
                                                <p class="mb-2"><i
                                                        class="fas fa-calendar-alt text-primary me-2"></i><span
                                                        class="project-posted-time text-dark"></span></p>
                                                <hr>
                                                <p class="project-full-details text-dark text-justify"></p>
                                            </div>
                                        </div>
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="text-dark font-weight-500">Project Specifics</h5>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-12 col-md-6">
                                                        <p class="text-dark mb-2" title="Required Time"><i
                                                                class="text-primary fas fa-clock me-2" ></i><span
                                                                class="project-required-time"></span> Minutes</p>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <p class="text-dark mb-2" title="Target Participants"><i
                                                                class="text-primary fas fa-users me-2"></i><span
                                                                class="project-total-participants"></span> Target
                                                            Participants</p>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <p class="text-dark mb-2" title="Research Type"><i
                                                                class="text-primary fas fa-user-shield me-2"></i><span
                                                                class="project-research-type"></span></p>

                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <p class="text-dark mb-2" title="Research Method"><i
                                                                class="text-primary fas fa-bullseye me-2"></i><span
                                                                class="project-research-method"></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="text-dark font-weight-500">Project Activities</h5>
                                                        <hr>
                                                        <p class="text-dark mb-2"><i
                                                                class="fas fa-clipboard-list text-primary me-2"></i><span>Responses:
                                                                <span class="total-response">0</span></span></p>
                                                        <p class="text-dark mb-2"><i
                                                                class="fas fa-clipboard-check text-primary me-2"></i><span>Hired: <span class="">0</span></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 ">
                                        <div class="card rounded-sm">
                                            <div class="card-header p-3">
                                                <a href=""
                                                    class="btn btn-sm btn-primary btn-custom w-100 project-apply">Apply
                                                    Now</a>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-dark text-uppercase font-weight-500">Project Budget:
                                                    $<span class="project-incentive"></span></p>
                                                <hr>
                                                <div class="my-2 project-skills"></div>
                                                <div class="my-2 project-industries"></div>
                                                <div class="my-2 project-topics"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade project-error-modal" tabindex="-1" role="dialog"
                     aria-labelledby="projectErrorModal" aria-hidden="true">
                    <div class="modal-dialog modal-xl float-lg-end w-100 me-lg-3">
                        <div class="modal-content rounded-4">
                            <div class="modal-header border-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-lg-5 " style="min-height: 86vh; min-width: 100%">
                                <div class="card bg-danger">
                                    <div class="card-body">
                                        <h3 class="text-capitalize text-white">Opps... Sorry! Project not found.</h3>
                                        <p class="text-light">Unfortunately, we couldn't find the project you're looking for in our database. Please check the project URL or try another search.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('extraJs')
    <script>
        $(document).ready(function() {
            var minIncentive = $("#minIncentive");
            var maxIncentive = $("#maxIncentive");

            // Add event listener for input changes
            minIncentive.on("input", validateIncentives);
            maxIncentive.on("input", validateIncentives);

            function validateIncentives() {
                var minValue = parseInt(minIncentive.val());
                var maxValue = parseInt(maxIncentive.val());

                // Remove previous classes
                minIncentive.removeClass("border-danger");
                maxIncentive.removeClass("border-danger");

                if (minValue >= maxValue) {
                    minIncentive.addClass("border-danger");
                } else {
                    minIncentive.removeClass("border-danger");
                }
            }

            var minTime = $("#minTime");
            var maxTime = $("#maxTime");

            // Add event listener for input changes
            minTime.on("input", validateTimes);
            maxTime.on("input", validateTimes);

            function validateTimes() {
                var minValue = parseInt(minTime.val());
                var maxValue = parseInt(maxTime.val());

                // Remove previous classes
                minTime.removeClass("border-danger");
                maxTime.removeClass("border-danger");

                if (minValue >= maxValue) {
                    minTime.addClass("border-danger");
                } else {
                    minTime.removeClass("border-danger");
                }
            }

            // show project by url id
            var baseUrl = window.location.href;
            var urlId = /\?id=(\d+)/.exec(baseUrl);
            if (urlId){

                showProjectModal(urlId[1]);
            }
        });
        $('.copyProjectLink').on('click', function (){
            var id = $(this).data('id');
            var idUrl = window.location.origin + '/dashboard/?id=' + id

            // Create a temporary input element to copy the URL to the clipboard
            var tempInput = document.createElement('input');
            tempInput.value = idUrl;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);

            toastr.success('Link copied successfully', {
                timeOut: 3000, // Time in milliseconds
                progressBar: true
            });
        })
    </script>

    <script>
        $('.show-details').on('click', function() {
            showProjectModal($(this).data('id'));
        });
        function showProjectModal(id){
            let projectId = id; // 'data-id' attribute contains the projectId
            let userId = "{{ Auth::id() }}"; // Assuming you have a way to get the authenticated user's ID

            // URL with placeholders ':projectId' and ':id' replaced by variables
            let url = "{{ route('show.project.api', [':projectId', ':id']) }}";
            url = url.replace(':projectId', projectId).replace(':id', userId);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    'id': userId
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response.data != 'error') {
                        $('.project-details-modal').modal('show');
                        $('.project-title').html(response.data.study_title);

                        if (response.applied){
                            $(".project-apply").attr('href', '#');
                            $(".project-apply").html('Submitted').addClass('disabled');
                        }else{
                            $(".project-apply").html('Apply Now').removeClass('disabled');
                            $(".project-apply").attr('href', '/dashboard/project-apply/' + response.data.slug);
                        }
                        $('.project-full-details').html(response.data.study_description);
                        $('.project-incentive').html(response.data.participant_incentive);
                        var projectSkillsDiv = $('.project-skills');
                        var projectIndustriesDiv = $('.project-industries');
                        var projectTopicsDiv = $('.project-topics');
                        if (response.skills) {
                            var skills = response.skills;
                            projectSkillsDiv.html('');
                            var skillTitle =
                                "<h6 class=\"mt-2 font-weight-bold text-dark font-weight-500 mb-3\">Skills & Expertise</h6>";
                            projectSkillsDiv.append(skillTitle);
                            $.each(skills, function(index, skill) {
                                var badge = $(
                                    '<span class="badge bg-primary rounded-pill px-3 py-2 me-2 mb-2">'
                                ).text(skill.skill_name);
                                projectSkillsDiv.append(badge);
                            });
                            projectSkillsDiv.append("<hr>");
                        } else {
                            projectSkillsDiv.html('');
                        }

                        if (response.industries) {
                            var Industries = response.industries;
                            projectIndustriesDiv.html('');
                            var industryTitle =
                                "<h6 class=\"mt-2 font-weight-bold text-dark font-weight-500 mb-3\">Industries</h6>";
                            projectIndustriesDiv.append(industryTitle);
                            $.each(Industries, function(index, industry) {
                                var badge = $(
                                    '<span class="badge bg-primary rounded-pill px-3 py-2 me-2 mb-2">'
                                ).text(industry);
                                projectIndustriesDiv.append(badge);
                            });
                            projectIndustriesDiv.append("<hr>");
                        } else {
                            projectIndustriesDiv.html('');
                        }
                        if (response.topics) {
                            var topics = response.topics;
                            projectTopicsDiv.html('');
                            var topicTitle =
                                "<h6 class=\"mt-2 font-weight-bold text-dark font-weight-500 mb-3\">Topics</h6>";
                            projectTopicsDiv.append(topicTitle);
                            $.each(topics, function(index, topic) {
                                var formattedText = topic.replace(/-/g, ' ').replace(/\b\w/g, function(c) {
                                    return c.toUpperCase();
                                });
                                var badge = $(
                                    '<span class="badge bg-primary rounded-pill px-3 py-2 me-2 mb-2">'
                                ).text(formattedText);
                                projectTopicsDiv.append(badge);
                            });
                        } else {
                            projectTopicsDiv.html('');
                        }

                        $('.project-required-time').html(response.data.required_time);
                        $('.project-total-participants').html(response.data.target_participant);
                        if (response.data.project_type === 'remote') {
                            $('.project-research-type').html('Remote');
                        } else if (response.data.project_type === 'in-person') {
                            $('.project-research-type').html('In Person');
                        }
                        if (response.data.research_type === 'one-on-one') {
                            $('.project-research-method').html('One On One');
                        } else if (response.data.research_type === 'focus-group') {
                            $('.project-research-method').html('Focus Group');
                        } else if (response.data.research_type === 'unmoderated-study') {
                            $('.project-research-method').html('Unmoderated Study');
                        } else if (response.data.research_type === 'survey') {
                            $('.project-research-method').html('Survey');
                        } else if (response.data.research_type === 'diary-study') {
                            $('.project-research-method').html('Diary Study');
                        }

                        if (response.data.published_at){
                            let time = formatDate(response.data.published_at);
                            $('.project-posted-time').html(time);
                        }else{
                            let time = formatDate(response.data.updated_at);
                            $('.project-posted-time').html(time);
                        }
                        if (response.totalResponse){
                            $('.total-response').html(response.totalResponse);
                        }else{
                            $('.total-response').html('0');

                        }
                    }else if(response.data == 'error'){
                        $('.project-error-modal').modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors if any
                    console.log(xhr, status, error)
                }
            })

            function formatDate(dateString) {
                var date = new Date(dateString);
                var options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                };
                return date.toLocaleDateString(undefined, options);
            }
        }
    </script>
@endsection
