@extends('front.layouts.app')
@section('title')
   Home
@endsection
@section('content')
    <!-- Slider Holder -->
    <div class="slider-holder">

        <!-- Banner slider -->
        <ul id="main-slides" class="main-slides">

            <!-- Itme -->
            <li>
                <div id="animated-slider" class="carousel slide carousel-fade">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">

                        <!-- Item -->
                        @if(count($homeSliders) > 0)
                            @foreach($homeSliders as $homeSlider)
                                <div class="item {{ $loop->iteration == 1 ? 'active' : '' }}">
                                    <img src="{{$homeSlider->slider_image}}" alt="Slider Image" class="home-slider-image">
                                    <div class="position-center-x full-width">
                                        <div class="container">
                                            <div class="banner-caption style-2 p-white h-white pull-left">
                                                <h1 class="animated fadeInUp delay-1s">{{ $homeSlider->main_title }}</h1>
                                                <p class="animated fadeInUp delay-2s">{{ $homeSlider->title }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <!-- Item -->

                    </div>
                    <!-- Wrapper for slides -->

                    <!-- Nan Control -->
                    <!-- <a class="slider-nav next" href="#animated-slider" data-slide="prev"><i class="fa fa-long-arrow-right"></i></a>
                    <a class="slider-nav prev" href="#animated-slider" data-slide="next"><i class="fa fa-long-arrow-left"></i></a> -->
                    <!-- Nan Control -->

                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                        <li data-target="#animated-slider" data-slide-to="0" class="active"></li>
                        <li data-target="#animated-slider" data-slide-to="1"></li>
                        <li data-target="#animated-slider" data-slide-to="2"></li>
                    </ul>
                    <!-- Indicators -->

                </div>
            </li>
            <!-- Itme -->

            <!-- Itme -->
            <li>
                <img src="{{asset('front/images/banner-bgs/img-03.jpg')}}" alt="">
                <div class="video-banner-caption position-center-center p-white h-white">
                    <h1>Continuous effort  not strength or<br> intelligence  is the key to unlocking our potential</h1>
                    <p>Hart's short pass wasn't controlled by Fernando, and the Swedish striker's tackle<br> resulted in the ball rolling into the net. While the bulk</p>
                    <ul class="btn-list">
                        <li><a class="btn lg red-btn" href="http://www.youtube.com/watch?v=cH6kxtzovew" data-rel="prettyPhoto[video]">watch video<i class="fa fa-play-circle"></i></a></li>
                        <li><a class="btn lg red-btn" href="#">MOre videos<i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </li>
            <!-- Itme -->

            <!-- Itme -->
            <li>
                <img src="{{asset('front/images/banner-bgs/img-01.jpg')}}" alt="">
            </li>
            <!-- Itme -->

            <!-- Itme -->
            <li>
                <img src="{{asset('front/images/banner-bgs/img-02.jpg')}}" alt="">
                <div class="position-center-center">
                    <div class="container theme-padding">
                        <div class="pager-heading match-detail h-white">
                            <span class="pull-left win-tag"><img src="{{asset('front/images/result-team-logo/img-01.png')}}" alt=""></span>
                            <div class="vs-match-heading position-center-center">
                                <strong class="vs-match-result">3<span>Vs</span>1</strong>
                                <span class="end-time"><i class="fa fa-clock-o"></i>13:57 min (IST)</span>
                            </div>
                            <span class="pull-right loss-tag"><img src="{{asset('front/images/result-team-logo/img-02.png')}}" alt=""></span>
                        </div>
                    </div>
                </div>
            </li>
            <!-- Itme -->

        </ul>
        <!-- Banner slider -->

        <!-- Slides Thmnail -->
        <div class="main-slides-thumb">
            <div class="container">
{{--                <ul id="slides-thmnail" class="slides-thmnail">--}}
{{--                    <li>--}}
{{--                        <span><i class="fa fa-sliders"></i>Slides</span>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <span><i class="fa fa-play-circle"></i>Video</span>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <span><i class="fa fa-soccer-ball-o"></i>scores</span>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <span><i class="fa fa-bar-chart"></i>Resutls</span>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <ul class="thmnail-arrows">--}}
{{--                    <li class="prev-1"><span class="icon-arrow-01"></span></li>--}}
{{--                    <li class="next-1"><span class="icon-arrow-01"></span></li>--}}
{{--                </ul>--}}
            </div>
        </div>
        <!-- Slides Thmnail -->

    </div>
    <!-- Slider Holder -->

    <!-- Main Content -->
    <main class="main-content">

        <!-- Match Detail -->
        <section class="theme-padding-bottom bg-fixed">
            <div class="container">

                <!-- Add Banners -->
                <div class="add-banners">
                    <ul id="add-banners-slider" class="add-banners-slider">
                        <li>
                            <a href="#"><img src="{{asset('front/images/add-banners/img-01.jpg')}}" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="{{asset('front/images/add-banners/img-02.jpg')}}" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="{{asset('front/images/add-banners/img-03.jpg')}}" alt=""></a>
                        </li>
                    </ul>
                </div>
                <!-- Add Banners -->

                <!-- Match Detail Content -->
                <div class="match-detail-content">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="row">
                                @if(!empty($latestBlog))
                                <!-- Latest News -->
                                <div class="col-xs-12">
                                    <div class="latest-news-holder">
                                        <h3><span>Latest Blogs</span></h3>

                                        <!-- latest-news Slider -->
                                        <div class="row no-gutters white-bg">

                                            <!-- Slider -->
                                            <div class="col-sm-9">
                                                <ul id="latest-news-slider" class="latest-news-slider">
                                                    <li>
                                                        <img src="{{$latestBlog->blog_image}}" alt="">
                                                        <p>{{ $latestBlog->title }}<a href="{{ route('front.blog.detail',[$latestBlog->slug,$latestBlog->id]) }}">Read more</a></p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Slider -->

                                            <!-- Thumnail -->
                                            <div class="col-sm-3">
                                                <ul id="latest-news-thumb" class="latest-news-thumb">
                                                    @foreach($blogs as $blog)
                                                    <li>
                                                        <p>{{ $blog->title }}</p>
                                                        <span>{{ $blog->created_at->format('M d, Y') }}</span>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                <ul class="news-thumb-arrows">
                                                    <li class="prev"><span class="fa fa-angle-up"></span></li>
                                                    <li class="next"><span class="fa fa-angle-down"></span></li>
                                                </ul>
                                            </div>
                                            <!-- Thumnail -->

                                        </div>
                                        <!-- latest-news Slider -->

                                    </div>
                                </div>
                                <!-- Latest News -->
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Match Detail Content -->

            </div>
        </section>
        <!-- Match Detail -->

        <!-- Gallery And Team -->
        <div class="theme-padding gallery-holder">

            <!-- Gallery v-3 -->
            <div class="theme-padding-bottom">
                <div class="container">

                    <!-- Main Heading -->
                    <h3><span>Match Gallery</span></h3>
                    <!-- Main Heading -->

                    <!-- Gallery Columns -->
                    <div class="gallery">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 r-full-width p-0">
                                    <figure class="gallery-figure">
                                        <img src="{{asset('front/images/gallery-v3/img-01.jpg')}}" alt="">
                                        <figcaption class="overlay">
                                            <div class="position-center-center">
                                                <ul class="btn-list">
                                                    <li><a href="{{asset('front/images/gallery-v3/img-1-1.jpg')}}" data-rel="prettyPhoto[gallery-v3]"><i class="fa fa-search"></i></a></li>
                                                    <li><a class="fa fa-eye" href="#"></a></li>
                                                </ul>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="col-sm-6 col-xs-6 r-full-width p-0">
                                    <figure class="gallery-figure">
                                        <img src="{{asset('front/images/gallery-v3/img-02.jpg')}}" alt="">
                                        <figcaption class="overlay">
                                            <div class="position-center-center">
                                                <ul class="btn-list">
                                                    <li><a href="{{asset('front/images/gallery-v3/img-1-2.jpg')}}" data-rel="prettyPhoto[gallery-v3]"><i class="fa fa-search"></i></a></li>
                                                    <li><a class="fa fa-eye" href="#"></a></li>
                                                </ul>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="col-sm-6 col-xs-6 r-full-width p-0">
                                    <figure class="gallery-figure">
                                        <img src="{{asset('front/images/gallery-v3/img-03.jpg')}}" alt="">
                                        <figcaption class="overlay">
                                            <div class="position-center-center">
                                                <ul class="btn-list">
                                                    <li><a href="{{asset('front/images/gallery-v3/img-1-3.jpg')}}" data-rel="prettyPhoto[gallery-v3]"><i class="fa fa-search"></i></a></li>
                                                    <li><a class="fa fa-eye" href="#"></a></li>
                                                </ul>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 r-full-width p-0">
                                    <figure class="gallery-figure">
                                        <img src="{{asset('front/images/gallery-v3/img-04.jpg')}}" alt="">
                                        <figcaption class="overlay">
                                            <div class="position-center-center">
                                                <ul class="btn-list">
                                                    <li><a href="{{asset('front/images/gallery-v3/img-1-4.jpg')}}" data-rel="prettyPhoto[gallery-v3]"><i class="fa fa-search"></i></a></li>
                                                    <li><a class="fa fa-eye" href="#"></a></li>
                                                </ul>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="col-sm-6 col-xs-6 r-full-width p-0">
                                    <figure class="gallery-figure">
                                        <img src="{{asset('front/images/gallery-v3/img-05.jpg')}}" alt="">
                                        <figcaption class="overlay">
                                            <div class="position-center-center">
                                                <ul class="btn-list">
                                                    <li><a href="{{asset('front/images/gallery-v3/img-1-5.jpg')}}" data-rel="prettyPhoto[gallery-v3]"><i class="fa fa-search"></i></a></li>
                                                    <li><a class="fa fa-eye" href="#"></a></li>
                                                </ul>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="col-sm-12 col-xs-12 r-full-width p-0">
                                    <figure class="gallery-figure">
                                        <img src="{{asset('front/images/gallery-v3/img-06.jpg')}}" alt="">
                                        <figcaption class="overlay">
                                            <div class="position-center-center">
                                                <ul class="btn-list">
                                                    <li><a href="{{asset('front/images/gallery-v3/img-1-6.jpg')}}" data-rel="prettyPhoto[gallery-v3]"><i class="fa fa-search"></i></a></li>
                                                    <li><a class="fa fa-link" href="#"></a></li>
                                                </ul>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Gallery Columns -->
                </div>
            </div>
            <!-- Gallery v-3 -->

            <!-- Separator -->
            <div class="container text-center">
                <span class="sprater"><i class="fa fa-futbol-o"></i></span>
            </div>
            <!-- Separator -->

        </div>
        <!-- Gallery And Team -->

    </main>
    <!-- Main Content -->
@endsection
