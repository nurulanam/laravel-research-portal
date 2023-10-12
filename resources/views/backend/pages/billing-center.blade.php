@extends('backend.dashboardMaster')
@section('extraMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Create New Project')
@section('extraCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
@endsection
@section('mainContent')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-dark py-4">Billing History</h4>
            </div>
        </div>
    </div>
    <div class="card shadow-md p-2 rounded-4">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-borderless">
                <thead class="border-bottom font-15 text-uppercase">
                    <th>Transaction id</th>
                    <th>Project Name</th>
                    <th>Status</th>
                    <th>Date</th>
                </thead>
                <tbody>
                @foreach($histories as $history)
                    <tr>
                        <td>
                            {{ '#'.$history->transaction_id }}
                        </td>
                        <td>
                             {{ $history->project->my_project_name }}
                        </td>
                        <td>
                            @switch($history->response_code)
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
                        </td>
                        <td>
                            {{ $history->created_at->format('m-d-Y') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center justify-content-lg-start mt-3">
        {{ $histories->links() }}
    </div>
@endsection
