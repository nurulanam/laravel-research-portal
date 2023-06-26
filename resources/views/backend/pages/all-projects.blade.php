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
                <table class="table  table-responsive-sm rounded">
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
                            <td>{{ $serialNumber }}</td>
                            <td>{{ $project->internal_name }}</td>
                            <td>{{ $project->projectHasCity->city_name }}</td>
                            <td>0</td>
                            <td>{{ $project->research_type }}</td>
                            <td>{{ $project->status }}</td>
                            <td>{{ $project->updated_at->diffForHumans()  }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="dropdown mr-1">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                            <a class="dropdown-item" href="#"><i class="fas fa-directions mr-2"></i> Preview Screener</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-edit mr-2"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-trash-alt mr-2"></i> Delete</a>
                                        </div>
                                    </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>

        </div>
    </div>
@endsection
