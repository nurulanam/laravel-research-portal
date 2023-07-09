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
            <h4 class="text-dark py-4">All Projects</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table table-responsive-sm rounded">
                    <thead class="bg-dark-blue text-light rounded">
                    <tr>
                        <th class="text-uppercase">#Sl</th>
                        <th class="text-uppercase">Internal Name</th>
                        <th class="text-uppercase">Responses</th>
                        <th class="text-uppercase">Outstanding Payments</th>
                        <th class="text-uppercase">Project Type</th>
                        <th class="text-uppercase">Status</th>
                        <th class="text-uppercase">Updated</th>
                        <th class="text-uppercase">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projects as $key => $project)
                        @php
                            $serialNumber = ($projects->currentPage() - 1) * $projects->perPage() + $key + 1;
                        @endphp
                        <tr>
                            <td class="align-middle">{{ $serialNumber }}</td>
                            <td class="align-middle">{{ $project->internal_name }}</td>
{{--                            <td>@foreach($project->projectHasCities as $projectHasCity)--}}
{{--                                    {{ $projectHasCity->city_name }},--}}
{{--                            @endforeach</td>--}}
                            <td class="align-middle">0</td>
                            <td class="align-middle"></td>
                            <td class="align-middle">{{ $project->research_type }}</td>
                            <td class="align-middle">@if($project->status == "publish") <a class="badge badge-success text-light text-decoration-none p-1">Publish</a>
                                @elseif($project->status == "draft")
                                    <a class="badge badge-secondary text-decoration-none text-light p-1">Draft</a>
                                @elseif($project->status == "closed")
                                            <a class="badge badge-danger text-decoration-none text-light p-1">Closed</a>
                                @endif</td>
                            <td class="align-middle">{{ $project->updated_at->diffForHumans()  }}</td>
                            <td class="align-middle">
                                <div class="d-flex">
                                    <div class="dropdown mr-1">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="actionDropdown">
                                            <a class="dropdown-item" href="#"><i class="fas fa-directions mr-2"></i> Preview Screener</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-edit text-success mr-2"></i> Edit</a>
                                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteModal{{$project->id}}" ><i class="fas fa-trash-alt text-danger mr-2"></i> Delete</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title text-dark" id="deleteModalLabel">Confirmation Message</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-danger font-18">Are you sure to delete <b>{{$project->internal_name}}</b>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('project.destroy', $project->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>

            </div>
            <div class="d-flex justify-content-center justify-content-lg-start mt-3">
                {{ $projects->links() }}
            </div>

        </div>
    </div>
@endsection
