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
        <div class="row my-4">
            <div class="col-12">
                <div class="card mb-4 bg-transparent">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-start align-items-center w-100 mr-2">
                            <form action="" method="post" class="w-100">
                                <div class="input-group mr-sm-2">
                                    <input type="text" name="search" class="form-control" placeholder="Search Projects By Keyword">
                                    <div class="input-group-append">
                                        <button  class="btn btn-primary btn-sm px-3"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterModal">
                            <span class="d-flex align-items-center"> <i class="fas fa-filter mr-2"></i>Filter</span>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModallLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h5 class="modal-title text-dark font-weight-bold" id="filterModalLabel">Filter Projects</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <p class="text-dark font-weight-bold">Audience</p>
                                                    <div class="d-flex align-items-center">
                                                        <input type="radio" class="form-radio mr-2" name="audience" value="b2b" id="radioB2B">
                                                        <label class="radio-label mb-0" for="radioB2B" >Industry professional</label>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <input type="radio" class="form-radio mr-2" name="audience" value="b2c" id="radioB2C">
                                                        <label class="radio-label mb-0" for="radioB2C">General population</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <p class="text-dark font-weight-bold">Project Type</p>
                                                    <div class="d-flex align-items-center">
                                                        <input type="radio" class="form-radio mr-2" name="research_type" value="in-person" id="inPerson">
                                                        <label class="radio-label mb-0" for="inPerson" >In-Person</label>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <input type="radio" class="form-radio mr-2" name="research_type" value="remote" id="remote">
                                                        <label class="radio-label mb-0" for="remote">Remote</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <p class="text-dark font-weight-bold">Compensation</p>
                                                    <div class="d-flex align-items-center">
                                                        <input type="number" class="form-control mr-2" name="min_incentive" min="0" max="999" placeholder="Min" id="minIncentive">
                                                        <input type="number" class="form-control mr-2" name="max_incentive" min="1" max="1000" placeholder="Max" id="maxIncentive">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <p class="text-dark font-weight-bold">Time (minutes)</p>
                                                    <div class="d-flex align-items-center">
                                                        <input type="number" class="form-control mr-2" name="min_time" placeholder="Min">
                                                        <input type="number" class="form-control mr-2" name="max_time" placeholder="Max">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                @foreach($projects as $key => $project)
                    <div class="card p-4 my-3">
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
                                                        <h5 class="text-dark font-weight-500">Project Demographics</h5>
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
                                                        <p class="text-dark-blue mb-2"><i class="fas fa-users text-success mr-2"></i><span>Total Participated</span></p>
                                                        <p class="text-dark-blue mb-2"><i class="fas fa-users-slash text-success mr-2"></i><span>Total Hired</span></p>
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
        });
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
                        $(".project-apply").attr('href', '/dashboard/project/'+response.data.id);
                        $('.project-full-details').html(response.data.project_details);
                        $('.project-total-incentive').html(response.data.total_incentive);
                        var projectSkillsDiv = $('.project-skills');
                        var projectIndustriesDiv = $('.project-industries');
                        if (response.skills){
                            var skills = response.skills;
                            projectSkillsDiv.html('');
                            var skillTitle = "<h6 class=\"mt-2 font-weight-bold font-weight-500 mb-3\">Skills & Expertise</h6>";
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
                            var industryTitle = "<h6 class=\"mt-2 font-weight-bold font-weight-500 mb-3\">Industries</h6>";
                            projectIndustriesDiv.append(industryTitle);
                            $.each(Industries, function(index, industry) {
                                var badge = $('<span class="badge badge-success badge-pill px-3 py-2 mr-2 mb-2">').text(industry);
                                projectIndustriesDiv.append(badge);
                            });
                            projectIndustriesDiv.append("<hr>");
                        }else{
                            projectIndustriesDiv.html('');
                        }

                        $('.project-required-time').html(response.data.required_time);
                        $('.project-total-participants').html(response.data.target_participant);
                        $('.project-research-type').html(response.data.research_type);
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
