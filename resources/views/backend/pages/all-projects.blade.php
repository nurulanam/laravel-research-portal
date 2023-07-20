@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'All Projects')
@section('extraCss')

@endsection
@section('mainContent')
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
            <div class="card p-2">
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
                        @foreach($projects as $key => $project)
                            @php
                                $serialNumber = ($projects->currentPage() - 1) * $projects->perPage() + $key + 1;
                            @endphp
                            <tr>
                                <td class="align-middle">{{ $project->internal_name }}</td>
                                <td class="align-middle">0</td>
                                <td class="align-middle">{{ $project->research_type }}</td>
                                <td class="align-middle"></td>
                                <td class="align-middle">
                                    @if($project->status == "publish")
                                        <a class="badge bg-success text-decoration-none">Publish</a>
                                    @elseif($project->status == "draft")
                                        <a class="text-decoration-none">Draft</a>
                                    @elseif($project->status == "closed")
                                        <a class="text-decoration-none">Closed</a>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <a href=""><i class="fas fa-edit text-success mr-2"></i></a>
                                </td>
                                <td class="align-middle">
                                    <a href=""><i class="fa-solid fa-eye text-warning mr-2"></i></a>
                                </td>
                                <td class="align-middle">
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#deleteConfim{{$project->id}}"><i class="fa-solid fa-trash-alt text-danger mr-2"></i></a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteConfim{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body py-4">
                                                    <h5 class="modal-title text-dark" id="deleteModalLabel">Sure, To Delete
                                                        <span class="text-decoration-underline text-danger">{{ $project->internal_name }}</span>?</h5>
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
{{--                                <td class="align-middle">--}}
{{--                                    <div class="d-flex justify-content-lg-end">--}}
{{--                                        <div class="dropdown mr-1">--}}
{{--                                            <button type="button" class="btn btn-primary dropdown-toggle" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">--}}
{{--                                                <i class="fas fa-cog"></i>--}}
{{--                                            </button>--}}
{{--                                            <div class="dropdown-menu" aria-labelledby="actionDropdown">--}}
{{--                                                <a class="dropdown-item" href="#"><i class="fas fa-directions mr-2"></i> Preview Screener</a>--}}
{{--                                                <a class="dropdown-item" href="#"><i class="fas fa-edit text-success mr-2"></i> Edit</a>--}}
{{--                                                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteModal{{$project->id}}" ><i class="fas fa-trash-alt text-danger mr-2"></i> Delete</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- Modal -->--}}
{{--                                    <div class="modal fade" id="deleteModal{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">--}}
{{--                                        <div class="modal-dialog" role="document">--}}
{{--                                            <div class="modal-content">--}}
{{--                                                <div class="modal-header border-0">--}}
{{--                                                    <h5 class="modal-title text-dark" id="deleteModalLabel">Confirmation Message</h5>--}}
{{--                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                        <span aria-hidden="true">&times;</span>--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-body">--}}
{{--                                                    <p class="text-danger font-18">Are you sure to delete <b>{{$project->internal_name}}</b>?</p>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-footer">--}}
{{--                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>--}}
{{--                                                    <form action="{{ route('project.destroy', $project->id) }}" method="POST">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
{{--                                                        <button class="btn btn-danger">Delete</button>--}}
{{--                                                    </form>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach

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
