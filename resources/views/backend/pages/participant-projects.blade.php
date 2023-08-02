@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Researcher Projects')
@section('extraCss')

@endsection
@section('mainContent')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-dark py-4">My Projects</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card rounded-4 shadow-md p-2">
                <div class="card-body p-0">
                    <table class="table table-responsive table-hover table-borderless rounded">
                        <thead class="bg-dark-blue text-light rounded border-bottom">
                            <tr>
                                <th class="font-15 text-uppercase">Study Title</th>
                                <th class="font-15 text-uppercase">Study Type</th>
                                <th class="font-15 text-uppercase">Payment Status</th>
                                <th class="font-15 text-uppercase">Project Status</th>
                                <th class="font-15 text-uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if(count($projects) > 0)
                        @foreach($projects as $key => $project)
                            <tr>
                                <td class="align-middle">{{ $project->study_title }}</td>
                                <td class="align-middle">
                                    @if($project->project_type == 'remote') Remote @elseif('in-person') In Person @endif
                                </td>
                                <td class="align-middle"></td>
                                <td class="align-middle">
                                    @foreach($project->responses as $response)
                                        @if($response->status == "submitted")
                                            <a class="badge bg-success text-decoration-none">Submitted</a>
                                        @elseif($response->status == "invited")
                                            <a class="badge bg-secondary text-decoration-none">Invited</a>
                                        @elseif($response->status == "scheduled")
                                            <a class="badge bg-warning text-decoration-none">Scheduled</a>
                                        @elseif($response->status == "attended")
                                            <a class="badge bg-secondary text-decoration-none">Attended</a>
                                        @elseif($response->status == "paid")
                                            <a class="badge bg-warning text-decoration-none">Paid</a>
                                        @elseif($response->status == "cancelled")
                                            <a class="badge bg-danger text-decoration-none">Cancelled</a>
                                        @elseif($response->status == "no-show")
                                            <a class="badge bg-danger text-decoration-none">No Show</a>
                                        @endif
                                    @endforeach

                                </td>
                                <td>
                                    <a type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#withdrawConfim{{$project->id}}"><i class="fa-solid fa-trash-alt text-white me-2"></i><span>Withdraw</span></a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <tr class="h-auto">
                                <td colspan="5" class="text-center"><div class="alert alert-success my-3" role="alert">Opps.. Sorry! No Projects Found</div></td>
                            </tr>
                        @endif

                        </tbody>

                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-center justify-content-lg-start mt-3">
                {{ $projects->links() }}
            </div>
        </div>
    </div>
@endsection
