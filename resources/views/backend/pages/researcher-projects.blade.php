@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Researcher Projects')
@section('extraCss')
@endsection

@section('mainContent')
    <button class="remainder position-fixed rounded-circle btn btn-warning border border-2 border-warning-subtle shadow-lg" data-bs-toggle="modal" data-bs-target="#remainderModal">?</button>
    <!-- remainder Modal -->
    <div class="modal fade" id="remainderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header rounded-top-4 bg-success-subtle">
                    <h1 class="modal-title fs-5" id="remainderModalLabel">Project Details, Payment & Pricing</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>Once you publish or set schedule your project. You can't edit that again.</li>
                        <li>Pricing for participant recruitment and project listings and hosting is as follows:
                            <ul class="mt-2">
                                <li>You will be charged based on your per participant incentive. Third Estate Research charges a 50% fee of the incentive you pay to your participants. </li>
                                <li>Example: if you would like to pay your participants $50.00 each for completing your project, Third Estate Research will be paid $25.00 for recruiting that participant. Your total paid to us, per participant, would be $75.00.</li>
                                <li>This pricing includes listing your project on our website, and recruiting participants from our database. We will also handle the incentive payouts to all participants upon completion of your study. Payment is due in full upon publishing of your study. </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-dark py-4">My Projects</h4>
                <a  href="{{ route('project.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Create a Project</a>
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
                                <th class="font-15 text-uppercase">My Project Name</th>
                                <th class="font-15 text-uppercase">Participants</th>
                                <th class="font-15 text-uppercase">Study Type</th>
                                <th class="font-15 text-uppercase">Payment Status</th>
                                <th class="font-15 text-uppercase">Project Status</th>
                                <th class="font-15 text-uppercase">Edit</th>
                                <th class="font-15 text-uppercase">Preview</th>
                                <th class="font-15 text-uppercase">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($projects) > 0)
                        @foreach($projects as $key => $project)
                            @php
                                $serialNumber = ($projects->currentPage() - 1) * $projects->perPage() + $key + 1;
                            @endphp
                            <tr>
                                <td class="align-middle">{{ $project->my_project_name }}</td>
                                <td class="align-middle"><a href="{{ route('project.participants', $project->slug) }}" class="badge bg-success px-2 text-decoration-none"><i class="fa-solid fa-users me-2"></i>{{ count($project->responses) }}</a></td>
                                <td class="align-middle">@if($project->project_type == 'remote') Remote @elseif('in-person') In Person @endif</td>
                                <td class="align-middle">
                                    @if($project->researcherBilling)
                                        @switch($project->researcherBilling->response_code)
                                            @case(1)
                                                <span class="badge bg-success">Approved</span>
                                                @break
                                            @case(2)
                                                <span class="badge bg-danger">Declined</span>
                                                @break
                                            @case(3)
                                                <span class="badge bg-info">Error</span>
                                                @break
                                        @endswitch
                                    @else
                                        <span class="badge bg-secondary">Unpaid</span>
                                    @endif

                                </td>
                                <td class="align-middle">
                                    @if($project->status == "publish")
                                        <a class="badge bg-success text-decoration-none">Publish</a>
                                    @elseif($project->status == "draft")
                                        <a class="badge bg-secondary text-decoration-none">Draft</a>
                                    @elseif($project->status == "schedule")
                                        <a class="badge bg-warning text-decoration-none">Schedule</a>
                                    @elseif($project->status == "closed")
                                        <a class="badge bg-danger text-decoration-none">Closed</a>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if($project->status == "publish")
                                        <a href="#"><i class="fas fa-edit text-danger"></i></a>
                                    @else
                                        <a href="{{ route('project.edit', $project->slug) }}"><i class="fas fa-edit text-success"></i></a>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('project.preview', $project->slug) }}"><i class="fa-solid fa-eye text-warning"></i></a>
                                </td>
                                <td class="align-middle">
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#deleteConfim{{$project->slug}}"><i class="fa-solid fa-trash-alt text-danger"></i></a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteConfim{{$project->slug}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body py-4">
                                                    <h5 class="modal-title text-dark" id="deleteModalLabel">Sure, To Delete
                                                        <span class="text-decoration-underline text-danger">{{ $project->my_project_name }}</span>?</h5>
                                                </div>
                                                <div class="modal-footer py-2">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-ban me-2"></i>Cancel</button>
                                                    <form action="{{ route('project.delete', $project->slug) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-alt me-2"></i>Delete</button>
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
                                <td colspan="8" class="text-center">
                                    <div class="alert alert-danger mb-0" role="alert">Opps... sorry! You don't have any projects</div>
                                </td>
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
