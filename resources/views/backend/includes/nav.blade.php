@php
    $avatar = App\Http\Controllers\backend\ProfileController::showAvatar();
@endphp
{{--main navigation start--}}
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-md fixed-top main-nav" style="z-index: 1050">
    <div class="container-fluid d-lg-block justify-content-lg-center mx-lg-auto">
        <!-- Centered Logo -->
        <div class="navbar-brand text-lg-center">
            <a href="{{ route('dashboard.index') }}">
                <img src="{{ asset('backend/img/logo.png') }}" alt="Logo" height="40">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="d-none d-lg-block text-center">
            <h4 class="menu-reaserch-hub pt-3 mt-2">@if(Auth::user()->hasRole('researcher')) My Research Hub:@elseif(Auth::user()->hasRole('participant')) My Participant Portal: @endif</h4>
        </div>
        @php
            $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName(); // Get the current route name
        @endphp
        <!-- Navigation Menu Items -->
        <div class="navbar-collapse collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav align-items-center main-nav-list pt-3 pt-lg-0">
                @if(Auth::user()->hasRole('participant'))
                <li class="nav-item @if($currentRoute == 'dashboard.index') active @endif px-2 me-lg-4">
                    <a class="nav-link ps-2 ps-lg-auto" href="{{ route('dashboard.index') }}"><i class="fa-solid fa-folder-open text-dark-blue me-2"></i><span>All Projects</span></a>
                </li>
                @endif
                <li class="nav-item @if($currentRoute == 'project.index') active @endif px-2 mx-lg-4">
                    <a class="nav-link ps-2 ps-lg-auto" href="{{ route('project.index') }}"><i class="fa-solid fa-chalkboard-user text-dark-blue me-2"></i><span>My Projects</span></a>
                </li>
                <li class="nav-item px-2 mx-lg-4 @if($currentRoute == 'messages.index') active @endif">
                    <a class="nav-link ps-2 ps-lg-auto" href="{{ route('messages.index') }}"><i class="fa-solid fa-comments text-dark-blue me-2"></i><span>My Messages</span></a>
                </li>
                <li class="nav-item @if($currentRoute == 'profile.index' ||  $currentRoute == 'profile.edit.contact' ||  $currentRoute == 'profile.edit.demographics' ||  $currentRoute == 'profile.edit.employment' ||  $currentRoute == 'profile.edit.skill') active @endif px-2 mx-lg-4">
                    <a class="nav-link ps-2 ps-lg-auto" href="{{ route('profile.index') }}"><i class="fa-solid fa-user-gear text-dark-blue me-2"></i><span>@if(Auth::user()->hasRole('researcher'))My Account Manager @elseif(Auth::user()->hasRole('participant'))My Profile Details @endif</span></a>
                </li>
                @if(Auth::user()->hasRole('researcher'))
                <li class="nav-item px-2 mx-lg-4">
                    <a class="nav-link ps-2 ps-lg-auto" href="{{ route('billing.index') }}"><i class="fa-solid fa-file-invoice-dollar text-dark-blue me-2"></i><span>My Billing Center</span></a>
                </li>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <li class="nav-item px-2 mx-lg-4 bg-danger rounded">
                        <button class="nav-link ps-2 ps-lg-auto text-light" href="#" ><i class="fa-solid fa-sign-out-alt me-2"></i><span>Logout</span></button>
                    </li>
                </form>
            </ul>
        </div>

    </div>
</nav>
