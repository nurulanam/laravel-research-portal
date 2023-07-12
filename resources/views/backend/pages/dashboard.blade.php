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
    @if(Auth::user()->hasRole('participant'))
        <div class="row">
            <div class="col-12">
                <div class="card  bg-transparent">
                    <div class="d-flex justify-content-start align-items-center w-100 mr-2">
                        <form action="{{ route('dashboard.index') }}" method="get" class="w-100">
                            @csrf
                            <div class="input-group mr-sm-2">
                                <input type="text" name="search" class="form-control" id="search" @if(request('search')) value="{{ request('search') }}" @endif placeholder="Search Projects By Keyword">
                                <div class="input-group-append">
                                    <button  class="btn btn-primary btn-sm px-3"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-header bg-dark-blue">
                        <h5 class="text-light mb-0">Filter Projects</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.index') }}" method="GET">
                            @csrf
                        <div class="form-group">
                            <p class="text-dark font-weight-bold pb-3">Audience</p>
                            <div class="d-flex align-items-center">
                                <input type="radio" class="form-radio mr-2" name="audience" value="b2b" id="radioB2B" {{ request('audience') === 'b2b' ? 'checked' : '' }}>
                                <label class="radio-label mb-0" for="radioB2B" >Industry professional</label>
                            </div>
                            <div class="d-flex align-items-center">
                                <input type="radio" class="form-radio mr-2" name="audience" value="b2c" id="radioB2C" {{ request('audience') === 'b2c' ? 'checked' : '' }}>
                                <label class="radio-label mb-0" for="radioB2C">General population</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="text-dark font-weight-bold pb-3">Project Type</p>
                            <div class="d-flex align-items-center">
                                <input type="radio" class="form-radio mr-2" name="research_type" value="in-person" id="inPerson" {{ request('research_type') === 'in-person' ? 'checked' : '' }}>
                                <label class="radio-label mb-0" for="inPerson" >In-Person</label>
                            </div>
                            <div class="d-flex align-items-center">
                                <input type="radio" class="form-radio mr-2" name="research_type" value="remote" id="remote" {{ request('research_type') === 'remote' ? 'checked' : '' }}>
                                <label class="radio-label mb-0" for="remote">Remote</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="text-dark font-weight-bold pb-3">Compensation</p>
                            <div class="d-flex align-items-center">
                                <input type="number" class="form-control mr-2" name="min_incentive" min="0" placeholder="Min" id="minIncentive" @if(request('min_incentive')) value="{{ request('min_incentive') }}" @endif>
                                <input type="number" class="form-control mr-2" name="max_incentive" min="1" placeholder="Max" id="maxIncentive" @if(request('max_incentive')) value="{{ request('max_incentive') }}" @endif>
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="text-dark font-weight-bold">Time (minutes)</p>
                            <div class="d-flex align-items-center">
                                <input type="number" class="form-control mr-2" name="min_time" id="minTime" min="0" placeholder="Min" @if(request('min_time')) value="{{ request('min_time') }}" @endif>
                                <input type="number" class="form-control mr-2" name="max_time" id="maxTime" min="1" placeholder="Max" @if(request('max_time')) value="{{ request('max_time') }}" @endif>
                            </div>
                        </div>
                            <div class="d-flex mt-4">
                                <button class="btn btn-primary mr-3">Apply</button>
                                <button type="button" class="btn btn-danger reset-filter" onclick="resetForm();">Reset</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9 ">
                @foreach($projects as $key => $project)
                    <div class="card p-4 mb-3">
                        <div class="d-flex justify-content-between">
                            <a href="#" type="button" data-toggle="modal" data-id="{{ $project->id }}" data-target=".project-details-modal" class="text-primary show-details text-capitalize text-decoration-none modal-project-title"><h4>
                                    {{ $project->project_title }}</h4></a>
                            <div class="d-flex">
                                <div class="dropdown mr-1">
                                    <button type="button" class="btn btn-primary dropdown-toggle" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="actionDropdown">
                                        <a class="dropdown-item" href="#"><i class="fas fa-clone mr-2"></i> Copy Project link</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-eye-slash mr-2"></i> Hide Project</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start align-items-center">
                            <p class="text-success font-weight-bold mb-0">${{ $project->total_incentive }}</p>
                            <i class="fas fa-grip-lines-vertical mx-2"></i>
                            <p class="text-dark-blue mb-0">{{ $project->updated_at->diffForHumans() }} </p>
                            <i class="fas fa-grip-lines-vertical mx-2"></i>
                            <p class="text-dark-blue mb-0">{{ $project->required_time }} Minutes</p>
                            <i class="fas fa-grip-lines-vertical mx-2"></i>
                            <p class="text-dark-blue mb-0 text-capitalize">{{ $project->research_type }}</p>
                            <i class="fas fa-grip-lines-vertical mx-2"></i>
                            <p class="text-dark-blue mb-0 text-capitalize">{{ $project->research_method }}</p>
                        </div>
                        <p class="text-dark-blue mt-2 mb-0">{{ Str::limit($project->project_details, 300) }} <a href="#" type="button" class="btn btn-sm text-primary show-details" data-toggle="modal" data-id="{{ $project->id }}" data-target=".project-details-modal">[ See Details ]</a></p>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center justify-content-lg-start">
                    {{ $projects->links() }}
                </div>

                <div class="modal fade project-details-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl float-lg-right w-100 mr-lg-3">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body px-lg-5" style="min-height: 86vh; min-width: 100%">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3 class="project-title text-capitalize text-dark"></h3>
                                                <p class="mb-2"><i class="fas fa-calendar-alt text-success mr-2"></i><span class="project-posted-time text-dark-blue"></span></p>
                                                <hr>
                                                <p class="project-full-details text-dark-blue text-justify"></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="text-dark font-weight-500">Project Specifics</h5>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-12 col-md-6">
                                                        <p class="text-dark-blue mb-2"><i class="text-success fas fa-clock mr-2"></i><span class="project-required-time"></span> Minutes</p>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <p class="text-dark-blue mb-2"><i class="text-success fas fa-users mr-2"></i><span class="project-total-participants"></span> Target Participants</p>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <p class="text-dark-blue mb-2"><i class="text-success fas fa-user-shield mr-2"></i><span class="project-research-type"></span></p>

                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <p class="text-dark-blue mb-2"><i class="text-success fas fa-bullseye mr-2"></i><span class="project-research-method"></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="text-dark font-weight-500">Project Activities</h5>
                                                        <hr>
                                                        <p class="text-dark-blue mb-2"><i class="fas fa-clipboard-list text-success mr-2"></i><span>Proposals: <span class="">10</span></span></p>
                                                        <p class="text-dark-blue mb-2"><i class="fas fa-clipboard-check text-success mr-2"></i><span>Total Hired: <span class="">2</span></span></p>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-lg-4 ">
                                        <div class="card rounded-sm">
                                            <div class="card-header p-3">
                                                <a href="" class="btn btn-sm btn-primary btn-custom w-100 project-apply">Apply Now</a>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-success text-uppercase font-weight-500">Project Budget: $<span class="project-total-incentive"></span></p>
                                                <hr>
                                                <div class="my-2 project-skills"></div>
                                                <div class="my-2 project-industries"></div>
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

        });
        function resetForm(){
            $('#search').val('');
            $('#radioB2B').removeAttr('checked');
            $('#radioB2C').removeAttr('checked');
            $('#inPerson').removeAttr('checked');
            $('#remote').removeAttr('checked');
            $('#minIncentive').val('');
            $('#maxIncentive').val('');
            $('#minTime').val('');
            $('#maxTime').val('');
        }
    </script>


    <script>
        $('.show-details').on('click', function (){
           let id = $(this).data('id');
           let url = "{{ route('show.project.api', ':id') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: url.replace(':id', id),
                data: {
                    'id': id
                },
                dataType: 'JSON',
                success: function (response){
                    console.log(response)
                    if (response){
                        $('.project-title').html(response.data.project_title);
                        $(".project-apply").attr('href', '/dashboard/project/'+response.data.slug);
                        $('.project-full-details').html(response.data.project_details);
                        $('.project-total-incentive').html(response.data.total_incentive);
                        var projectSkillsDiv = $('.project-skills');
                        var projectIndustriesDiv = $('.project-industries');
                        if (response.skills){
                            var skills = response.skills;
                            projectSkillsDiv.html('');
                            var skillTitle = "<h6 class=\"mt-2 font-weight-bold text-dark font-weight-500 mb-3\">Skills & Expertise</h6>";
                            projectSkillsDiv.append(skillTitle);
                            $.each(skills, function(index, skill) {
                                var badge = $('<span class="badge badge-success badge-pill px-3 py-2 mr-2 mb-2">').text(skill.skill_name);
                                projectSkillsDiv.append(badge);
                            });
                            projectSkillsDiv.append("<hr>");
                        }else{
                            projectSkillsDiv.html('');
                        }

                        if (response.industries){
                            var Industries = response.industries;
                            projectIndustriesDiv.html('');
                            var industryTitle = "<h6 class=\"mt-2 font-weight-bold text-dark font-weight-500 mb-3\">Industries</h6>";
                            projectIndustriesDiv.append(industryTitle);
                            $.each(Industries, function(index, industry) {
                                var badge = $('<span class="badge badge-success badge-pill px-3 py-2 mr-2 mb-2">').text(industry);
                                projectIndustriesDiv.append(badge);
                            });
                        }else{
                            projectIndustriesDiv.html('');
                        }

                        $('.project-required-time').html(response.data.required_time);
                        $('.project-total-participants').html(response.data.target_participant);
                        if (response.data.research_type === 'remote'){
                            $('.project-research-type').html('Remote');
                        }else if(response.data.research_type === 'in-person'){
                            $('.project-research-type').html('In Person');
                        }
                        $('.project-research-method').html(response.data.research_method);

                        let time = formatDate(response.data.created_at);
                        $('.project-posted-time').html(time);
                    }
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
        });
    </script>
@endsection
