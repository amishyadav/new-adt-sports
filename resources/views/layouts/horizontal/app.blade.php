<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') |  {{getAppName()}}</title>
    <link rel="icon" href="{{ asset(getFaviconLogo()) }}" type="image/png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <link href="{{ mix('assets/css/third-party.css') }}" rel="stylesheet">
    <link href="{{ mix('assets/css/pages.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @if(Auth::user()->theme_mode)
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-dark.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.dark.css') }}">
    @endif
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
        let defaultCountryCodeValue = "AO";
    </script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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
        let options = {
            'key': "{{ config('services.razorpay.key') }}",
            'amount': 0, //  100 refers to 1
            'currency': 'INR',
            'name': "{{getAppName()}}",
            'order_id': '',
            'description': '',
            'image': '{{ asset(getAppLogo()) }}', // logo here
            'callback_url': "{{ route('user.razorpay.success') }}",
            'prefill': {
                'email': '', // recipient email here
                'name': '', // recipient name here
                'contact': '', // recipient phone here
                'appointmentID': '', // appointmentID here
            },
            'readonly': {
                'name': 'true',
                'email': 'true',
                'contact': 'true',
            },
            'theme': {
                'color': '#4FB281',
            },
            'modal': {
                'ondismiss': function () {
                    displayErrorMessage(Lang.get('messages.flash.unable_to_process_payment'));
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                },
            },
        }
    </script>
    
    @livewireStyles
</head>
<body>
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-column-fluid">
        <div class="header fixed-header">
            @include('layouts.horizontal.header')
        </div>
        <div class="theme-wrapper d-flex flex-column flex-row-fluid">
            <div class='d-flex flex-column flex-row-fluid'>
                <div class="d-flex flex-column flex-column-fluid pt-7">
                    <div class="container-fluid container-xxl">
                        @yield('header_toolbar')
                    </div>
                    <div class="content flex-column-fluid">
                        <div class="container-fluid container-xxl">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='container-fluid container-xxl'>
            @include('layouts.footer')
        </div>
    </div>
</div>
@include('profile.change_language')
@include('profile.changePassword')


</body>
</html>
