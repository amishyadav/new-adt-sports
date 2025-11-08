<div class="aside-menu-container" id="sidebar">
    <div class="aside-menu-container__aside-logo flex-column-auto">
        <a href="/" class="text-decoration-none sidebar-logo d-flex align-items-center" data-turbolinks="false">
            <div class="image image-mini me-3">
                <img src="{{ asset(getAppLogo()) }}"
                     class="img-fluid" alt="profile image">
            </div>
            <span class="text-gray-900 fs-4">{{ getAppName() }}</span>
        </a>
        <button type="button" class="btn px-0 text-gray-600 aside-menu-container__aside-menubar d-lg-block d-none sidebar-btn">
            <i class="fa-solid fa-bars fs-1"></i>
        </button>
    </div>
    <form class="d-flex position-relative aside-menu-container__aside-search search-control py-3 mt-1">
        <div class="position-relative w-100">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <span class="aside-menu-container__search-icon position-absolute d-flex align-items-center top-0 bottom-0">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
        </div>
    </form>
    <div class="sidebar-scrolling">
        <ul class="aside-menu-container__aside-menu nav flex-column">
            <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center py-3" aria-current="page"
                   href="{{ route('admin.dashboard') }}">
                    <span class="aside-menu-icon pe-3"><i class="fa-solid fa-chart-pie"></i></span>
                    <span class="aside-menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/users') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center py-3" aria-current="page" data-turbo-frame="_top"
                   href="{{route('users.index')}}" data-turbolinks-track="reload">
                    <span class="aside-menu-icon pe-3"><i class="fas fa-users"></i></span>
                    <span class="aside-menu-title">Users</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/teams') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center py-3" aria-current="page"
                   href="{{route('teams.index')}}">
                    <span class="aside-menu-icon pe-3"><i class="fas fa-user"></i></span>
                    <span class="aside-menu-title">Teams</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/matches') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center py-3" aria-current="page"
                   href="{{route('team-matches.index')}}">
                    <span class="aside-menu-icon pe-3"><i class="fa-solid fa-bars"></i></span>
                    <span class="aside-menu-title">Matches</span>
                </a>
            </li>
            @can('manage_settings')
            <li class="nav-item {{ Request::is('admin/setting') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center py-3" aria-current="page"
                   href="{{route('settings.index')}}">
                    <span class="aside-menu-icon pe-3"><i class="fas fa-cog fs-4"></i></span>
                    <span class="aside-menu-title">Settings</span>
                </a>
            </li>
            @endcan
            @can('manage_roles')
                <li class="nav-item {{ Request::is('admin/roles') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center py-3" aria-current="page"
                       href="{{route('roles.index')}}">
                        <span class="aside-menu-icon pe-3"><i class="fa fa-user"></i></span>
                        <span class="aside-menu-title">Roles</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
<div class="bg-overlay" id="sidebar-overly"></div>
