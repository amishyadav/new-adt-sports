<div class="aside-menu-container" id="sidebar">
    <div class="aside-menu-container__aside-logo flex-column-auto">
        <a href="/" class="text-decoration-none sidebar-logo d-flex align-items-center">
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
            <input class="form-control" type="search" placeholder="{{ __('messages.common.search') }}" aria-label="Search">
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
                    <span class="aside-menu-title">{{ __('messages.common.dashboard') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/users') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center py-3" aria-current="page"
                   href="{{route('users.index')}}">
                    <span class="aside-menu-icon pe-3"><i class="fas fa-users"></i></span>
                    <span class="aside-menu-title">{{__('messages.user.user')}}</span>
                </a>
            </li>
            @can('manage_categories')
            <li class="nav-item {{ Request::is('admin/categories') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center py-3" aria-current="page"
                   href="{{route('categories.index')}}">
                    <span class="aside-menu-icon pe-3"><i class="fa-solid fa-bars"></i></span>
                    <span class="aside-menu-title">{{ __('messages.common.categories') }}</span>
                </a>
            </li>
            @endcan
            @can('manage_leagues')
            <li class="nav-item {{ Request::is('admin/leagues') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center py-3" aria-current="page"
                   href="{{route('leagues.index')}}">
                    <span class="aside-menu-icon pe-3"><i class="fa-solid fa-baseball"></i></span>
                    <span class="aside-menu-title">{{ __('messages.common.leagues') }}</span>
                </a>
            </li>
            @endcan
            @can('manage_matches')
            <li class="nav-item {{ Request::is('admin/all-matches','admin/onesignal-send') ? 'show' : '' }}">
                <a class="nav-link aside-collapse-btn d-flex align-items-center py-3">
                    <span class="aside-menu-icon pe-3"><i class="fa-solid fa-gamepad"></i></span>
                    <span class="aside-menu-title">{{ __('messages.common.manage_matches') }}</span>
                    <span class="aside-menu-collapse-icon ms-auto fs-4">
                        <i class="fa-solid fa-angle-right"></i>
                    </span>
                </a>
                <ul class="aside-submenu">
                    <li class="nav-item {{ Request::is('admin/all-matches') ? 'active' : '' }}">
                        <a class="nav-link d-flex align-items-center py-3"
                           href="{{ route('all-matches.index') }}">
                            <span class="aside-menu-icon pe-3"><i class="fa-sharp fa-solid fa-gears"></i></span>
                            <span class="aside-menu-title">{{ __('messages.matches.all_matches') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('manage_settings')
            <li class="nav-item {{ Request::is('admin/setting') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center py-3" aria-current="page"
                   href="{{route('settings.index')}}">
                    <span class="aside-menu-icon pe-3"><i class="fas fa-cog fs-4"></i></span>
                    <span class="aside-menu-title">{{__('messages.setting.setting')}}</span>
                </a>
            </li>
            @endcan
            @can('manage_roles')
                <li class="nav-item {{ Request::is('admin/roles') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center py-3" aria-current="page"
                       href="{{route('roles.index')}}">
                        <span class="aside-menu-icon pe-3"><i class="fa fa-user"></i></span>
                        <span class="aside-menu-title">{{__('messages.role.role')}}</span>
                    </a>
                </li>
            @endcan
            <li class="nav-item {{ Request::is('admin/blog','admin/faqs','admin/partner','admin/social-icon') ? 'show' : '' }}">
                <a class="nav-link aside-collapse-btn d-flex align-items-center py-3">
                    <span class="aside-menu-icon pe-3"><i class="fa-solid fa-mobile"></i></span>
                    <span class="aside-menu-title">CMS</span>
                    <span class="aside-menu-collapse-icon ms-auto fs-4">
                        <i class="fa-solid fa-angle-right"></i>
                    </span>
                </a>
                <ul class="aside-submenu">
                    <li class="nav-item {{ Request::is('admin/blog') ? 'active' : '' }}">
                        <a class="nav-link d-flex align-items-center py-3"
                           href="{{ route('blog.index') }}">
                            <span class="aside-menu-icon pe-3"><i class="fa-solid fa-blog"></i></span>
                            <span class="aside-menu-title">Blogs</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/faqs') ? 'active' : '' }}">
                        <a class="nav-link d-flex align-items-center py-3"
                           href="{{ route('faqs.index') }}">
                            <span class="aside-menu-icon pe-3"><i class="fa-sharp fa-solid fa-question"></i></span>
                            <span class="aside-menu-title">FAQs</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/partner') ? 'active' : '' }}">
                        <a class="nav-link d-flex align-items-center py-3"
                           href="{{ route('partner.index') }}">
                            <span class="aside-menu-icon pe-3"><i class="fa-solid fa-handshake-simple"></i></span>
                            <span class="aside-menu-title">Partners</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/social-icon') ? 'active' : '' }}">
                        <a class="nav-link d-flex align-items-center py-3"
                           href="{{ route('social-icon.index') }}">
                            <span class="aside-menu-icon pe-3"><i class="fa-sharp fa-solid fa-circle-dot"></i></span>
                            <span class="aside-menu-title">Social Icon</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<div class="bg-overlay" id="sidebar-overly"></div>
