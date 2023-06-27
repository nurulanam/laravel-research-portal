@extends('backend.dashboardMaster')
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
                <div class="card mb-4">
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
                    <div class="card p-4">
                        <div class="d-flex justify-content-between">
                            <a href="#" class="text-primary text-capitalize text-decoration-none"><h4>{{ $project->project_title }}</h4></a>
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
                            <p class="text-success font-weight-bold mb-0">${{ $project->incentive }}</p>
                            <i class="fas fa-grip-lines-vertical mx-2"></i>
                            <p class="mb-0">{{ $project->updated_at->diffForHumans() }} </p>
                            <i class="fas fa-grip-lines-vertical mx-2"></i>
                            <p class="mb-0">{{ $project->required_time }} Minutes</p>
                            <i class="fas fa-grip-lines-vertical mx-2"></i>
                            <p class="mb-0 text-capitalize">{{ $project->research_type }}</p>
                            <i class="fas fa-grip-lines-vertical mx-2"></i>
                            <p class="mb-0 text-capitalize">{{ $project->research_method }}</p>
                        </div>
                        <p class="mt-2 mb-0">{{ Str::limit($project->project_details, 300) }}</p>
                    </div>
                @endforeach
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
@endsection
