@extends('front.layouts.app')
@section('title')
   Contact Us
@endsection
@section('content')
    <!-- Page Heading banner -->
    <div class="overlay-dark theme-padding parallax-window" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/inner-banner/img-06.jpg">
        <div class="container">
            <h2>contact us</h2>
            <ul class="breadcrumbs">
                <li><a href="{{ route('front.index') }}">Home</a></li>
                <li>Contact us</li>
            </ul>
        </div>
    </div>
    <!-- Page Heading banner -->

    <!-- Main Content -->
    <main class="main-content">

        <!-- Contact -->
        <div class="theme-padding white-bg">
            <div class="container">

                <!-- Main Heading -->
                <div class="main-heading-holder">
                    <div class="main-heading">
                        <h2>contact us</h2>
                        <p>If you have any query/questions please fill the below form. We will get back to you as soon as possible.</p>
                    </div>
                </div>
                <!-- Main Heading -->

                <!-- contact columns -->
                <ul class="row">
                    <li class="col-sm-4">
                        <div class="address-widget">
                            <span class="address-icon"><i class="fa fa-phone"></i></span>
                            <h5>OUR NUMBERS</h5>
                            <p>{{ getSettingValueByKey('contact_no') }}<span class="red-color">Aditya Pandit ( Owner )</span></p>
                        </div>
                    </li>
                    <li class="col-sm-4">
                        <div class="address-widget more-info">
                            <span class="address-icon"><i class="fa fa-info"></i></span>
                            <h5>MORE INFO</h5>
                            <strong>Cupim brisket shank, prosciutto porchetta kevin jowl ham hock.</strong>
                            <p>Bresaola alcatra boudin andouille, ball tip rump pancetta shoulder. Beef ribs turducken tail flank. Leberkas pancetta tri-tip biltong spare ribs.</p>
                        </div>
                    </li>
                    <li class="col-sm-4">
                        <div class="address-widget office-adderss">
                            <span class="address-icon"><i class="fa fa-map-marker"></i></span>
                            <h5>OUR office address</h5>
                            <p>{{ getSettingValueByKey('address') }}</p>
                            <p><i class="red-color fa fa-envelope-o"></i>{{ getSettingValueByKey('email') }}</p>
                        </div>
                    </li>
                </ul>
                <!-- contact columns -->

            </div>
        </div>
        <!-- Contact -->

        <!-- Contact Form Holder -->
        <div class="theme-padding-bottom">
            <div class="container">
                <h2>Send us any query/questions</h2>
                <div class="row">

                    <!-- Form -->
                    <form id="contact-form" method="post" action="{{ route('front.contact.store') }}" class="contact-form col-sm-6">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" required="required" placeholder="Name *">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" required="required" placeholder="Email *">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" required="required" placeholder="Phone *">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control style-d" rows="6" id="comment" placeholder="Write Comments here..." required></textarea>
                            <i class="fa fa-pencil-square-o"></i>
                        </div>
                        <button class="btn red-btn pull-right">Send Comments</button>
                    </form>
                    <!-- Form -->

                    <!-- Img -->
{{--                    <figure class="col-sm-6 tower-img">--}}
{{--                        <div id="custom-map" class="contact-map"></div>--}}
{{--                    </figure>--}}
                    <!-- Img -->

                </div>
            </div>
        </div>
        <!-- Contact Form Holder -->

    </main>
    <!-- Main Content -->
@endsection
