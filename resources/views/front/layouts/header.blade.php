<!-- Header -->
<header class="header style-3">

    <!-- Top bar -->
    <div class="topbar-and-logobar">
        <div class="container">

            <!-- Responsive Button -->
            <div class="responsive-btn pull-right">
                <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Responsive Button -->

        </div>
    </div>
    <!-- Top bar -->

    <!-- Nav -->
    <div class="nav-holder">
        <div class="container">
            <div class="maga-drop-wrap">

                <!-- Logo -->
                <div class="logo">
                    <a href="/"><img class="logo-image" src="{{asset(getAppLogo())}}" alt=""></a>
                </div>
                <!-- Logo -->
                <ul class="user-login-option pull-right">
                    <li class="login-modal">
{{--                        <a href="#" class="login new-login" data-toggle="modal" data-target="#login-modal"><i class="fa fa-user"></i>member Login</a>--}}
                        <div class="modal fade" id="login-modal">
                            <div class="login-form position-center-center">
                                <h2>Login<button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button></h2>
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="user" placeholder="domain@live.com">
                                        <i class=" fa fa-envelope"></i>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="pass" placeholder="**********">
                                        <i class=" fa fa-lock"></i>
                                    </div>
                                    <div class="form-group custom-checkbox">
                                        <label>
                                            <input type="checkbox"> Stay login
                                        </label>
                                        <a class="pull-right forgot-password" href="#"></a>
                                        <a href="#" class="pull-right forgot-password" data-toggle="modal" data-target="#login-modal-2">Forgot password?</a>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn full-width red-btn">Login</button>
                                    </div>
                                </form>
                                <span class="or-reprater"></span>
                                <ul class="others-login-way">
                                    <li><a class="facebook-bg" href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                    <li><a class="tweet-bg" href="#"><i class="fa fa-twitter"></i>Tweet</a></li>
                                    <li><a class="linkedin-bg" href="#"><i class="fa fa-linkedin"></i>Linkedin</a></li>
                                    <li><a class="google-plus-bg" href="#"><i class="fa fa-google-plus"></i>Google+</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="modal fade" id="login-modal-2">
                            <div class="login-form position-center-center">
                                <h2>Forgot password<button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button></h2>
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="user" placeholder="domain@live.com">
                                        <i class=" fa fa-envelope"></i>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="pass" placeholder="**********">
                                        <i class=" fa fa-lock"></i>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn full-width red-btn">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- Nav List -->
                <ul class="nav-list pull-right">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li><a href="#">about</a></li>
                    <li>
                        <a href="#">team</a>
                    </li>
                    <li class="mega-dropdown">
                        <a href="{{ route('front.blogs') }}">Blogs</a>
                    </li>
                    <li><a href="#">contact</a></li>
                    @if(!getLogInUser())
                    <li>
                        <a href="{{route('login')}}">Login</a>
                    </li>
                    <li class="register-text">
                        <a href="{{ route('front.register') }}">Register</a>
                    </li>
                    @else
                        <li>
                            <a href="{{ getDashboardURL() }}">My Account</a>
                            <ul>
                                <li>
                                    <a class="" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                                            LOG OUT
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              class="d-none">
                                            {{ csrf_field() }}
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <!-- Nav List -->
            </div>
        </div>
    </div>
    <!-- Nav -->
</header>
<!-- Header -->
