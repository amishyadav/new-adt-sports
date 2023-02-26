@extends('layouts.auth')
@section('title')
    {{__('messages.registration')}}
@endsection
@section('content')
    <div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-4">
        <div class="col-12 text-center">
            <a href="{{ route('login') }}" class="image mb-7 mb-sm-10">
                <img alt="Logo" src="{{asset(getAppLogo())}}" class="img-fluid">
            </a>
        </div>
        <div class="width-540">
            @include('flash::message')
            @include('layouts.errors')
        </div>
        <div class="bg-white rounded-15 shadow-md width-540 px-5 px-sm-7 py-10 mx-auto">
            <h1 class="text-center mb-7">{{__('messages.registration')}}</h1>
            <form method="POST" action="{{ route('register') }}" >
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-sm-7 mb-4">
                        <label for="name" class="form-label">
                            {{ __('messages.user.first_name').':' }}<span class="required"></span>
                        </label>
                        <input name="first_name" type="text" class="form-control" id="first_name" aria-describedby="name" placeholder="{{ __('messages.user.first_name') }}" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="col-md-6 mb-sm-7 mb-4">
                        <label for="name" class="form-label">
                            {{ __('messages.user.last_name').':' }}<span class="required"></span>
                        </label>
                        <input name="last_name" type="text" class="form-control" id="last_name" aria-describedby="name" placeholder="{{ __('messages.user.last_name') }}" value="{{ old('last_name') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-sm-7 mb-4">
                        <label for="email" class="form-label">
                            {{ __('messages.user.email').':' }}<span class="required"></span>
                        </label>
                        <input name="email" type="email" class="form-control" id="email" aria-describedby="email" placeholder="{{ __('messages.user.email') }}" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="mb-5 fv-row">
                    <div class="row">
                        <div class="col-md-6 mb-sm-7 mb-4">
                            <label for="password" class="form-label">
                                {{ __('messages.user.password').':' }}<span class="required"></span>
                            </label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="{{ __('messages.user.password') }}" aria-describedby="password" required>
                        </div>
                        <div class="col-md-6 mb-sm-7 mb-4">
                            <label for="password_confirmation" class="form-label">
                                {{ __('messages.user.password_confirmation') .':' }}<span class="required"></span>
                            </label>
                            <input name="password_confirmation" type="password" class="form-control" placeholder="{{ __('messages.user.password_confirmation') }}" id="password_confirmation" aria-describedby="confirmPassword" required>
                        </div>
                    </div>

                    @if(getSettingValue()['show_captcha'] == 1)
                        <div class="mb-sm-7 mb-4">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div>
                    @endif
                    <div class="mb-sm-7 mb-4 form-check">
                        <input type="checkbox" class="form-check-input" name="toc" value="1" required/>
                        <span class="text-gray-700 me-2 ml-1">{{__('messages.i_agree')}}
									<a href=""
                                       class="ms-1 link-primary">{{__('messages.terms_and_conditions')}}</a>.
                        </span>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <span class="text-gray-700 me-2">{{__('messages.already_have_an_account').'?'}}</span>
                        <a href="{{ route('login') }}" class="link-info fs-6 text-decoration-none">
                            {{__('messages.sign_in_here')}}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
