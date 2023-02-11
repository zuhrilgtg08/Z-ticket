<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand h2 logo align-self-center text-success" href="/home">
            Z-ᖷricket
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @auth
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
                        <a class="nav-link {{ Request::is('shop') ? 'active' : '' }}" href="/shop">Shop</a>
                    </li>
                </ul>
            </div>
            <ul class="d-flex navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->username }}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-fw fa-user-circle"></i> Edit Profile</a>
                            </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-fw fa-arrow-circle-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        @endauth
    </div>
</nav>
<!-- Close Header -->