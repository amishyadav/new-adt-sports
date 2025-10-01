@extends('front.layouts.app')
@section('title')
   Blog Details
@endsection
@section('content')
    <!-- Page Heading banner -->
    <div class="overlay-dark theme-padding parallax-window" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/inner-banner/img-07.jpg">
        <div class="container">
            <h2>Blog Detail</h2>
            <ul class="breadcrumbs">
                <li><a href="{{ route('front.index') }}">Home</a></li>
                <li>Blog Detail</li>
            </ul>
        </div>
    </div>
    <!-- Page Heading banner -->

    <!-- Main Content -->
    <main class="main-content">

        <!-- Blog Detail -->
        <div class="theme-padding white-bg">
            <div class="container">
                <div class="row">

                    <!-- Blog Content -->
                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-12">

                        <!-- Blog detail -->
                        <div class="blog-detail-holder">
                            <div class="author-header">
                                <h2>{{ $blog->title }}</h2>
                                <div class="aurhor-img-name pull-left">
                                    <img src="{{ asset(getAppLogo()) }}" alt="" class="blog-user-image">
                                    <strong>by <i class="red-color">{{ getAppName() }}</i></strong>
                                    <span>on {{ $blog->created_at->format('M d, Y') }} </span>
                                </div>
{{--                                <div class="share-option pull-right">--}}
{{--                                    <span id="share-btn1"><i class="fa fa-share-alt"></i>Share</span>--}}
{{--                                    <div id="show-social-icon1" class="on-hover-share">--}}
{{--                                        <ul class="social-icons">--}}
{{--                                            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>--}}
{{--                                            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>--}}
{{--                                            <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>--}}
{{--                                            <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="blog-detail">
                                <figure>
                                    <img src="{{$blog->blog_image}}" alt="">
                                </figure>
                                <article>
                                    <p>{!! nl2br($blog->description) !!}</p>
                                </article>
                            </div>
{{--                            <div class="tags-holder">--}}
{{--                                <ul class="tags-list pull-left">--}}
{{--                                    <li><i class="fa fa-tags"></i>Tags</li>--}}
{{--                                    <li><a href="#">Scores</a></li>--}}
{{--                                    <li><a href="#">transfers</a></li>--}}
{{--                                    <li><a href="#">teams</a></li>--}}
{{--                                    <li><a href="#">cups</a></li>--}}
{{--                                </ul>--}}
{{--                                <ul class="social-icons pull-right">--}}
{{--                                    <li>Share this post</li>--}}
{{--                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>--}}
{{--                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>--}}
{{--                                    <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>--}}
{{--                                    <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <div class="next-prev-option">--}}
{{--                                <a href="#" class="prev-blog pull-left">--}}
{{--                                    <img src="images/blog-detail/prev-img.jpg" alt="">--}}
{{--                                    <span><i class="fa fa-angle-left"></i>Previous Post</span>--}}
{{--                                    <h5>Tottenham Hotspur are growing</h5>--}}
{{--                                    <span class="m-0">23 December 2015</span>--}}
{{--                                </a>--}}
{{--                                <a href="#" class="next-blog pull-right">--}}
{{--                                    <img src="images/blog-detail/next-img.jpg" alt="">--}}
{{--                                    <span>Next Post<i class="fa fa-angle-right"></i></span>--}}
{{--                                    <h5>Tottenham Hotspur are growing</h5>--}}
{{--                                    <span class="m-0">23 December 2015</span>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="about-aurthor-holder theme-margin-bottom">--}}
{{--                                <div class="about-aurthor">--}}
{{--                                    <img src="images/blog-detail/aurthor.jpg" alt="">--}}
{{--                                    <h5>Taste Dictatorr <i class="red-color">Marco Bale</i></h5>--}}
{{--                                    <p>Id quisque cursus est volutpat lorem phasellus ut neque vivamus dolor, ornare sociosqu purus taciti erat egestas integer enim sem porta ligula semper suspendisse mi metus auctor faucibus lobortis senectus, at metus nisl ornare consectetur.</p>--}}
{{--                                    <span><a href="#"><i class="fa fa-twitter"></i>@marcobale #dominname</a></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <!-- Blog Detail -->

                        <!-- Blog Grid View -->
{{--                        <div class="blog-grid-view theme-padding-bottom">--}}
{{--                            <h2>Related Match</h2>--}}
{{--                            <div class="row">--}}

{{--                                <!-- Post Img -->--}}
{{--                                <div class="col-lg-4 col-xs-12">--}}

{{--                                    <!-- Post Img -->--}}
{{--                                    <div class="large-post-img">--}}
{{--                                        <img src="images/blog-grid-view/img-01.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <!-- Post Img -->--}}

{{--                                    <!-- Post Detail -->--}}
{{--                                    <div class="large-post-detail style-3">--}}
{{--                                        <span class="red-color">Englis FA Cup </span>--}}
{{--                                        <h2><a href="#">Man United reunion for Ibrahimovic, Mourinho Klopp plots</a></h2>--}}
{{--                                    </div>--}}
{{--                                    <!-- Post Detail -->--}}

{{--                                    <!-- Post Detail Bottom -->--}}
{{--                                    <div class="detail-btm">--}}
{{--                                        <span>on Jun 27, 2014 </span>--}}
{{--                                        <div class="share-option pull-right">--}}
{{--                                            <span id="share-btn2"><i class="fa fa-share-alt"></i>Share</span>--}}
{{--                                            <div id="show-social-icon2" class="on-hover-share">--}}
{{--                                                <ul class="social-icons">--}}
{{--                                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>--}}
{{--                                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>--}}
{{--                                                    <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>--}}
{{--                                                    <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- Post Detail Bottom -->--}}

{{--                                </div>--}}
{{--                                <!-- Post Img -->--}}

{{--                                <!-- Post Video -->--}}
{{--                                <div class="col-lg-4 col-xs-12">--}}

{{--                                    <!-- Post Img -->--}}
{{--                                    <div class="large-post-img video-post">--}}
{{--                                        <img src="images/blog-grid-view/img-02.jpg" alt="">--}}
{{--                                        <span class="play-lable fa fa-video-camera"></span>--}}
{{--                                        <a class="position-center-center play-icon" href="http://www.youtube.com/watch?v=cH6kxtzovew" data-rel="prettyPhoto[video]"><i class="fa fa-video-camera"></i></a>--}}
{{--                                    </div>--}}
{{--                                    <!-- Post Img -->--}}

{{--                                    <!-- Post Detail -->--}}
{{--                                    <div class="large-post-detail style-3">--}}
{{--                                        <span class="red-color">Englis FA Cup </span>--}}
{{--                                        <h2><a href="#">Man United reunion for Ibrahimovic, Mourinho Klopp plots</a></h2>--}}
{{--                                    </div>--}}
{{--                                    <!-- Post Detail -->--}}

{{--                                    <!-- Post Detail Bottom -->--}}
{{--                                    <div class="detail-btm">--}}
{{--                                        <span>on Jun 27, 2014 </span>--}}
{{--                                        <div class="share-option pull-right">--}}
{{--                                            <span id="share-btn3"><i class="fa fa-share-alt"></i>Share</span>--}}
{{--                                            <div id="show-social-icon3" class="on-hover-share">--}}
{{--                                                <ul class="social-icons">--}}
{{--                                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>--}}
{{--                                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>--}}
{{--                                                    <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>--}}
{{--                                                    <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- Post Detail Bottom -->--}}

{{--                                </div>--}}
{{--                                <!-- Post Video -->--}}

{{--                                <!-- Post Img -->--}}
{{--                                <div class="col-lg-4 col-xs-12">--}}

{{--                                    <!-- Post Img -->--}}
{{--                                    <div class="large-post-img">--}}
{{--                                        <img src="images/blog-grid-view/img-03.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <!-- Post Img -->--}}

{{--                                    <!-- Post Detail -->--}}
{{--                                    <div class="large-post-detail style-3">--}}
{{--                                        <span class="red-color">Englis FA Cup </span>--}}
{{--                                        <h2><a href="#">Man United reunion for Ibrahimovic, Mourinho Klopp plots</a></h2>--}}
{{--                                    </div>--}}
{{--                                    <!-- Post Detail -->--}}

{{--                                    <!-- Post Detail Bottom -->--}}
{{--                                    <div class="detail-btm">--}}
{{--                                        <span>on Jun 27, 2014 </span>--}}
{{--                                        <div class="share-option pull-right">--}}
{{--                                            <span id="share-btn5"><i class="fa fa-share-alt"></i>Share</span>--}}
{{--                                            <div id="show-social-icon5" class="on-hover-share">--}}
{{--                                                <ul class="social-icons">--}}
{{--                                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>--}}
{{--                                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>--}}
{{--                                                    <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>--}}
{{--                                                    <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- Post Detail Bottom -->--}}

{{--                                </div>--}}
{{--                                <!-- Post Img -->--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Blog Grid View -->--}}

{{--                        <!-- Comment Section -->--}}
{{--                        <div class="comment-holder theme-padding-bottom">--}}
{{--                            <h2>Latest comments</h2>--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <img class="position-center-x" src="images/commenter/img-01.jpg" alt="">--}}
{{--                                    <div class="comment-detail">--}}
{{--                                        <h5><a href="#">Rachel Evans</a></h5>--}}
{{--                                        <span>December 23, 2015, 10:59 am</span>--}}
{{--                                        <p>Vestibulum eros rutrum suspendisse dictum commodo magna habitasse taciti tincidunt non cursus conubia accumsan, vitae dapibus cursus id tristique porta felis porttitor ante primis libero nisi arcu elementum aliquam tincidunt eros at sapien in ac himenaeos primis duis tellus.</p>--}}
{{--                                        <a class="reply-btn" href="#"><i class="fa fa-reply"></i>Reply</a>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li class="sub-comment">--}}
{{--                                    <ul>--}}
{{--                                        <li>--}}
{{--                                            <img class="position-center-x" src="images/commenter/img-1-1.jpg" alt="">--}}
{{--                                            <div class="comment-detail">--}}
{{--                                                <h5><a href="#">Kiana Sanders</a></h5>--}}
{{--                                                <span>December 23, 2015, 10:59 am</span>--}}
{{--                                                <p>Vestibulum eros rutrum suspendisse dictum commodo magna habitasse taciti tincidunt non cursus conubia accumsan, vitae dapibus cursus.</p>--}}
{{--                                                <a class="reply-btn" href="#"><i class="fa fa-reply"></i>Reply</a>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li class="sub-comment">--}}
{{--                                            <ul>--}}
{{--                                                <li>--}}
{{--                                                    <img class="position-center-x" src="images/commenter/img-2-1.jpg" alt="">--}}
{{--                                                    <div class="comment-detail">--}}
{{--                                                        <h5><a href="#">Mahesh Kantariya</a></h5>--}}
{{--                                                        <span>December 23, 2015, 10:59 am</span>--}}
{{--                                                        <p>Vestibulum eros rutrum suspendisse dictum commodo magna habitasse taciti tincid</p>--}}
{{--                                                        <a class="reply-btn" href="#"><i class="fa fa-reply"></i>Reply</a>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <img class="position-center-x" src="images/commenter/img-02.jpg" alt="">--}}
{{--                                    <div class="comment-detail">--}}
{{--                                        <h5><a href="#">Rachel Evans</a></h5>--}}
{{--                                        <span>December 23, 2015, 10:59 am</span>--}}
{{--                                        <p>Vestibulum eros rutrum suspendisse dictum commodo magna habitasse taciti tincidunt non cursus conubia accumsan, vitae dapibus cursus id tristique porta felis porttitor ante primis libero nisi arcu elementum aliquam tincidunt eros at sapien in ac himenaeos primis duis tellus.</p>--}}
{{--                                        <a class="reply-btn" href="#"><i class="fa fa-reply"></i>Reply</a>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <!-- Comment Section -->--}}

{{--                        <!-- Leave a Reply  -->--}}
{{--                        <div class="leave-a-reply">--}}
{{--                            <h2>Leave a Reply</h2>--}}
{{--                            <form class="row">--}}
{{--                                <div class="col-sm-4">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="text" class="form-control" placeholder="Name">--}}
{{--                                        <i class="fa fa-user"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="text" class="form-control" placeholder="Email *">--}}
{{--                                        <i class="fa fa-envelope"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="text" class="form-control" placeholder="Phone">--}}
{{--                                        <i class="fa fa-phone"></i>--}}
{{--                                    </div>--}}
{{--                                    <button class="btn red-btn full-width">Send Comments</button>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <textarea class="form-control style-d" rows="11" id="comment" placeholder="Write Comments here..."></textarea>--}}
{{--                                        <i class="fa fa-pencil-square-o"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                        <!-- Leave a Reply  -->

                    </div>
                    <!-- Blog Content -->

                    <!-- Aside -->
{{--                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">--}}

{{--                        <!-- Search Bar -->--}}
{{--                        <div class="aside-search-bar">--}}
{{--                            <input class="form-control" type="text" placeholder="Search...">--}}
{{--                            <button><i class="fa fa-search"></i></button>--}}
{{--                        </div>--}}
{{--                        <!-- Search Bar -->--}}

{{--                        <!-- Aside Widget -->--}}
{{--                        <div class="aside-widget">--}}
{{--                            <h3><span>Top Categories</span></h3>--}}
{{--                            <div class="top-teams">--}}
{{--                                <ul>--}}
{{--                                    <li><a href="#">Cricket</a></li>--}}
{{--                                    <li><a href="#">Football</a></li>--}}
{{--                                    <li><a href="#">Hockey</a></li>--}}
{{--                                    <li><a href="#">Tennis</a></li>--}}
{{--                                    <li><a href="#">Basketball</a></li>--}}
{{--                                    <li><a href="#">Baseball</a></li>--}}
{{--                                    <li><a href="#">Golf</a></li>--}}
{{--                                    <li><a href="#">Cycling</a></li>--}}
{{--                                    <li><a href="#">Motorsports</a></li>--}}
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
{{--                                    <h2><a href="#">Somehow there wa enough distaste presumption of it) to</a></h2>--}}
{{--                                    <span class="red-color">22 Feb, 2016</span>--}}
{{--                                </div>--}}
{{--                                <!-- Post Detail -->--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Aside Widget -->--}}

{{--                        <!-- Aside Widget -->--}}
{{--                        <div class="aside-widget">--}}
{{--                            <h3><span>Archive</span></h3>--}}
{{--                            <div id="calendar" class="calendar"></div>--}}
{{--                        </div>--}}
{{--                        <!-- Aside Widget -->--}}

{{--                        <!-- Aside Widget -->--}}
{{--                        <div class="aside-widget">--}}
{{--                            <h3><span>Tag clouds</span></h3>--}}
{{--                            <div class="tag-clouds">--}}
{{--                                <ul>--}}
{{--                                    <li><a href="#">Scores</a></li>--}}
{{--                                    <li><a href="#">transfers</a></li>--}}
{{--                                    <li><a href="#">teams</a></li>--}}
{{--                                    <li><a href="#">cups</a></li>--}}
{{--                                    <li><a href="#">All News</a></li>--}}
{{--                                    <li><a href="#">Photos</a></li>--}}
{{--                                    <li><a href="#">Videos</a></li>--}}
{{--                                    <li><a href="#">match</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Aside Widget -->--}}

{{--                        <!-- Aside Widget -->--}}
{{--                        <div class="aside-widget">--}}
{{--                            <h3><span>instgram</span></h3>--}}
{{--                            <div class="instgram-writer">--}}
{{--                                <img src="images/instgram-imgs/instgram-writer.jpg" alt="">--}}
{{--                                <p>@domainnamein spiration from all over the world</p>--}}
{{--                            </div>--}}
{{--                            <div class="instgram-imgs">--}}
{{--                                <ul>--}}
{{--                                    <li><a href="#"><img src="images/instgram-imgs/img-01.jpg" alt=""></a></li>--}}
{{--                                    <li><a href="#"><img src="images/instgram-imgs/img-02.jpg" alt=""></a></li>--}}
{{--                                    <li><a href="#"><img src="images/instgram-imgs/img-03.jpg" alt=""></a></li>--}}
{{--                                    <li><a href="#"><img src="images/instgram-imgs/img-04.jpg" alt=""></a></li>--}}
{{--                                    <li><a href="#"><img src="images/instgram-imgs/img-05.jpg" alt=""></a></li>--}}
{{--                                    <li><a href="#"><img src="images/instgram-imgs/img-06.jpg" alt=""></a></li>--}}
{{--                                    <li><a href="#"><img src="images/instgram-imgs/img-07.jpg" alt=""></a></li>--}}
{{--                                    <li><a href="#"><img src="images/instgram-imgs/img-08.jpg" alt=""></a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Aside Widget -->--}}

{{--                        <!-- Aside Widget -->--}}
{{--                        <div class="aside-widget">--}}
{{--                            <h3><span>Tweet</span></h3>--}}
{{--                            <div class="twitter-list">--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        <h5><a href="#"><i class="fa fa-twitter"></i>Dhiren Adesara</a></h5>--}}
{{--                                        <p>Just posted an unbeliveably amazing sketch to make you feel sad about your skills <i>@dribble-drbl.in/efzh</i></p>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <h5><a href="#"><i class="fa fa-twitter"></i>Dhiren Adesara</a></h5>--}}
{{--                                        <p>Just posted an unbeliveably amazing sketch to make you feel sad about your skills <i>@dribble-drbl.in/efzh</i></p>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <h5><a href="#"><i class="fa fa-twitter"></i>Dhiren Adesara</a></h5>--}}
{{--                                        <p>Just posted an unbeliveably amazing sketch to make you feel sad about your skills <i>@dribble-drbl.in/efzh</i></p>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Aside Widget -->--}}

{{--                        <!-- Aside Widget -->--}}
{{--                        <div class="aside-widget">--}}
{{--                            <a href="#"><img src="images/adds.jpg" alt=""></a>--}}
{{--                        </div>--}}
{{--                        <!-- Aside Widget -->--}}

{{--                    </div>--}}
                    <!-- Aside -->

                </div>
            </div>
        </div>
        <!-- Blog Detail -->

    </main>
    <!-- Main Content -->
@endsection
