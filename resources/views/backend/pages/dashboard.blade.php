@extends('backend.dashboardMaster')
@section('title', 'Dashboard')
@section('mainContent')
    <div class="row">
        <div class="col-12 col-md-6">
            <h2 class="text-dark">Hey {{ Auth::user()->first_name.' '.Auth::user()->last_name }} !</h2>
        </div>
    </div>
@endsection
