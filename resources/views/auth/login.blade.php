@extends('auth.layouts.app')
@section('title')
    Login
@endsection
@section('content')
    <style>
        .float-right {
            float: right !important;
        }

        .login-box .password-indicator {
            top: 39px !important;
        }
    </style>
    <!-- Login 1 start -->
    <div class="login-1">
        <div class="container-fluid">
            <div class="row login-box">
                <div class="col-lg-6 align-self-center pad-0 form-section">
                    <div class="form-inner">
                        <a href="#" class="logo">
                            <img src="{{asset(getAppLogo())}}" alt="logo">
                        </a>
                        <h2>Sign In</h2>
                        @include('flash::message')
                        @include('layouts.errors')
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group position-relative clearfix">
                                <input name="email" type="email" class="form-control" placeholder="Email Address" aria-label="Email Address" required>
                            </div>

                            <div class="form-group clearfix position-relative password-wrapper">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="link-info fs-6 text-decoration-none float-right">
                                        {{ __('messages.common.forgot_your_password').'?' }}
                                    </a>
                                @endif
                                <input name="password" type="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password" required>
                                <i class="fa fa-eye password-indicator"></i>
                            </div>
                            @if(getSettingValue()['show_captcha'] == 1)
                                <div class="mb-sm-7 mb-4">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                </div>
                            @endif
                            <div class="form-group clearfix">
                                <button type="submit" class="btn btn-primary btn-lg btn-theme">Login</button>
                            </div>

                            <div class="d-flex align-items-center mb-10 mt-4">
                                <span class="text-gray-700 me-2">{{__('messages.new_here').'?'}}</span>
                                <a href="{{ route('front.register') }}" class="link-info fs-6 text-decoration-none">
                                    {{__('messages.create_an_account')}}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 pad-0 none-992 bg-img">
                    <div class="lines">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                    <div class="info">
                        <div class="animated-text">
                            <h1>Welcome <span>to ADT SPORTS</span></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login 1 end -->
@endsection
@section('page_js')
    <script>
    </script>
@endsection

