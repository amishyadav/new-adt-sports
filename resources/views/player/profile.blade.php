@extends('front.layouts.app')
@section('title')
    Profile
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{asset('front/css/register/register.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="content" class="content content-full-width">
                                <div class="profile">
                                    <div class="profile-header">
                                        <div class="profile-header-cover"></div>
                                        <div class="profile-header-content">
                                            <div class="profile-header-img">
                                                <img src="{{ $user->profile_image }}" alt="">
                                            </div>
                                            <div class="profile-header-info">
                                                <h4 class="m-t-10 m-b-5">{{ $user->full_name }}</h4>
                                                <h4 class="m-b-10">{{ $user->position }}</h4>
                                                <h4 class="m-b-10">Player ID: {{ $user->unique_code }}</h4>
                                                {{--                                            <a href="#" class="btn btn-xs btn-success">Edit Profile</a>--}}
                                            </div>
                                        </div>

                                        <ul class="profile-header-tab nav nav-tabs">
                                            <li class="nav-item">
                                                <a href="#"
                                                   class="nav-link_ active show" id="menuProfile">PROFILE</a></li>
                                            @if($user->registeredPlayer && $user->registeredPlayer->status === \App\Models\RegisteredPlayer::ACTIVE)
                                            <li class="nav-item"><a
                                                    href="#"
                                                    class="nav-link_" id="menuTeam">TEAM</a></li>
                                            <li class="nav-item"><a
                                                    href="#"
                                                    class="nav-link_" id="menuPlayer">PLAYERS</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                @include('flash::message')
                                @include('layouts.errors')
                                @include('player.profile-page')
                                @if($user->registeredPlayer && $user->registeredPlayer->status === \App\Models\RegisteredPlayer::ACTIVE)
                                @include('player.team-page')
                                @include('player.player-page')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('page_js')
    <script>
        $(document).ready(function (){
            $('.alert').delay(5000).slideUp(300)
            $('#menuTeam').click(function (){
                if($('.team-section').hasClass('d-none')) {
                    $('.team-section').removeClass('d-none');
                }

                if(!$('.profile-block').hasClass('d-none')){
                    $('.profile-block').addClass('d-none');
                }

                if(!$('.players-section').hasClass('d-none')){
                    $('.players-section').addClass('d-none');
                }

            });

            $('#menuProfile').click(function (){
                if($('.profile-block').hasClass('d-none')) {
                    $('.profile-block').removeClass('d-none');
                }

                if(!$('.team-section').hasClass('d-none')){
                    $('.team-section').addClass('d-none');
                }

                if(!$('.players-section').hasClass('d-none')){
                    $('.players-section').addClass('d-none');
                }
            });

            $('#menuPlayer').click(function (){
                if($('.players-section').hasClass('d-none')) {
                    $('.players-section').removeClass('d-none');
                }

                if(!$('.profile-block').hasClass('d-none')){
                    $('.profile-block').addClass('d-none');
                }

                if(!$('.team-section').hasClass('d-none')){
                    $('.team-section').addClass('d-none');
                }
            });
        })
    </script>
@endsection
