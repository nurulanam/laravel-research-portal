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
                <div class="d-flex justify-content-end align-items-center gap-2">
                    <p>@if(isset(Auth::user()->authCutomer)) Card: <span class="text-secondary">XXXXXXXXXXXX{{ Auth::user()->authCutomer->card_digit }}@endif</span></p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCard"><i class="fa-solid fa-plus me-2"></i>@if(isset(Auth::user()->authCutomer)) Update Card @else Add Card @endif</button>
                </div>
            </div>
        </div>
    </div>
    @php
        $auth_customer = isset(Auth::user()->authCutomer) ? Auth::user()->authCutomer : null;
        $expiration_months = [
             'January',
             'February',
             'March',
             'April',
             'May',
             'June',
             'July',
             'August',
             'September',
             'October',
             'November',
             'December'
             ];
    @endphp
    <!-- Modal -->
    <div class="modal fade" id="addCard" tabindex="-1" aria-labelledby="addCardLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-dark-blue text-white">
                    <h5 class="modal-title" id="addCardLabel">@if(isset(Auth::user()->authCutomer)) Update Card @else Add Card @endif</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(isset(Auth::user()->authCutomer))
                        <form action="{{ route('customer.profile.update') }}" method="post">
                        @method('put')
                    @else
                        <form action="{{ route('customer.profile.store') }}" method="post">
                    @endif
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-5">Card Number <span class="text-danger">*</span>
                            </div>
                            <div class="col-md-7 text-end">
                                <input type="number" name="card_number"
                                       class="form-control card_number"
                                       value="{{ old('card_number') }}"
                                       placeholder="5424000000000000" required
                                       data-parsley-error-message="Please enter your card number">
                                @error('card_number')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">Expiration Year <span class="text-danger">*</span>
                            </div>
                            <div class="col-md-7 text-end">
                                <select class="form-select" name="expiration_year" required
                                        data-parsley-error-message="Please select card expiration year">
                                    <option value="">Please Choose A Year</option>
                                    @foreach (range(now()->year, now()->year + 15) as $expiration_year)
                                        <option value="{{ $expiration_year }}"
                                                @if (old('expiration_year') == $expiration_year) selected @endif
                                        >{{ $expiration_year }}</option>
                                    @endforeach
                                </select>
                                @error('expiration_year')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">Expiration Month <span
                                    class="text-danger">*</span></div>
                            <div class="col-md-7 text-end">
                                <select class="form-select" name="expiration_month" required
                                        data-parsley-error-message="Please select card expiration month">
                                    <option value="">Please Choose A Month</option>
                                    @foreach ($expiration_months as $key => $expiration_month)
                                        <option
                                            value="{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}"
                                            @if (old('expiration_month') == str_pad($key + 1, 2, '0', STR_PAD_LEFT)) selected @endif
                                        >{{ $expiration_month }}</option>
                                    @endforeach
                                </select>
                                @error('expiration_month')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">Cvv <span class="text-danger">*</span></div>
                            <div class="col-md-7 text-end">
                                <input type="number" name="cvv" class="form-control cvv"
                                       value="{{ old('cvv') }}" placeholder="123" required
                                       data-parsley-error-message="Please enter card cvv">
                                @error('cvv')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-7">
                                <button class="btn btn-primary"><span class="me-1"><i class="fas fa-check"></i></span> @if(isset(Auth::user()->authCutomer)) Update @else Save @endif</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <img src="{{ asset('/backend/img/authorize-cards-1.png') }}" alt="">
                </div>
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
                @if(count($histories) > 0)
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
                @else
                    <tr class="h-auto">
                        <td colspan="8" class="text-center">
                            <div class="alert alert-danger mb-0" role="alert">Opps... sorry! You don't have any transactions yet.</div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center justify-content-lg-start mt-3">
        {{ $histories->links() }}
    </div>
@endsection
