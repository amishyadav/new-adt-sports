{{--<x-guest-layout>--}}
{{--    <x-auth-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

{{--        <div class="mb-4 text-sm text-gray-600">--}}
{{--            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}--}}
{{--        </div>--}}

{{--        <!-- Session Status -->--}}
{{--        <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--        <form method="POST" action="{{ route('password.email') }}">--}}
{{--            @csrf--}}

{{--            <!-- Email Address -->--}}
{{--            <div>--}}
{{--                <x-input-label for="email" :value="__('Email')" />--}}

{{--                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}

{{--                <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                <x-primary-button>--}}
{{--                    {{ __('Email Password Reset Link') }}--}}
{{--                </x-primary-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-auth-card>--}}
{{--</x-guest-layout>--}}
@extends('layouts.auth')
@section('title')
    {{__('messages.web.forgot_password')}}
@endsection
@section('content')
    <div class="d-flex flex-column flex-column-fluid align-items-center mt-12 p-4">
        <div class="col-12 text-center">
            <a href="#" class="image mb-7 mb-sm-10">
                <img alt="Logo" src="{{ asset(getAppLogo()) }}" class="img-fluid">
            </a>
        </div>
        <div class="width-540">
            @include('layouts.errors')
            @if (session('status'))
                @include('flash::message')
            @endif
        </div>
        <div class="bg-white rounded-15 shadow-md width-540 px-5 px-sm-7 py-10 mx-auto mx-auto">
            <h1 class="text-center mb-7">{{__('messages.web.forgot_password').' ?'}}</h1>
            <div class="fs-4 mb-4 text-center mb-5">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</div>
            <form class="form w-100" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row">
                    <div class="mb-4">
                        <label for="email" class="form-label">
                            {{ __('messages.web.email').':' }}<span class="required"></span>
                        </label>
                        <input id="email" class="form-control form-control-solid" type="email"
                               value="{{ old('email') }}"
                               required autofocus name="email" autocomplete="off" placeholder="{{__('messages.web.email')}}"/>
                    </div>
                </div>
                <div class="row">
                    <!-- Submit Field -->
                    <div class="form-group col-sm-12 d-flex text-start align-items-center">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label"> {{ __('messages.email_password_reset_link') }}</span>
                        </button>

                        <a href="{{ route('login') }}"
                           class="btn btn-secondary my-0 ms-5 me-0">{{__('messages.common.cancel')}}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
