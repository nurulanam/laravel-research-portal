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
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-borderless rounded">
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
                        @if(count($findProjectHasResponse) > 0)
                        @foreach($findProjectHasResponse as $key => $response)
                            <tr>
                                <td class="align-middle">{{ $response->project->study_title }}</td>
                                <td class="align-middle">
                                    @if($response->project->project_type == 'remote') Remote @elseif('in-person') In Person @endif
                                </td>
                                <td class="align-middle"></td>
                                <td class="align-middle">
                                    @if($response->status == "submitted")
                                        <a class="badge bg-success text-decoration-none">Submitted</a>
                                    @elseif($response->status == "invited")
                                        <a class="badge bg-primary text-decoration-none">Invited</a>
                                    @elseif($response->status == "scheduled")
                                        <a class="badge bg-warning text-decoration-none">Scheduled</a>
                                    @elseif($response->status == "attended")
                                        <a class="badge bg-secondary text-decoration-none">Attended</a>
                                    @elseif($response->status == "paid")
                                        <a class="badge bg-warning text-decoration-none">Paid</a>
                                    @elseif($response->status == "cancelled")
                                        <a class="badge bg-danger text-decoration-none">Cancelled</a>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if($response->status == "submitted")
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#withdrawConfim{{ $response->id }}">
                                            <i class="fa-solid fa-trash-alt text-white me-0 me-md-2"></i>
                                            <span class="d-none d-md-inline-block">Withdraw</span>
                                        </button>
                                    @elseif($response->status == "invited")
                                        <div class="d-flex align-items-center gap-3">
                                            <button class="btn btn-sm btn-primary"><i class="fa-solid fa-check me-2"></i>Accept</button>
                                            <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-alt me-2"></i>Deny</button>
                                        </div>
                                    @endif
                                    <!-- Modal -->
                                    <div class="modal fade" id="withdrawConfim{{ $response->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body py-4">
                                                    <h5 class="modal-title text-dark" id="deleteModalLabel">Sure, To withdraw your response?</h5>
                                                </div>
                                                <div class="modal-footer py-2">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-ban me-2"></i>Cancel</button>
                                                    <form action="{{ route('project.withdraw.response', $response->id) }}" method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-alt me-2"></i>Withdraw</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <tr class="h-auto">
                                <td colspan="5" class="text-center"><div class="alert alert-danger" role="alert">Opps... Sorry! No Projects Found</div></td>
                            </tr>
                        @endif

                        </tbody>

                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center justify-content-lg-start mt-3">
                {{ $findProjectHasResponse->links() }}
            </div>

        </div>
    </div>
@endsection
