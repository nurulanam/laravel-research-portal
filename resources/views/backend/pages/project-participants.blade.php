@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Project Participants')
@section('extraCss')
@endsection

@section('mainContent')
    <div class="row mb-3 mb-md-4 shadow-md">
        <div class="col-12">
            <div class="card bg-dark-blue bg-gradient rounded-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-9">
                            <h1 class="text-white font-25">{{ $findProject->my_project_name }}</h1>
                        </div>
                        <div class="col-12 col-md-3">
                            <p class="font-18 text-white float-md-end">Total Participants: {{ count($findProject->responses) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            @foreach($findProject->responses as $project)
            <div class="card rounded-4 shadow-md my-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-2 text-center">
                            @if(!empty($project->user->profile->user_avatar))
                                <img src="{{ asset('/backend/img/profile/'. $project->user->profile->user_avatar ) }}" alt="profile avater" class="border border-2 border-dark rounded-circle object-fit-contain" style="height: 80px; width: 80px">
                            @else
                                <img src="{{ asset('/backend/img/profile/undraw_profile.svg') }}" alt="profile avater" class="border border-2 border-dark rounded-circle object-fit-contain" style="height: 80px; width: 80px">
                            @endif
                        </div>
                        <div class="col-lg-8 pt-3 pt-lg-0">
                            <h2 class="font-22 font-weight-500 mt-2 mb-3">{{ $project->user->first_name.' '.$project->user->last_name }}</h2>
                            <div class="d-flex my-2">
                                <i class="fa-solid fa-briefcase text-primary pt-1 me-3"></i>
                                <span>{{ $project->user->profile->job_title }}</span>
                            </div>
                            <div class="d-flex my-2">
                                <i class="fa-solid fa-user text-primary pt-1 me-3"></i>
                                <span>
                                    @switch($project->user->profile->gender)
                                        @case('male')
                                            Male
                                            @break
                                        @case('femal')
                                            Female
                                            @break
                                        @case('non-binary')
                                            Non Binary
                                            @break
                                        @case('prefer-not-to-say')
                                            Prefer Not To Say
                                            @break
                                        @default
                                            Not Updated
                                    @endswitch
                                </span>
                            </div>
                            <div class="d-flex my-2">
                                <i class="fa-solid fa-wrench text-primary pt-1 me-3"></i>
                                <span>
                                    @php
                                        $skillIds = json_decode($project->user->skills->skills);
                                    @endphp
                                    @foreach( $skillIds as $skillId)
                                        @foreach($allSkills as $skill)
                                            @if($skill->id == $skillId)
                                                <span class="badge bg-dark-blue py-2 px-3 rounded-pill my-1 ">{{ $skill->skill_name }}</span>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex justify-content-end align-items-center">
                                <a href="#" class="btn btn-primary btn-sm mx-1">
                                    <i class="fa-solid fa-check"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm mx-1">
                                    <i class="fa-solid fa-trash-alt"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
