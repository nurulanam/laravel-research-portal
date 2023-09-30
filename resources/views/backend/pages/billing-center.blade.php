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
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="fa-solid fa-circle-exclamation fa-2x text-dark-blue me-3"></i>
            </div>
        </div>
    </div>
@endsection
