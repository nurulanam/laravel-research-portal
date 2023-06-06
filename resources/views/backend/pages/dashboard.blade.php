@extends('backend.dashboardMaster')
@section('title', 'Dashboard')
@section('mainContent')
    <div class="row">
        <div class="col-12 col-md-6">
            <h2 class="text-dark">Hey {{ Auth::user()->name }} !</h2>
        </div>
    </div>
@endsection
