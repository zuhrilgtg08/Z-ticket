<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item {{ isset($isActive) && $isActive === 'dashboard' ? 'active' : '' }}">
            <a class="nav-link " href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ isset($isMaster) && $isMaster === true ? '' : 'collapsed'}}" data-bs-target="#components-nav" 
                data-bs-toggle="collapse" href="#" 
                aria-expanded="{{ isset($isMaster) && $isMaster === true ? 'false' : 'true' }}">
                <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse {{ isset($isMaster) && $isMaster === true ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('data_categories.index') }}" class="{{ isset($isActive) && $isActive === 'menu.kategori' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('data_tiket.index') }}" class="{{ isset($isActive) && $isActive === 'menu.tiket' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Tiket</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('data_hotel.index') }}" class="{{ isset($isActive) && $isActive === 'menu.hotel' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Hotel</span>
                    </a>
                </li>
                <li>
                    <a href="" class="{{ isset($isActive) && $isActive === 'menu.account' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Account Users</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-heading">Laporan</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-filetype-m4p"></i>
                <span>Pesanan Users</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-award"></i>
                <span>Reviews</span>
            </a>
        </li>
    </ul>
</aside>