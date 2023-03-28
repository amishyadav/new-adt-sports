<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>@yield('title') | {{ getAppName() }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{asset('frontlogin/css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontlogin/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontlogin/fonts/flaticon/font/flaticon.css')}}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{asset('frontlogin/img/favicon.ico" type="image/x-icon')}}" >

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('frontlogin/css/style.css')}}">

</head>
<body id="top">
<div class="page_loader"></div>

@yield('content')

<!-- External JS libraries -->
<script src="{{asset('frontlogin/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('frontlogin/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontlogin/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('frontlogin/js/app.js')}}"></script>
<!-- Custom JS Script -->
@yield('page_js')
</body>
</html>
