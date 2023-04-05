@extends('auth.layouts.app')
@section('title')
    Registration
@endsection
@section('content')
    <!-- Login 1 start -->
    <div class="login-1">
        <div class="container-fluid">
            <div class="row login-box">
                <div class="col-lg-6 align-self-center pad-0 form-section">
                    <div class="form-inner">
                        <a href="#" class="logo">
                            <img src="{{$setting['logo']}}" alt="logo">
                        </a>
                        <h3>Registration</h3>
                        @include('flash::message')
                        @include('layouts.errors')
                        {{ Form::open(['route' => 'front.register.store' ,'files' => true,'id' => 'commonForm']) }}
                        <input type="hidden" name="type" value="player">
                        <div class="form-group position-relative clearfix">
                            <input name="first_name" type="text" class="form-control" placeholder="First Name" aria-label="First Name" required {{ old('first_name') }}>
                        </div>
                        <div class="form-group position-relative clearfix">
                            <input name="last_name" type="text" class="form-control" placeholder="Last Name" aria-label="Last Name" required>
                        </div>
                        <div class="form-group position-relative clearfix">
                            <input name="email" type="email" class="form-control" placeholder="Email Address" aria-label="Email Address" required>
                            <!--                            <div class="login-popover login-popover-abs" data-bs-toggle="popover" data-bs-trigger="hover" title="Clarification" data-bs-content="And here's some amazing content. It's very engaging. Right?">-->
                            <!--                                <i class="fa fa-info-circle"></i>-->
                            <!--                            </div>-->
                        </div>
                        <div class="form-group clearfix position-relative password-wrapper">
                            <input name="password" type="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password" required>
                            <i class="fa fa-eye password-indicator"></i>
                        </div>
                        <div class="form-group clearfix position-relative password-wrapper">
                            <input name="password_confirmation" type="password" class="form-control" autocomplete="off" placeholder="Confirm Password" aria-label="Password" required>
                            <i class="fa fa-eye password-indicator"></i>
                        </div>
                        <div class="form-group position-relative clearfix">
                            <input name="contact" type="number" class="form-control" placeholder="Contact Number" required minlength="10" maxlength="10">
                        </div>
                        <div class="form-group position-relative float-start clearfix d-flex w-100">
                            Position:
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="position" id="Raider" value="Raider">
                                <label class="form-check-label" for="Raider">Raider</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="position" id="Defender" value="Defender">
                                <label class="form-check-label" for="Defender">Defender</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="position" id="allRounder" value="All Rounder">
                                <label class="form-check-label" for="allRounder">All Rounder</label>
                            </div>
                        </div>
                        <div class="form-group position-relative float-start clearfix d-flex w-100 position-type d-none">
                            <select name="position_type" class="form-control" required>
                                <option value="Left Corner" selected>Left Corner</option>
                                <option value="Right Corner">Right Corner</option>
                                <option value="Left Cover">Left Cover</option>
                                <option value="Right Cover">Right Cover</option>
                            </select>
                        </div>
                        <div class="form-group position-relative float-start clearfix">
                            Gender:
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="Male" value="Male">
                                <label class="form-check-label" for="Male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="Female" value="Female">
                                <label class="form-check-label" for="Female">Female</label>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="form-group position-relative clearfix float-start w-100">
                            <label for="dob" class="float-start">Date of Birth:</label>
                            <input name="dob" type="date" class="form-control" id="dob" required>
                        </div>
                        <div class="form-group position-relative float-start clearfix w-100">
                            <label for="aadharImage" class="form-label float-start">Aadhar Card Image:</label>
                            <input class="form-control" type="file" id="aadharImage" name="aadhar_card_image" required>
                        </div>
                        <div class="form-group position-relative float-start clearfix w-100">
                            <label for="profile" class="form-label float-start">Profile Image:</label>
                            <input class="form-control" type="file" id="profile" name="profile" required>
                        </div>
                        <div class="form-group clearfix">
                            <button type="submit" class="btn btn-primary btn-lg btn-theme">Register</button>
                        </div>
                        <!--                        <div class="extra-login clearfix">-->
                        <!--                            <span>Or Login With</span>-->
                        <!--                        </div>-->
                        {{ Form::close() }}
                        <div class="d-flex align-items-center mt-4">
                            <span class="text-gray-700 me-2">{{__('messages.already_have_an_account').'?'}}</span>
                            <a href="{{ route('login') }}" class="link-info fs-6 text-decoration-none">
                                {{__('messages.sign_in_here')}}
                            </a>
                        </div>
                        <!--                    <div class="clearfix"></div>-->
                        <!--                    <div class="social-list clearfix">-->
                        <!--                        <div class="icon facebook">-->
                        <!--                            <div class="tooltip">Facebook</div>-->
                        <!--                            <span><i class="fa fa-facebook"></i></span>-->
                        <!--                        </div>-->
                        <!--                        <div class="icon twitter">-->
                        <!--                            <div class="tooltip">Twitter</div>-->
                        <!--                            <span><i class="fa fa-twitter"></i></span>-->
                        <!--                        </div>-->
                        <!--                        <div class="icon instagram">-->
                        <!--                            <div class="tooltip">Google</div>-->
                        <!--                            <span><i class="fa fa-google"></i></span>-->
                        <!--                        </div>-->
                        <!--                        <div class="icon github mr-0">-->
                        <!--                            <div class="tooltip">Linkedin</div>-->
                        <!--                            <span><i class="fa fa-linkedin"></i></span>-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                        <!--                    <p>Already a member? <a href="login-1.html">Login here</a></p>-->
                    </div>
                </div>
                <div class="col-lg-6 pad-0 none-992 bg-img">
                    <div class="lines">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                    <div class="info">
                        <div class="animated-text">
                            <h1>Welcome <span>to ADT SPORTS</span></h1>
                        </div>
{{--                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.  make a type specimen book.  make a type specimen book.</p>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login 1 end -->
@endsection
@section('page_js')
    <script>
        $(document).ready(function () {
            $('#Defender').click(function () {
                $('.position-type').removeClass('d-none')
            })

            $('#allRounder,#Raider').click(function () {
                $('.position-type').addClass('d-none')
            })
        })
    </script>
@endsection

