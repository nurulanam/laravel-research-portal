@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Participant Response')

@section('mainContent')
    <div class="row mb-3 mb-md-4 shadow-md">
        <div class="col-12">
            <div class="card bg-dark-blue bg-gradient rounded-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-9">
                            <h1 class="text-white font-25 mb-0">{{ $response->project->my_project_name }}</h1>
                        </div>
                        <div class="col-12 col-md-3 text-md-end">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger mt-3 mt-md-0"><i class="fa-solid fa-arrow-up-from-bracket fa-rotate-270 me-2"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 order-1 order-lg-0 my-3 my-lg-0">
            <div class="card p-3 rounded-4 shadow-md">
                <div class="card-body">
                    @php
                        $projectQuestions = json_decode($response->project->projectQuestions->questions);
                    @endphp
                    @php
                        $userResponse = json_decode($response->user_response);
                    @endphp
                    @foreach($projectQuestions as $key => $question)
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">{{ $key+1 }}. {{ $question->question_name[0] }}</h5>
                            <div class="ms-3">
                                @if($question->question_type[0] == 'checkbox')
                                    @foreach($question->answer as $index => $answer)
                                        <p class="pt-2">
                                            <span class="fw-bold">{{ $index+1 }}.</span> {{ $answer }}
                                            @if(isset($userResponse[$key]) && in_array($index, $userResponse[$key]->response))
                                                @if(isset($question->answer_qualify[$index]) && $question->answer_qualify[$index] == 'qualify')
                                                    <i class="far fa-check-circle text-success" data-bs-toggle="tooltip" data-bs-placement="right" title="Correct"></i>
                                                @elseif(isset($question->answer_qualify[$index]) && $question->answer_qualify[$index] == 'disqualify')
                                                    <i class="far fa-times-circle text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Wrong"></i>
                                                @endif
                                            @endif
                                        </p>
                                    @endforeach
                                @elseif($question->question_type[0] == 'textarea')
                                    <p><span class="fw-bold">Answer</span>: {{ $userResponse[$key]->response[0] ?? '' }}</p>
                                @elseif($question->question_type[0] == 'text')
                                    <p><span class="fw-bold">Answer</span>: {{ $userResponse[$key]->response[0] ?? '' }}</p>
                                @elseif($question->question_type[0] == 'number')
                                    <p><span class="fw-bold">Answer</span>: {{ $userResponse[$key]->response[0] ?? '' }}</p>
                                @elseif($question->question_type[0] == 'slider')
                                    <p><span class="fw-bold">Answer</span>: {{ $userResponse[$key]->response[0] ?? '' }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 order-0 order-lg-1 my-3 my-lg-0">
            <div class="card rounded-4 shadow-md p-4">
                @if(!empty($response->user->profile->user_avatar))
                    <img src="{{ asset('/backend/img/profile/'. $response->user->profile->user_avatar ) }}" alt="profile avater" class="mx-auto border border-2 border-dark rounded-circle object-fit-cover" style="height: 80px; width: 80px">
                @else
                    <img src="{{ asset('/backend/img/profile/undraw_profile.svg') }}" alt="profile avater" class="mx-auto border border-2 border-dark rounded-circle object-fit-cover" style="height: 80px; width: 80px">
                @endif
                @if($response->status == 'withdrawn')
                    <span class="position-absolute top-0 start-0 m-2 badge bg-danger">Withdrawn</span>
                @endif
                <div class="card-body text-center">
                    <h2 class="font-22 font-weight-500 mt-2 mb-2">{{ $response->user->first_name.' '.$response->user->last_name }}</h2>
                    <p class="font-15 text-secondary">{{ $response->user->profile->job_title }}</p>
                    @php
                        $dateOfBirth = \Carbon\Carbon::parse($response->user->profile->date_of_birth);
                        $age = $dateOfBirth->age;
                    @endphp
                    <table class="table">
                        <thead>
                            <th class="text-start">Gender</th>
                            <th class="text-start">Age</th>
                            <th class="text-end">Education Level</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start">
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
                                            Not Updated
                                    @endswitch
                                </td>
                                <td class="text-start">{{ $age }}</td>
                                <td class="text-end">
                                    @if (!empty($response->user->profile))
                                        @switch($response->user->profile->education_level)
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
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center align-items-center my-2">
                        <span>
                            @php
                                $skillIds = isset($response->user->skills) ? json_decode($response->user->skills->skills) : null;
                            @endphp

                            @if (!empty($skillIds))
                                @foreach($skillIds as $skillId)
                                    @foreach($allSkills as $skill)
                                        @if($skill->id == $skillId)
                                            <span class="badge bg-dark-blue py-2 px-3 rounded-pill my-1">{{ $skill->skill_name }}</span>
                                        @endif
                                    @endforeach
                                @endforeach
                            @else
                                <span class="badge bg-dark-blue py-2 px-3 rounded-pill my-1">0 Skills</span>
                            @endif
                        </span>
                    </div>
                    @if($response->status == 'withdrawn')
                    @else
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <a href="#" class="btn btn-primary btn-sm mx-1">
                                <i class="fa-solid fa-check me-1"></i><span>Hire</span>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm mx-1">
                                <i class="fa-solid fa-trash-alt me-1"></i><span>Reject</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
