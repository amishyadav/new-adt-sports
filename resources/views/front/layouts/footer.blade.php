<footer class="main-footer style-2">

    <!-- Footer Columns -->
    <div class="container">

        <!-- Footer columns -->
        <div class="footer-column border-0">
            <div class="row">

                <!-- Footer Column -->
                <div class="col-sm-4 col-xs-6 r-full-width-2 r-full-width">
                    <div class="column-widget h-white">
                        <div class="logo-column p-white">
                            <img class="footer-logo" src="{{asset(getAppLogo())}}" alt="">
                            <ul class="address-list style-2">
                                <li><span>Address:</span>1782 Harrison Street  Sun Prairie</li>
                                <li><span>Phone Number:</span>49 30 47373795</li>
                                <li><span>Email Address:</span>moin@blindtextgenerator.de</li>
                            </ul>
                            <span class="follow-us">follow us </span>
                            <ul class="social-icons">
                                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>
                                <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                <li><a class="tumblr" href="#"><i class="fa fa-tumblr"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Footer Column -->

                <!-- Footer Column -->
                <div class="col-lg-3 col-xs-6 r-full-width">
                    <div class="column-widget h-white">
                        <h5>INFORMATION</h5>
                        <ul class="footer-links">
                            <li><a href="{{ route('front.index') }}">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">team</a></li>
                            <li><a href="{{ route('front.blogs') }}">Blogs</a></li>
                            <li><a href="#">FAQS</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Footer Column -->

            </div>
        </div>
        <!-- Footer columns -->

    </div>
    <!-- Footer Columns -->

    <!-- Copy Rights -->
    <div class="copy-rights">
        <div class="container">
            <p>© Copyright by <i class="red-color">{{ getAppName() }}</i> All rights reserved.</p>
            <a class="back-to-top scrollup" href="#"><i class="fa fa-angle-up"></i></a>
        </div>
    </div>
    <!-- Copy Rights -->

</footer>
