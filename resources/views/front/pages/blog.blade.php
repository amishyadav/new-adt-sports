@extends('front.layouts.app')
@section('title')
   Blogs
@endsection
@section('content')
    <!-- Page Heading banner -->
    <div class="overlay-dark theme-padding parallax-window" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/inner-banner/img-01.jpg">
        <div class="container">
            <h2>Blogs</h2>
            <ul class="breadcrumbs">
                <li><a href="{{ route('front.index') }}">Home</a></li>
                <li>Blogs</li>
            </ul>
        </div>
    </div>
    <!-- Page Heading banner -->

    <!-- Main Content -->
    <main class="main-content">

        <!-- Blog -->
        <div class="theme-padding white-bg">
            <div class="container">
                <div class="row">

                    <!-- Blog Content -->
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7 r-full-width">

                        <!-- Blog List View -->
                        <div class="blog-list-View theme-padding-bottom">

                            @foreach($blogs as $blog)
                            <div class="theme-padding-bottom">
                                <div class="row">

                                    <!-- Post Img -->
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <ul id="post-slider" class="post-slider">
                                            <li class="large-post-img">
                                                <img src="{{ $blog->blog_image }}" alt="">
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Post Img -->

                                    <!-- Post Detail -->
                                    <div class="col-lg-7 col-md-5 col-xs-12">
                                        <div class="large-post-detail style-2">
                                            <div class="author-header">
                                                <div class="aurhor-img-name pull-left">
                                                    <img src="{{ asset(getAppLogo()) }}" alt="" class="blog-user-image">
                                                    <strong>by <i class="red-color">{{ getAppName() }}</i></strong>
                                                    <span>on {{ $blog->created_at->format('M d, Y') }} </span>
                                                </div>
{{--                                                <div class="share-option pull-right">--}}
{{--                                                    <span id="share-btn3"><i class="fa fa-share-alt"></i>Share</span>--}}
{{--                                                    <div id="show-social-icon3" class="on-hover-share">--}}
{{--                                                        <ul class="social-icons">--}}
{{--                                                            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>--}}
{{--                                                            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>--}}
{{--                                                            <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>--}}
{{--                                                            <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            </div>
                                            <h2><a href="{{ route('front.blog.detail',[$blog->slug,$blog->id]) }}">{{ $blog->title }}</a></h2>
                                            <p>{!! \Illuminate\Support\Str::limit($blog->description, $limit = 350, $end = '...') !!}</p>
                                            <a class="btn gary-btn" href="#"><i>+</i>read more</a>
                                        </div>
                                    </div>
                                    <!-- Post Detail -->

                                </div>
                            </div>
                            @endforeach

                            <!-- Pagination -->
                            <div class="pagination-holder">
                                    {{ $blogs->links() }}
                            </div>
                            <!-- Pagination -->

                        </div>
                        <!-- Blog List View -->

                    </div>
                    <!-- Blog Content -->

                    <!-- Aside -->
{{--                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 r-full-width">--}}

{{--                        <!-- Search Bar -->--}}
{{--                        <div class="aside-search-bar">--}}
{{--                            <input class="form-control" type="text" placeholder="Search...">--}}
{{--                            <button><i class="fa fa-search"></i></button>--}}
{{--                        </div>--}}
{{--                        <!-- Search Bar -->--}}

{{--                        <!-- Aside Widget -->--}}
{{--                        <div class="aside-widget">--}}
{{--                            <div class="aside-post">--}}

{{--                                <!-- Post Img -->--}}
{{--                                <div class="large-post-img video-post">--}}
{{--                                    <img src="images/aside-post.jpg" alt="">--}}
{{--                                    <span class="play-lable fa fa-video-camera"></span>--}}
{{--                                    <a class="position-center-center play-icon" href="http://www.youtube.com/watch?v=cH6kxtzovew" data-rel="prettyPhoto[video]"><i class="fa fa-video-camera"></i></a>--}}
{{--                                </div>--}}
{{--                                <!-- Post Img -->--}}

{{--                                <!-- Post Detail -->--}}
{{--                                <div class="large-post-detail">--}}
{{--                                    <h2>Somehow there wa enough distaste presumption of it) to</h2>--}}
{{--                                    <span class="red-color">22 Feb, 2016</span>--}}
{{--                                </div>--}}
{{--                                <!-- Post Detail -->--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Aside Widget -->--}}

{{--                        <!-- Aside Widget -->--}}
{{--                        <div class="aside-widget">--}}
{{--                            <h3><span>Top Categories</span></h3>--}}
{{--                            <div class="top-categories">--}}
{{--                                <ul>--}}
{{--                                    <li><a href="#">Cricket<span>18 Videos</span></a></li>--}}
{{--                                    <li><a href="#">Football<span>18 Videos</span></a></li>--}}
{{--                                    <li><a href="#">Hockey<span>18 Videos</span></a></li>--}}
{{--                                    <li><a href="#">Tennis<span>18 Videos</span></a></li>--}}
{{--                                    <li><a href="#">Basketball<span>18 Videos</span></a></li>--}}
{{--                                    <li><a href="#">Baseball<span>18 Videos</span></a></li>--}}
{{--                                    <li><a href="#">Golf<span>18 Videos</span></a></li>--}}
{{--                                    <li><a href="#">Cycling<span>18 Videos</span></a></li>--}}
{{--                                    <li><a href="#">Motorsports<span>18 Videos</span></a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Aside Widget -->--}}

{{--                        <!-- Aside Widget -->--}}
{{--                        <div class="aside-widget">--}}
{{--                            <h3><span>Popular News</span></h3>--}}
{{--                            <div class="Popular-news">--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        <img src="images/popular-news/img-01.jpg" alt="">--}}
{{--                                        <h5><a href="#">Two touch penalties, imaginary cards</a></h5>--}}
{{--                                        <span class="red-color"><i class="fa fa-clock-o"></i>22 Feb, 2016</span>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <img src="images/popular-news/img-02.jpg" alt="">--}}
{{--                                        <h5><a href="#">Two touch penalties, imaginary cards</a></h5>--}}
{{--                                        <span class="red-color"><i class="fa fa-clock-o"></i>22 Feb, 2016</span>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <img src="images/popular-news/img-03.jpg" alt="">--}}
{{--                                        <h5><a href="#">Two touch penalties, imaginary cards</a></h5>--}}
{{--                                        <span class="red-color"><i class="fa fa-clock-o"></i>22 Feb, 2016</span>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <img src="images/popular-news/img-04.jpg" alt="">--}}
{{--                                        <h5><a href="#">Two touch penalties, imaginary cards</a></h5>--}}
{{--                                        <span class="red-color"><i class="fa fa-clock-o"></i>22 Feb, 2016</span>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Aside Widget -->--}}

{{--                    </div>--}}
                    <!-- Aside -->

                </div>
            </div>
        </div>
        <!-- Blog -->

    </main>
@endsection
