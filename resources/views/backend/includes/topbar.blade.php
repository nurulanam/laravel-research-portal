@php
    $avatar = App\Http\Controllers\backend\ProfileController::showAvatar();
@endphp

{{--<nav class="navbar navbar-expand-lg navbar-light bg-white topbar mb-4 static-top shadow">--}}
{{--    <a class="navbar-brand" href="#">--}}
{{--        <img src="{{ asset('backend/img/logo.png') }}" class="w-75" alt="logo">--}}
{{--    </a>--}}
{{--    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">--}}
{{--        <i class="fa fa-bars"></i>--}}
{{--    </button>--}}

{{--    <div class="collapse navbar-collapse" id="sidebarToggleTop">--}}
{{--    <!-- Sidebar Toggle (Topbar) -->--}}

{{--        <ul class="navbar-nav mr-auto">--}}
{{--            <li class="nav-item active">--}}
{{--                <a class="nav-link" href="{{ route('dashboard.index') }}" style="line-height: ">--}}
{{--                    <i class="fas fa-fw fa-tachometer-alt mr-2"></i>--}}
{{--                    <span>Dashboard</span></a>--}}
{{--            </li>--}}
{{--        </ul>--}}

{{--    <!-- Topbar Navbar -->--}}
{{--        <ul class="navbar-nav ml-auto">--}}
{{--        <!-- Nav Item - User Information -->--}}
{{--        @if(Auth::user()->hasRole('researcher'))--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ route('project.create') }}">--}}
{{--                <button class="btn btn-primary btn-custom"><span class="mx-2"><i class="fas fa-plus"></i></span>New Project</button>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        @endif--}}
{{--        <li class="nav-item dropdown no-arrow">--}}
{{--            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"--}}
{{--               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                <div class="d-flex justify-content-start">--}}
{{--                    <div class="user-info">--}}
{{--                        <span class="mr-2 d-none d-lg-block text-gray-600 font-weight-bold small">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</span>--}}
{{--                        @foreach(Auth::user()->roles->pluck('name') as $role)--}}
{{--                            <span class="mr-2 d-none d-lg-block text-gray-600 small">{{ $role  }}</span>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}

{{--                    @if(!empty($avatar))--}}
{{--                        @if($avatar->user_avatar == null)--}}
{{--                            <img src="{{ asset('backend/img/profile/undraw_profile.svg') }}" class="img-profile rounded-circle img-32" alt="profile-picture">--}}
{{--                        @elseif($avatar->user_avatar !== null)--}}
{{--                            <img src="{{ asset('backend/img/profile/'.$avatar->user_avatar) }}" class="img-profile rounded-circle img-32" alt="profile-picture">--}}
{{--                        @endif--}}
{{--                    @elseif(empty($avatar))--}}
{{--                        <img src="{{ asset('backend/img/profile/undraw_profile.svg') }}" class="img-profile rounded-circle img-32" alt="profile-picture">--}}
{{--                    @endif--}}
{{--                </div>--}}

{{--            </a>--}}
{{--            <!-- Dropdown - User Information -->--}}
{{--            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"--}}
{{--                 aria-labelledby="userDropdown">--}}
{{--                <a class="dropdown-item" href="{{ route('profile.index') }}">--}}
{{--                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--                    Profile--}}
{{--                </a>--}}
{{--                <a class="dropdown-item" href="{{ route('change-password.index') }}">--}}
{{--                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--                    Change Password--}}
{{--                </a>--}}
{{--                <a class="dropdown-item" href="#">--}}
{{--                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--                    Notification--}}
{{--                </a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <form method="POST" action="{{ route('logout') }}">--}}
{{--                    @csrf--}}
{{--                    <button class="dropdown-item">--}}
{{--                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--                        Logout--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--    </div>--}}
{{--</nav>--}}

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top mb-4 shadow">
    <a class="navbar-brand" href="{{ route('dashboard.index') }}">
        <img src="{{ asset('backend/img/logo.png') }}" class="w-75" alt="logo">
    </a>
    <button class="navbar-toggler ml-auto border-0 rounded-circle" type="button" data-toggle="collapse" data-target="#topNavDropdown" aria-controls="topNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars text-dark"></i>
    </button>
    <div class="collapse navbar-collapse rounded " id="topNavDropdown" style="z-index: 99;">
        <ul class="navbar-nav font-15 mr-auto pl-2 pl-lg-0">
            <li class="nav-item active">
                <a class="nav-link text-dark" href="{{ route('dashboard.index') }}    ">
                    <i class="fas fa-fw fa-tachometer-alt color-yellow mr-2"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('project.index') }}" >
                    <i class="fas fa-fw fa-folder mr-2"></i>
                    <span>Projects</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#" >
                    <i class="fas fa-fw fa-comments mr-2"></i>
                    <span>Messages</span>
                </a>
            </li>
            @if(Auth::user()->hasRole('researcher'))
                <!-- Nav Item - Billing Menu -->
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#" >
                        <i class="fas fa-fw fa-credit-card mr-2"></i>
                        <span>Billing</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#" >
                        <i class="fas fa-fw fa-cogs mr-2"></i>
                        <span>Manage Organization</span>
                    </a>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav ml-auto">
            @if(Auth::user()->hasRole('researcher'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('project.create') }}">
                        <button class="btn btn-primary btn-custom"><span class="mx-2"><i class="fas fa-plus"></i></span>New Project</button>
                    </a>
                </li>

            @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle no-arrow mt-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class=" d-flex justify-content-start align-items-center">
                            <div class="user-info ml-3 ml-lg-0 order-1 order-lg-0">
                                <span class="mr-2 d-block text-gray-600 font-weight-bold small">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</span>
                                @foreach(Auth::user()->roles->pluck('name') as $role)
                                    <span class="mr-2 d-block text-gray-600 small">{{ $role  }}</span>
                                @endforeach
                            </div>

                            @if(!empty($avatar))
                                @if($avatar->user_avatar == null)
                                    <img src="{{ asset('backend/img/profile/undraw_profile.svg') }}" class="img-profile rounded-circle img-32 order-0 order-lg-1" alt="profile-picture">
                                @elseif($avatar->user_avatar !== null)
                                    <img src="{{ asset('backend/img/profile/'.$avatar->user_avatar) }}" class="img-profile rounded-circle img-32 order-0 order-lg-1" alt="profile-picture">
                                @endif
                            @elseif(empty($avatar))
                                <img src="{{ asset('backend/img/profile/undraw_profile.svg') }}" class="img-profile rounded-circle img-32 order-0 order-lg-1" alt="profile-picture">
                            @endif
                        </div>
                    </a>
                    <div class="dropdown-menu drop-position shadow animated--grow-in" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('change-password.index') }}">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Notification
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
        </ul>
    </div>
{{--    <div class="dropdown no-arrow">--}}
{{--        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"--}}
{{--           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--            <div class="d-flex justify-content-start">--}}
{{--                <div class="user-info">--}}
{{--                    <span class="mr-2 d-none d-lg-block text-gray-600 font-weight-bold small">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</span>--}}
{{--                    @foreach(Auth::user()->roles->pluck('name') as $role)--}}
{{--                        <span class="mr-2 d-none d-lg-block text-gray-600 small">{{ $role  }}</span>--}}
{{--                    @endforeach--}}
{{--                </div>--}}

{{--                @if(!empty($avatar))--}}
{{--                    @if($avatar->user_avatar == null)--}}
{{--                        <img src="{{ asset('backend/img/profile/undraw_profile.svg') }}" class="img-profile rounded-circle img-32" alt="profile-picture">--}}
{{--                    @elseif($avatar->user_avatar !== null)--}}
{{--                        <img src="{{ asset('backend/img/profile/'.$avatar->user_avatar) }}" class="img-profile rounded-circle img-32" alt="profile-picture">--}}
{{--                    @endif--}}
{{--                @elseif(empty($avatar))--}}
{{--                    <img src="{{ asset('backend/img/profile/undraw_profile.svg') }}" class="img-profile rounded-circle img-32" alt="profile-picture">--}}
{{--                @endif--}}
{{--            </div>--}}

{{--        </a>--}}
{{--                <!-- Dropdown - User Information -->--}}
{{--        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"--}}
{{--             aria-labelledby="userDropdown">--}}
{{--            <a class="dropdown-item" href="{{ route('profile.index') }}">--}}
{{--                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--                Profile--}}
{{--            </a>--}}
{{--            <a class="dropdown-item" href="{{ route('change-password.index') }}">--}}
{{--                <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--                Change Password--}}
{{--            </a>--}}
{{--            <a class="dropdown-item" href="#">--}}
{{--                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--                Notification--}}
{{--            </a>--}}
{{--            <div class="dropdown-divider"></div>--}}
{{--            <form method="POST" action="{{ route('logout') }}">--}}
{{--                @csrf--}}
{{--                <button class="dropdown-item">--}}
{{--                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--                    Logout--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}


</nav>
