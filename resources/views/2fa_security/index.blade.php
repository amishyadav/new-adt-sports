@extends('layouts.horizontal.app')
@section('title')
    {{ __('Two Factor Authentication') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>{{ __('Two Factor Authentication') }}</h1>
        </div>

        <div class="col-12">
            @include('layouts.errors')
            @include('flash::message')
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="card custom-2fa-card h-100">
                            <div class="card-header">
                                <h5 class="card-title py-2 text-white">Two Factor Authenticator</h5>
                            </div>
                            <div class="card-body">
                                <div class="twofactor-content">
                                    @if($secret)
                                    <div class="input-group">
                                        <input type="text" name="key" value="{{ $secret }}"
                                               class="form-control" id="2faSecretKey" 
                                               readonly="">
                                        <span class="input-group-text bg--base form--control h--50px cursor-pointer copy-secret-text"
                                              id="copySecretBoard">
                                                <i class="lar la-copy"></i>
                                            </span>
                                    </div>
                                    <div class="twofactor-scan text-center my-4">
                                        <img src="{{ $imageRender }}" alt="QR Code" id="2faSecretKeyImage" class="qr-image-height"/>
                                    </div>
                                    @endif
                                    <div class="text-center">
                                        @if($user->google2fa_secret == null)
                                        <a href="javascript:void(0)" class="twoauth-enable btn btn-success"
                                           >Enable Two Factor Authenticator</a>
                                        @else
                                        <a href="javascript:void(0)" class="twoauth-disable btn btn-danger"
                                        >Disable Two Factor Authenticator</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card custom-2fa-card h-100">
                            <div class="card-header">
                                <h5 class="card-title py-2 text-white">Google Authenticator</h5>
                            </div>
                            <div class="card-body">
                                <div class="two-factor-content">
                                    <h6 class="subtitle--bordered">USE GOOGLE AUTHENTICATOR TO SCAN THE QR CODE OR USE
                                        THE CODE</h6>
                                    <p class="two__fact__text">
                                        Google Authenticator is a multifactor app for mobile devices. It generates timed
                                        codes used during the 2-step verification process. To use Google Authenticator,
                                        install the Google Authenticator application on your mobile device. </p>
                                    <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&amp;hl=en"
                                       target="_blank" class="btn btn-success">DOWNLOAD APP</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('2fa_security.disable2fa_modal')
@endsection

