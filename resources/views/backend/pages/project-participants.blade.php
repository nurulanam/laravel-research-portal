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
                            <h1 class="text-white font-25 mb-0">{{ $findProject->my_project_name }}</h1>
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
        @foreach($findProject->responses as $response)
        <div class="col-12 col-md-6 col-lg-4 my-2 my-lg-0">
            <div class="card shadow-md h-100 @if($response->status == 'withdrawn' || $response->status == 'rejected' || $response->status == 'denied') bg-danger-subtle position-relative @elseif($response->status == 'invited') bg-primary-subtle position-relative @elseif($response->status == 'hired' || $response->status == 'accepted' || $response->status == 'scheduled') bg-success-subtle position-relative  @endif rounded-4 shadow-md p-4">
                @if(!empty($response->user->profile->user_avatar))
                    <img src="{{ asset('/backend/img/profile/'. $response->user->profile->user_avatar ) }}" alt="profile avater" class="mx-auto border border-2 border-dark rounded-circle object-fit-cover" style="height: 80px; width: 80px">
                @else
                    <img src="{{ asset('/backend/img/profile/undraw_profile.svg') }}" alt="profile avater" class="mx-auto border border-2 border-dark rounded-circle object-fit-cover" style="height: 80px; width: 80px">
                @endif
                    @if($response->status == 'withdrawn')
                        <span class="position-absolute top-0 start-0 m-2 badge bg-danger">Withdrawn</span>
                    @elseif($response->status == 'rejected')
                        <span class="position-absolute top-0 start-0 m-2 badge bg-danger">Rejected</span>
                    @elseif($response->status == 'denied')
                        <span class="position-absolute top-0 start-0 m-2 badge bg-danger">Denied</span>
                    @elseif($response->status == 'accepted')
                        <span class="position-absolute top-0 start-0 m-2 badge bg-success">Accepted</span>
                    @elseif($response->status == 'scheduled')
                        <span class="position-absolute top-0 start-0 m-2 badge bg-success">Scheduled</span>
                    @elseif($response->status == 'invited')
                        <span class="position-absolute top-0 start-0 m-2 badge bg-primary">Invited</span>
                    @elseif($response->status == 'hired')
                        <span class="position-absolute top-0 start-0 m-2 badge bg-success">Hired</span>
                    @endif
                <div class="card-body text-center">
                    <h2 class="font-22 font-weight-500 mt-2 mb-2">{{ $response->user->first_name.' '.$response->user->last_name }}</h2>
                    <p class="font-15 text-secondary">{{ $response->user->profile->job_title }}</p>
                    <div class="d-flex justify-content-center my-2">
                        <i class="fa-solid fa-user text-primary pt-1 me-2"></i>
                        <span>
                            @switch($response->user->profile->gender)
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
                                    Unknown
                            @endswitch
                        </span>
                    </div>
                    <div class="d-flex justify-content-center align-items-center my-2">
                        <span>
                            @php
                                $skillIds = isset($response->user->skills) ? json_decode($response->user->skills->skills) : null;
                            @endphp

                            @if (!empty($skillIds))
                                @foreach($skillIds as $skillId)
                                    @foreach($allSkills as $skill)
                                        @if($skill->id == $skillId)
                                            <span class="badge bg-dark-blue text-capitalize py-2 px-3 rounded-pill my-1">{{ $skill->skill_name }}</span>
                                        @endif
                                    @endforeach
                                @endforeach
                            @else
                                <span class="badge bg-dark-blue py-2 px-3 rounded-pill my-1">0 Skills</span>
                            @endif

                        </span>
                    </div>

                </div>
                <div class="card-footer @if($response->status == 'invited') bg-primary-subtle @elseif($response->status == 'hired' || $response->status == 'accepted' || $response->status == 'scheduled') bg-success-subtle @elseif($response->status == 'rejected' || $response->status == 'denied') bg-danger-subtle @else bg-white @endif">
                    <div class="d-flex justify-content-center align-items-center pt-3">
                        @if($response->status == 'withdrawn' || $response->status == 'rejected' || $response->status == 'denied' || $response->status == 'hired')
                            <a href="{{ route('project.participant.response', [$response->project->slug, $response->user_id]) }}" class="btn btn-primary btn-sm mx-1">
                                <i class="fa-solid fa-eye me-1"></i><span>Details</span>
                            </a>
                        @else
                            <a href="{{ route('project.participant.response', [$response->project->slug, $response->user_id]) }}" class="btn btn-primary btn-sm mx-1">
                                <i class="fa-solid fa-eye me-1"></i><span>Details</span>
                            </a>
                            @if($response->status == 'submitted')
                                <a href="{{ route('project.invite', [$response->project->slug, $response->user_id]) }}" class="btn btn-primary btn-sm mx-1">
                                    <i class="fa-solid fa-check me-1"></i><span>Invite</span>
                                </a>
                            @elseif($response->status == 'accepted')
                                <button type="button" class="btn btn-primary btn-sm mx-1 zoom-btn" data-id="{{ $response->id }}" data-bs-toggle="modal" data-bs-target="#zoomModal{{ $response->id }}">
                                    <i class="fa-solid fa-bell"></i> Zoom Meeting
                                </button>
                                <div class="modal fade" id="zoomModal{{ $response->id }}" tabindex="-1" aria-labelledby="zoomModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-dark-blue text-white">
                                                <h1 class="modal-title fs-5" id="zoomModalLabel">Send Zoom Meeting</h1>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <form action="{{ route('project.send.zoom', [$response->project->slug, $response->user_id]) }}" method="post" class="zoom-meeting-form">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <div class="col-md-5">Meeting ID <span class="text-danger">*</span>
                                                        </div>
                                                        <div class="col-md-7 text-end">
                                                            <input type="number" name="meeting_id" class="form-control" placeholder="123 1234 1234" required data-parsley-error-message="Please enter your meeting id.">
                                                            @error('meeting_id')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-5">Passcode <span class="text-danger">*</span>
                                                        </div>
                                                        <div class="col-md-7 text-end">
                                                            <input type="text" name="passcode" class="form-control" placeholder="1234" required="" data-parsley-error-message="Please enter your security passcode.">
                                                            @error('passcode')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-5">Date & Time<span class="text-danger">*</span>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="datetime-local" name="schedule_date_time" class="form-control" required data-parsley-error-message="Please add schedule date">
                                                            @error('schedule_date_time')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-5">
                                                        </div>
                                                        <div class="col-md-7">
                                                            <button class="btn btn-primary"><span class="me-2"><i class="fa-solid fa-check"></i></span> Send</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer text-start">
                                                <div class="alert alert-success" role="alert">
                                                    <b>Note:</b>  First log in to your <a href="https://zoom.us/" target="_blank">Zoom</a> account, schedule your meeting. Start the meeting at the scheduled time.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($response->status == 'scheduled')
                                <a href="{{ route('project.hire', [$response->project->slug, $response->user_id]) }}" class="btn btn-primary btn-sm mx-1">
                                    <i class="fa-solid fa-check me-1"></i><span>Hire</span>
                                </a>

                            @endif
                            <a href="{{ route('project.reject', [$response->project->slug, $response->user_id]) }}" class="btn btn-danger btn-sm mx-1">
                                <i class="fa-solid fa-trash-alt me-1"></i><span>Reject</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
@section('extraJs')
    <script src="{{ asset('backend/js/parsley.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.zoom-meeting-form').parsley().validate();
        });
    </script>
@endsection
