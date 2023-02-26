<div class="ps-xl-7 px-2 pe-xl-0 d-flex align-items-stretch">
    <ul class="horizontal-menu nav flex-row d-block d-xl-flex">
        <li class="nav-item {{ Request::is('user/dashboard') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center py-3" aria-current="page"
               href="{{ route('user.dashboard') }}">
                <span class="aside-menu-icon pe-3"><i class="fa-solid fa-chart-pie"></i></span>
                <span class="aside-menu-title">{{ __('messages.common.dashboard') }}</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('user/deposit-transaction') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center py-3" aria-current="page"
               href="{{route('user.deposit-transaction.index')}}">
                <span class="aside-menu-icon pe-3"><i class="fa-sharp fa-solid fa-money-bill"></i></span>
                <span class="aside-menu-title">{{__('messages.deposit.deposit')}}</span>
            </a>
        </li>
    </ul>
</div>
