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
                <a  href="{{ route('project.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Create a Project</a>
            </div>
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="fa-solid fa-circle-exclamation fa-2x text-dark-blue me-3"></i>
                <div>
                    Remember! Once You Publish Your Project. You Can't Edit That Again.
                </div>
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
                                <td class="align-middle">{{ count($project->responses) }}</td>
                                <td class="align-middle">@if($project->project_type == 'remote') Remote @elseif('in-person') In Person @endif</td>
                                <td class="align-middle"></td>
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
                                    <a href="{{ route('project.edit', $project->id) }}"><i class="fas fa-edit text-success"></i></a>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('project.preview', $project->slug) }}"><i class="fa-solid fa-eye text-warning"></i></a>
                                </td>
                                <td class="align-middle">
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#deleteConfim{{$project->id}}"><i class="fa-solid fa-trash-alt text-danger"></i></a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteConfim{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body py-4">
                                                    <h5 class="modal-title text-dark" id="deleteModalLabel">Sure, To Delete
                                                        <span class="text-decoration-underline text-danger">{{ $project->my_project_name }}</span>?</h5>
                                                </div>
                                                <div class="modal-footer py-2">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-ban me-2"></i>Cancle</button>
                                                    <form action="{{ route('project.destroy', $project->id) }}" method="POST">
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
                                <td colspan="8" class="text-center"><div class="alert alert-danger" role="alert">Opps.. sorry! you don't have any projects</div></td>
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
