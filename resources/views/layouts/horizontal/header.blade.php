<header class='container-fluid container-xxl d-flex align-items-stretch justify-content-between'>
    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
        <a href="/" class="text-decoration-none horizontal-sidebar-logo d-flex align-items-center pe-xl-8">
            <div class="image image-mini me-3">
                <img src="{{asset(getAppLogo())}}"
                     class="img-fluid" alt="profile image">
            </div>
            <span class="text-gray-900 fs-4 d-none d-sm-block">{{getAppName()}}</span>
        </a>
    </div>
    <div class="d-flex align-items-stretch justify-content-xl-between justify-content-end flex-grow-1">
        <nav class="navbar navbar-expand-xl navbar-light horizontal-sidebar d-xl-flex d-block align-items-stretch py-3 py-xl-0"
             id="nav-header">
            @include('layouts.horizontal.sidebar')
        </nav>
        <ul class="nav align-items-stretch flex-nowrap">
            @impersonating
            <li class="px-xxl-3 px-2 d-flex align-items-center">
            <span class="text-primary">
                <a data-turbo="false" data-turbo-eval="false" href="{{ route('impersonate.leave') }}" class="">
                    <i class="fas fa-user-check fs-2"></i>
                </a>
            </span>
            </li>
            @endImpersonating
            <li class="px-xxl-3 px-2 d-flex align-items-stretch">
                @if(Auth::user()->theme_mode)
                    <a href="javascript:void(0)" title="Switch to Light mode" class="d-flex align-items-center"><i
                                class="fa-solid fa-moon text-primary fs-2 apply-dark-mode "></i></a>
                @else
                    <a href="javascript:void(0)" title="Switch to Dark mode" class="d-flex align-items-center"><i
                                class="fa-solid fa-sun text-primary fs-2 apply-dark-mode"></i></a>
                @endif
            </li>
            <li class="px-xxl-3 px-2 d-flex align-items-stretch">
                <div class="dropdown custom-dropdown d-flex align-items-stretch">
                    <button class="btn dropdown-toggle hide-arrow p-0 d-flex align-items-center"
                            type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="position-relative">
                            <i class="fa-solid fa-bell text-primary fs-2"></i>
                            <span
                                    class="position-absolute top-0 start-100 translate-middle badge badge-circle bg-danger">
                                9
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </div>
                    </button>
                    <div class="dropdown-menu py-0" aria-labelledby="dropdownMenuButton1">
                        <div class="text-start border-bottom py-4 px-7">
                            <h3 class="text-gray-900 mb-0">Notifications</h3>
                        </div>
                        <div class="px-7 mt-5 inner-scroll height-270">
                            <div class="d-flex position-relative mb-5">
                                <span class="me-5 text-primary fs-2 icon-label"><i
                                            class="fa-solid fa-id-card"></i></span>
                                <div>
                                    <h5 class="text-gray-900 fs-6 mb-2">Company Retro Luxury marked as featured</h5>
                                    <h6 class="text-gray-600 fs-small fw-light mb-0">Today</h6>
                                </div>
                            </div>
                            <div class="d-flex position-relative mb-5">
                                <span class="me-5 text-primary fs-2 icon-label"><i
                                            class="fa-solid fa-user-group"></i></span>
                                <div>
                                    <h5 class="text-gray-900 fs-6 mb-2">New Candidate Registered</h5>
                                    <h6 class="text-gray-600 fs-small fw-light mb-0">2 Days</h6>
                                </div>
                            </div>
                            <div class="d-flex position-relative mb-5">
                                <span class="me-5 text-primary fs-2 icon-label"><i
                                            class="fa-solid fa-cart-shopping"></i></span>
                                <div>
                                    <h5 class="text-gray-900 fs-6 mb-2">Freshcode Technology purchase Standard Plan</h5>
                                    <h6 class="text-gray-600 fs-small fw-light mb-0">2 Weeks</h6>
                                </div>
                            </div>
                            <div class="d-flex position-relative mb-5">
                                <span class="me-5 text-primary fs-2 icon-label"><i
                                            class="fa-solid fa-user-group"></i></span>
                                <div>
                                    <h5 class="text-gray-900 fs-6 mb-2">New Employer Registered</h5>
                                    <h6 class="text-gray-600 fs-small fw-light mb-0">1 Month</h6>
                                </div>
                            </div>
                        </div>
                        <div class="text-center border-top p-4">
                            <h5 class="text-primary mb-0 fs-5">Mark All As Read</h5>
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
                                <a class="dropdown-item text-gray-900" href="{{route('user.twofactor.auth')}}">
                                <span class="dropdown-icon me-4 text-gray-600">
                                    <i class="fa-solid fa-user-lock"></i>
                                </span>
                                    {{ __('2FA Security') }}
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
            {{--            <li class="px-xxl-3 px-2 d-flex align-items-stretch">--}}
            {{--                <div class="dropdown dropdown-transparent d-flex align-items-stretch">--}}
            {{--                    <button class="btn dropdown-toggle px-0 text-gray-600 d-flex align-items-center" type="button"--}}
            {{--                            id="dropdownMenuButton1"--}}
            {{--                            data-bs-toggle="dropdown" aria-expanded="false">--}}
            {{--                        <div class="image image-circle image-mini d-flex align-items-center me-sm-3">--}}
            {{--                            <img src="{{asset('images/profile.png')}}"--}}
            {{--                                 class="img-fluid" alt="profile image">--}}
            {{--                        </div>--}}
            {{--                        Super Admin--}}
            {{--                        <i class="fa-solid fa-angle-down ms-2"></i>--}}
            {{--                    </button>--}}
            {{--                    <div class="dropdown-menu py-7 pb-4" aria-labelledby="dropdownMenuButton1">--}}
            {{--                        <div class="text-center border-bottom pb-5 ">--}}
            {{--                            <div class="image image-circle image-tiny mb-5">--}}
            {{--                                <img src="{{asset('images/avatar.png')}}" class="img-fluid" alt="profile image">--}}
            {{--                            </div>--}}
            {{--                            <h3 class="text-gray-900">Super Admin</h3>--}}
            {{--                            <h4 class="mb-0 fw-400 fs-6">admin@infyhms.com</h4>--}}
            {{--                        </div>--}}
            {{--                        <ul class="pt-4">--}}
            {{--                            <li>--}}
            {{--                                <a class="dropdown-item text-gray-900" href="#">--}}
            {{--                                <span class="dropdown-icon me-4 text-gray-600">--}}
            {{--                                    <i class="fa-solid fa-user"></i>--}}
            {{--                                </span>--}}
            {{--                                    Edit Profile--}}
            {{--                                </a>--}}
            {{--                            </li>--}}
            {{--                            <li>--}}
            {{--                                <a class="dropdown-item text-gray-900" href="#">--}}
            {{--                                <span class="dropdown-icon me-4 text-gray-600">--}}
            {{--                                    <i class="fa-solid fa-lock"></i>--}}
            {{--                                </span>--}}
            {{--                                    Change Password--}}
            {{--                                </a>--}}
            {{--                            </li>--}}
            {{--                            <li>--}}
            {{--                                <div class="dropdown dropdown-hover">--}}
            {{--                                    <a class="dropdown-item text-gray-900" href="#">--}}
            {{--                                        <span class="dropdown-icon me-4 text-gray-600">--}}
            {{--                                            <i class="fa-solid fa-globe"></i>--}}
            {{--                                        </span>--}}
            {{--                                        Change Language--}}
            {{--                                    </a>--}}
            {{--                                    <ul class="dropdown-menu rounded-10 px-5 py-3 d-block end-100">--}}
            {{--                                        <li>--}}
            {{--                                            <a class="dropdown-item text-gray-900 text-hover-primary" href="#">--}}
            {{--                                                English--}}
            {{--                                            </a>--}}
            {{--                                        </li>--}}
            {{--                                        <li>--}}
            {{--                                            <a class="dropdown-item text-gray-900 text-hover-primary" href="#">--}}
            {{--                                                Arabic--}}
            {{--                                            </a>--}}
            {{--                                        </li>--}}
            {{--                                        <li>--}}
            {{--                                            <a class="dropdown-item text-gray-900 text-hover-primary" href="#">--}}
            {{--                                                Chinese--}}
            {{--                                            </a>--}}
            {{--                                        </li>--}}
            {{--                                        <li>--}}
            {{--                                            <a class="dropdown-item text-gray-900 text-hover-primary" href="#">--}}
            {{--                                                Spanish--}}
            {{--                                            </a>--}}
            {{--                                        </li>--}}
            {{--                                        <li>--}}
            {{--                                            <a class="dropdown-item text-gray-900 text-hover-primary" href="#">--}}
            {{--                                                German--}}
            {{--                                            </a>--}}
            {{--                                        </li>--}}
            {{--                                        <li>--}}
            {{--                                            <a class="dropdown-item text-gray-900 text-hover-primary" href="#">--}}
            {{--                                                Gujarati--}}
            {{--                                            </a>--}}
            {{--                                        </li>--}}
            {{--                                    </ul>--}}
            {{--                                </div>--}}
            {{--                            </li>--}}
            {{--                            <li>--}}
            {{--                                <a class="dropdown-item text-gray-900" href="#">--}}
            {{--                                <span class="dropdown-icon me-4 text-gray-600">--}}
            {{--                                    <i class="fa-solid fa-right-from-bracket"></i>--}}
            {{--                                </span>--}}
            {{--                                    Logout--}}
            {{--                                </a>--}}
            {{--                            </li>--}}
            {{--                        </ul>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </li>--}}
            <li class="d-flex align-items-center">
                <button type="button" class="btn px-0 horizontal-menubar d-block d-xl-none text-gray-600">
                    <i class="fa-solid fa-bars fs-1"></i>
                </button>
            </li>
        </ul>
    </div>
</header>
<div class="bg-overlay" id="horizontal-menubar-overly"></div>
