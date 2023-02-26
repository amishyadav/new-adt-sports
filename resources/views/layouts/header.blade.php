<header class='d-flex align-items-center justify-content-between flex-grow-1 header px-4 px-lg-7 px-xl-0'>
    <button type="button" class="btn px-0 aside-menu-container__aside-menubar text-gray-600 d-block d-xl-none sidebar-btn">
        <i class="fa-solid fa-bars fs-1"></i>
    </button>
    <nav class="navbar navbar-expand-xl navbar-light top-navbar d-xl-flex d-block px-3 px-xl-0 py-4 py-xl-0 "
         id="nav-header">
        <div class="container-fluid pe-0">
            <div class="navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if(Request::is('admin/dashboard*'))
                    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0">
                        <a class="nav-link p-0 {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
                           href="{{ route('admin.dashboard') }}">{{ __('messages.common.dashboard') }}</a>
                    </li>
                    @elseif(Request::is('admin/categories*'))
                        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0">
                            <a class="nav-link p-0 {{ Request::is('admin/categories*') ? 'active' : '' }}"
                               href="{{ route('categories.index') }}">{{ __('messages.common.categories') }}</a>
                        </li>
                    @elseif(Request::is('admin/leagues*'))
                        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0">
                            <a class="nav-link p-0 {{ Request::is('admin/leagues*') ? 'active' : '' }}"
                               href="{{ route('leagues.index') }}">{{ __('messages.common.leagues') }}</a>
                        </li>
                    @elseif(Request::is('admin/all-matches*'))
                        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0">
                            <a class="nav-link p-0 {{ Request::is('admin/all-matches*') ? 'active' : '' }}"
                               href="{{ route('all-matches.index') }}">{{ __('messages.matches.all_matches') }}</a>
                        </li>
                    @elseif(Request::is('admin/settings*') || Request::is('admin/currencies*') || Request::is('admin/cookie*'))
                        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0">
                            <a class="nav-link p-0 {{ Request::is('admin/settings*') ? 'active' : '' }}"
                               href="{{ route('settings.index') }}">{{__('messages.setting.setting')}}</a>
                        </li>

                        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0">
                            <a class="nav-link p-0 {{ Request::is('admin/cookie*') ? 'active' : '' }}"
                               href="{{ route('cookie-index') }}">{{__('messages.cookie.cookies')}}</a>
                        </li>
                    @elseif(Request::is('admin/roles*'))
                        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0">
                            <a class="nav-link p-0 {{ Request::is('admin/roles*') ? 'active' : '' }}"
                               href="{{ route('roles.index') }}">{{__('messages.role.role')}}</a>
                        </li>
                    @elseif(Request::is('admin/users*'))
                        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0">
                            <a class="nav-link p-0 {{ Request::is('admin/users*') ? 'active' : '' }}"
                               href="{{ route('users.index') }}">{{__('messages.user.user')}}</a>
                        </li>
                    @elseif(Request::is('admin/blog*'))
                        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0">
                            <a class="nav-link p-0 {{ Request::is('admin/blog*') ? 'active' : '' }}"
                               href="{{ route('blog.index') }}">{{__('messages.common.blog')}}</a>
                        </li>
                    @elseif(Request::is('admin/faqs*'))
                        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0">
                            <a class="nav-link p-0 {{ Request::is('admin/faqs*') ? 'active' : '' }}"
                               href="{{ route('faqs.index') }}">{{__('messages.faqs.faq')}}</a>
                        </li>
                    @elseif(Request::is('admin/partner*'))
                        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0">
                            <a class="nav-link p-0 {{ Request::is('admin/partner*') ? 'active' : '' }}"
                               href="{{ route('partner.index') }}">{{__('messages.common.partner')}}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <ul class="nav align-items-stretch flex-nowrap">

        <li class="px-xxl-3 px-2 mt-4">

            @if(Auth::user()->theme_mode)
                <a href="javascript:void(0)" title="Switch to Light mode"><i
                            class="fa-solid fa-moon text-primary fs-2 apply-dark-mode"></i></a>
            @else
                <a href="javascript:void(0)" title="Switch to Dark mode"><i
                            class="fa-solid fa-sun text-primary fs-2 apply-dark-mode"></i></a>
            @endif
        </li>
        <li class="px-xxl-3 px-2">
            <div class="dropdown custom-dropdown d-flex align-items-center py-4">
                <button class="btn dropdown-toggle hide-arrow p-0 position-relative" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-bell text-primary fs-2"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge badge-circle bg-danger">
                        9
                        <span class="visually-hidden">{{ __('messages.notification.unread_messages') }}</span>
                    </span>
                </button>
                <div class="dropdown-menu py-0 my-2" aria-labelledby="dropdownMenuButton1">
                    <div class="text-start border-bottom py-4 px-7">
                        <h3 class="text-gray-900 mb-0">{{ __('messages.notification.notifications') }}</h3>
                    </div>
                    <div class="px-7 mt-5 inner-scroll height-270">
                        <div class="d-flex position-relative mb-5">
                            <span class="me-5 text-primary fs-2 icon-label"><i class="fa-solid fa-id-card"></i></span>
                            <div>
                                <h5 class="text-gray-900 fs-6 mb-2">Company Retro Luxury marked as featured</h5>
                                <h6 class="text-gray-600 fs-small fw-light mb-0">Today</h6>
                            </div>
                        </div>
                        <div class="d-flex position-relative mb-5">
                            <span class="me-5 text-primary fs-2 icon-label"><i class="fa-solid fa-user-group"></i></span>
                            <div>
                                <h5 class="text-gray-900 fs-6 mb-2">New Candidate Registered</h5>
                                <h6 class="text-gray-600 fs-small fw-light mb-0">2 Days</h6>
                            </div>
                        </div>
                        <div class="d-flex position-relative mb-5">
                            <span class="me-5 text-primary fs-2 icon-label"><i class="fa-solid fa-cart-shopping"></i></span>
                            <div>
                                <h5 class="text-gray-900 fs-6 mb-2">Freshcode Technology purchase Standard Plan</h5>
                                <h6 class="text-gray-600 fs-small fw-light mb-0">2 Weeks</h6>
                            </div>
                        </div>
                        <div class="d-flex position-relative mb-5">
                            <span class="me-5 text-primary fs-2 icon-label"><i class="fa-solid fa-user-group"></i></span>
                            <div>
                                <h5 class="text-gray-900 fs-6 mb-2">New Employer Registered</h5>
                                <h6 class="text-gray-600 fs-small fw-light mb-0">1 Month</h6>
                            </div>
                        </div>
                    </div>
                    <div class="text-center border-top p-4">
                        <h5 class="text-primary mb-0 fs-5">{{ __('messages.notification.mark_all_as_read') }}</h5>
                    </div>
                </div>
            </div>
        </li>
        <li class="px-xxl-3 px-2 d-flex align-items-stretch">
            <div class="dropdown dropdown-transparent d-flex align-items-stretch">
                <button class="btn dropdown-toggle px-0 text-gray-600 d-flex align-items-center" type="button"
                        id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="image image-circle image-mini d-flex align-items-center me-sm-3">
                        <img src="{{asset('images/avatar.png')}}"
                             class="img-fluid" alt="profile image">
                    </div>
                    {{ getLogInUser()->full_name }}
                    <i class="fa-solid fa-angle-down ms-2"></i>
                </button>
                <div class="dropdown-menu py-7 pb-4" aria-labelledby="dropdownMenuButton1">
                    <div class="text-center border-bottom pb-5 ">
                        <div class="image image-circle image-tiny mb-5">
                            <img src="{{asset('images/avatar.png')}}" class="img-fluid" alt="profile image">
                        </div>
                        <h3 class="text-gray-900"> {{ getLogInUser()->full_name }}</h3>
                        <h4 class="mb-0 fw-400 fs-6"> {{ getLogInUser()->email }}</h4>
                    </div>
                    <ul class="pt-4">
                        <li>
                            <a class="dropdown-item text-gray-900" href="{{route('profile.setting')}}">
                                <span class="dropdown-icon me-4 text-gray-600">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                {{ __('messages.user.edit_profile') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-gray-900" href="javascript:void(0)"
                               data-bs-toggle="modal"
                               data-bs-target="#changePasswordModal">
                                <span class="dropdown-icon me-4 text-gray-600">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                {{ __('messages.user.change_password') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-gray-900" id="changeLanguage" href="javascript:void(0)">
                               <span class="dropdown-icon me-4 text-gray-600">
                                   <i class="fa-solid fa-globe"></i>
                               </span>
                                {{ __('messages.user.change_language') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-gray-900" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                                <span class="dropdown-icon me-4 text-gray-600">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </span>
                                {{ __('messages.user.logout') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    {{ csrf_field() }}
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>

        <li class="d-flex align-items-center">
            <button type="button" class="btn px-0 horizontal-menubar d-block d-xl-none text-gray-600">
                <i class="fa-solid fa-bars fs-1"></i>
            </button>
        </li>
    </ul>
</header>
<div class="bg-overlay" id="nav-overly"></div>
