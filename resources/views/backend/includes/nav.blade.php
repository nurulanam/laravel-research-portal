@php
    $avatar = App\Http\Controllers\backend\ProfileController::showAvatar();
@endphp
{{--main navigation start--}}
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg fixed-top">
    <div class="container d-lg-block justify-content-lg-center mx-lg-auto">
        <!-- Centered Logo -->
        <div class="navbar-brand text-lg-center">
            <a href="{{ route('dashboard.index') }}">
                <img src="{{ asset('backend/img/logo.png') }}" alt="Logo" height="40">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu Items (Centered on larger screens) -->
        <div class="navbar-collapse collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('project.index') }}"><i class="fa-solid fa-folder-open me-1"></i><span>My Projects</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-comments me-1"></i><span>My Messages</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-user-gear me-1"></i><span>My Account Manager</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-file-invoice-dollar me-1"></i><span>My Billing Center</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
