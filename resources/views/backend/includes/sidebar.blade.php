<ul class="navbar-nav bg-dark-blue sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center px-2" href="{{ route('dashboard.index') }}">
        <img src="{{ asset('backend/img/logo-third-estate-research.png') }}" class="w-75" alt="logo">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard.index') }}    ">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Main Menu
    </div>

    <!-- Nav Item - Projects Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" >
            <i class="fas fa-fw fa-folder"></i>
            <span>Projects</span>
        </a>
    </li>

    <!-- Nav Item - Messages Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" >
            <i class="fas fa-fw fa-comments"></i>
            <span>Messages</span>
        </a>
    </li>
    @if(Auth::user()->hasRole('researcher'))
        <!-- Nav Item - Billing Menu -->
        <li class="nav-item">
            <a class="nav-link" href="#" >
                <i class="fas fa-fw fa-credit-card"></i>
                <span>Billing</span>
            </a>
        </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>

    @if(Auth::user()->hasRole('researcher'))
    <!-- Nav Item - Manage Organization Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" >
            <i class="fas fa-fw fa-cogs"></i>
            <span>Manage Organization</span>
        </a>
    </li>
    @endif
    <!-- Nav Item - My Account -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMyAccount"
           aria-expanded="true" aria-controls="collapseMyAccount">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>My Account</span>
        </a>
        <div id="collapseMyAccount" class="collapse" aria-labelledby="headingMyAccount"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('profile.index') }}">Edit Profile</a>
                <a class="collapse-item" href="{{ route('change-password.index') }}">Change Password</a>
                <a class="collapse-item" href="#">Notification</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
