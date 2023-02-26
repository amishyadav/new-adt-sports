<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') |  {{getAppName()}}</title>
    <link rel="icon" href="{{ asset(getFaviconLogo()) }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <link href="{{ mix('assets/css/third-party.css') }}" rel="stylesheet">
    <link href="{{ mix('assets/css/pages.css') }}" rel="stylesheet">

    @if(Auth::user()->theme_mode)
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-dark.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.dark.css') }}">
    @endif
{{--    @if(session()->get('theme_mode', 'light') === 'light')--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">--}}
    
{{--    <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet">--}}
    {{--    @if(session()->get('theme_mode', 'light') === 'light')--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
{{--    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/laravel-admin-ext/code-mirror/codemirror.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/laravel-admin-ext/code-mirror/dracula.css') }}">
    <script src="{{ asset('vendor/laravel-admin-ext/code-mirror/codemirror.js') }}"></script>
    <script src="{{ asset('vendor/laravel-admin-ext/code-mirror/css.js') }}"></script>
    <script src="{{ asset('vendor/laravel-admin-ext/code-mirror/closebrackets.js') }}"></script>
    {{--    @else--}}
    {{--        <link href="{{ mix('css/plugins.dark.css') }}" rel="stylesheet">--}}
    {{--        <link href="{{ mix('assets/css/style-dark.css') }}" rel="stylesheet">--}}
    {{--    @endif--}}
    <script src="https://js.stripe.com/v3/"></script>

    <script src="{{ asset('assets/js/custom/helper.js') }}"></script>
    @livewireStyles
    @routes
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
            data-turbolinks-eval="false" data-turbo-eval="false"></script>
    <script>
        let stripe = ''
        @if (config('services.stripe.key'))
            stripe = Stripe('{{ config('services.stripe.key') }}')
        @endif
        let sweetAlertIcon = "{{ asset('images/remove.png') }}"
        let defaultImage = "{{asset('images/avatar.png')}}"
        let defaultCountryCodeValue = "IN";
    </script>
    
    <script src="{{ mix('js/third-party.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('messages.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
    <script src="{{ mix('js/pages.js') }}"></script> @yield('page_js')
    <script data-turbo-eval="false">
        let updateLanguageURL = "{{ route('change-language')}}";
        let checkLanguageSession = '{{checkLanguageSession()}}';
        Lang.setLocale(checkLanguageSession);
    </script>
</head>
<body>
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid">
        @include('layouts.sidebar')
        <div class="wrapper d-flex flex-column flex-row-fluid">
            <div class='container-fluid d-flex align-items-stretch justify-content-between px-0'>
                @include('layouts.header')
            </div>
            <div class='content d-flex flex-column flex-column-fluid pt-7'>
               
                @yield('header_toolbar')
                <div class='d-flex flex-column-fluid'>
                    @yield('content')
                </div>
            </div>
            <div class='container-fluid'> @include('layouts.footer') </div>
        </div>
    </div>
</div>
@include('profile.changePassword')

{{--@include('user_profile.edit_profile_modal')--}}
{{--@include('user_profile.change_password_modal')--}}
{{--{{ Form::hidden('deleteVariable', ('messages.common.delete'), ['class' => 'deleteVariable']) }}--}}
{{--{{ Form::hidden('yesVariable', ('messages.common.yes'), ['class' => 'yesVariable']) }}--}}
{{--{{ Form::hidden('noVariable', ('messages.common.no'), ['class' => 'noVariable']) }}--}}
{{--{{ Form::hidden('cancelVariable', ('messages.common.cancel'), ['class' => 'cancelVariable']) }}--}}
{{--{{ Form::hidden('confirmVariable', ('messages.common.are_you_sure_want_to_delete_this'), ['class' => 'confirmVariable']) }}--}}
{{--{{ Form::hidden('deletedVariable', ('messages.common.deleted'), ['class' => 'deletedVariable']) }}--}}
{{--{{ Form::hidden('hasBeenDeletedVariable', ('messages.common.has_been_deleted'), ['class' => 'hasBeenDeletedVariable']) }}--}}
{{--{{ Form::hidden('okVariable', ('messages.common.ok'), ['class' => 'okVariable']) }}--}}

@include('profile.change_language')
</body>
</html> 
