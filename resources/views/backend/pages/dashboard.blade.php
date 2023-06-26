@extends('backend.dashboardMaster')
@section('title', 'Dashboard')
@section('mainContent')
    <div class="row">
        <div class="col-12 col-md-6">
            <h2 class="text-dark">Hey {{ Auth::user()->first_name }} !</h2>

        </div>
    </div>
    @if(Auth::user()->hasRole('participant'))
        <div class="row my-4">
            <div class="col-12">
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
