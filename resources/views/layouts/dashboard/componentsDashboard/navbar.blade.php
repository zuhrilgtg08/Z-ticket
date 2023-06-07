<!-- Topbar -->
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="/dashboard" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
            <span class="d-none d-lg-block">Admin Dashboard</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    @if (auth()->user()->profile)
                        <img src="{{ asset('storage/' . auth()->user()->profile) }}" alt="Profile" class="rounded-circle">
                    @else
                        <img src="{{ asset('assets/img/users.png') }}" alt="Profile" class="rounded-circle">
                    @endif
                    <span class="d-none d-md-block dropdown-toggle ps-2">Selamat Datang, Admin</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="/home">
                            <i class="bi bi-house"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard.editProfile', auth()->user()->id == 1) }}">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
</header><!-- End Header -->
<!-- End of Topbar -->


<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="logoutModal">Logout Dashboard?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="modal-body">Yakin Ingin Logout dari Dashboard ? </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-arrow-right-circle"></i> Logout</button>
                </div>
            </form>
        </div>
    </div>
</div>