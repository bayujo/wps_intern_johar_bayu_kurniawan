<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="20">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="20">
                    </span>
                </a>
            </div>

            <button type="button"
                class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="assets/images/users/anony.png"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{Auth::user()->name}}</span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#" onclick="$('#logout-form').submit();"><i
                            class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">Sign out</span></a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;"> @csrf</form>
                </div>
            </div>

        </div>
    </div>
</header>

<div class="vertical-menu">
    <style>
        .logo-text {
            font-size: 24px; /* Adjust the font size as needed */
            font-weight: bold; /* Make the text bold */
        }
    </style>
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm logo-text">
                D
            </span>
            <span class="logo-lg logo-text">
                DAILYLOG
            </span>
        </a>
    
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm logo-text">
                D
            </span>
            <span class="logo-lg logo-text">
                DAILYLOG
            </span>
        </a>
    </div>
    

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('home') }}">
                        <i class="uil-home-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('log') }}">
                        <i class="uil-check"></i><span
                            class="badge rounded-pill bg-primary float-end">01</span>
                        <span>Verifikasi Log</span>
                    </a>
                </li>

                @if (Auth::user()->id != 1)
                <li>
                    <a href="{{ route('self') }}">
                        <i class="uil-window-section"></i><span
                            class="badge rounded-pill bg-primary float-end">01</span>
                        <span>Log Harian</span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->id == 1)
                <li>
                    <a href="{{ route('user') }}">
                        <i class="uil-user-circle"></i>
                        <span>Master User</span>
                    </a>
                </li>
                @endif


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>