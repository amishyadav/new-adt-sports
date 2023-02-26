<!doctype html>
<html class="no-js" lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content=""/>
<!-- Document Title -->
<title>@yield('title') | {{ getAppName() }}</title>
<!-- StyleSheets -->
<link rel="stylesheet" href="{{asset('front/css/bootstrap/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('front/css/main.css')}}">
<link rel="stylesheet" href="{{asset('front/css/icomoon.css')}}">
<link rel="stylesheet" href="{{asset('front/css/animate.css')}}">
<link rel="stylesheet" href="{{asset('front/css/transition.css')}}">
<link rel="stylesheet" href="{{asset('front/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('front/style.css')}}">
<link rel="stylesheet" href="{{asset('front/css/color.css')}}">
<link rel="stylesheet" href="{{asset('front/css/responsive.css')}}">
<!-- FontsOnline -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800|Open+Sans:400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<!-- JavaScripts -->
<script src="{{asset('front/js/vendor/modernizr.js')}}"></script>
</head>
<body>

<!-- Wrapper -->
<div class="wrap push">

	<!-- Header -->
	@include('front.layouts.header')
	<!-- Header -->

    @yield('content')

	<!-- Footer -->
    @include('front.layouts.footer')
	<!-- Footer -->

</div>
<!-- Wrapper -->

<!-- Slide Menu -->
@include('front.layouts.slide-menu')
<!-- Slide Menu -->

<!-- Java Script -->
<script src="{{asset('front/js/vendor/jquery.js')}}"></script>
<script src="{{asset('front/js/vendor/bootstrap.min.js')}}"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="{{asset('front/js/gmap3.min.js')}}"></script>
<script src="{{asset('front/js/bigslide.js')}}"></script>
<script src="{{asset('front/js/slick.js')}}"></script>
<script src="{{asset('front/js/waterwheelCarousel.js')}}"></script>
<script src="{{asset('front/js/contact-form.js')}}"></script>
<script src="{{asset('front/js/countTo.js')}}"></script>
<script src="{{asset('front/js/datepicker.js')}}"></script>
<script src="{{asset('front/js/rating-star.js')}}"></script>
<script src="{{asset('front/js/range-slider.js')}}"></script>
<script src="{{asset('front/js/spinner.js')}}"></script>
<script src="{{asset('front/js/parallax.js')}}"></script>
<script src="{{asset('front/js/countdown.js')}}"></script>
<script src="{{asset('front/js/appear.js')}}"></script>
<script src="{{asset('front/js/prettyPhoto.js')}}"></script>
<script src="{{asset('front/js/wow-min.js')}}"></script>
<script src="{{asset('front/js/main.js')}}"></script>
</body>
</html>
