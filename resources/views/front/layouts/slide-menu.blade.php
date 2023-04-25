<!-- Slide Menu -->
<nav id="menu" class="responive-nav">
    <a class="r-nav-logo" href="/"><img src="{{asset(getAppLogo())}}" alt=""></a>
    <ul class="respoinve-nav-list">
        <li>
            <a href="/">Home</a>
        </li>
        <li><a href="#">About</a></li>
        <li>
            <a href="#">Team</a>
        </li>
        <li class="mega-dropdown">
            <a href="{{ route('front.blogs') }}">Blogs</a>
        </li>
        <li><a href="#">Contact</a></li>
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
</nav>
