<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand h2 logo align-self-center" href="/home" style="color: #69bb7e;">
            Z-Ticket
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

            <div class="collapse navbar-collapse" id="templatemo_main_nav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}" href="/categories">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('explore') ? 'active' : '' }}" href="/explore">Explore</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('cart') ? 'active' : '' }}" href="/cart"" href="#"><i class="bi bi-cart-fill"></i> 
                                Cart
                                @if (!$keranjangs->isEmpty())
                                    <div class="badge rounded-pill bg-danger" style="padding: 2px 10px 0px;">
                                        <span>{{ $keranjangs->count() }}</span>
                                    </div>
                                @endif
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

        @auth
            <ul class="d-flex navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Selamat, Datang {{ auth()->user()->username }}

                        @if (auth()->user()->profile)
                            <img src="{{ asset('storage/' . auth()->user()->profile) }}" alt="profile" class="rounded-circle" width="40" height="40" />
                        @else
                            <img src="{{ asset('assets/img/users.png') }}" alt="profile" class="rounded-circle" width="40" height="40" />
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        @if(auth()->user()->id == 1)
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="bi bi-server"></i> Dashboard</a>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ route('edit.profile', auth()->user()->id) }}">
                                    <i class="bi bi-person-circle"></i> Edit Profile</a>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-clock-history"></i> History Orders</a>
                            </li>
                        @endif
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalLogout">
                                <i class="bi bi-box-arrow-in-right"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!--modal -->
            <div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Logout Akun</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <div class="modal-body">Yakin ingin logout akun anda ?</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cancel</button>
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-box-arrow-in-right"></i> Logout
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endauth

        @guest
            <ul class="navbar-nav ms-auto col-md-1">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="/login">
                        <i class="bi bi-person-circle"></i> Login</a>
                </li>
            </ul>
        @endguest
    </div>
</nav>
<!-- Close Header -->

