@extends('front.layouts.app')
@section('title')
    Home
@endsection
@section('content')

<style>
    a:hover,
    a:focus{
        text-decoration: none;
        outline: none;
    }
    .vertical-tab{
        font-family: 'Montserrat', sans-serif;
        display: table;
    }
    .vertical-tab .nav-tabs{
        width: 20%;
        min-width: 20%;
        padding-left: 15px;
        border: none;
        vertical-align: top;
        display: table-cell;
    }
    .vertical-tab .nav-tabs li{ float: none; }
    .vertical-tab .nav-tabs li a{
        color: #444;
        background: linear-gradient(#e9e9e9,transparent);
        font-size: 17px;
        font-weight: 700;
        letter-spacing: 1px;
        text-align: center;
        text-transform: uppercase;
        padding: 10px 10px;
        margin: 0 0 15px 0;
        border: none;
        border-radius: 0;
        position: relative;
        z-index: 1;
        transition: all 0.3s ease 0s;
    }
    .vertical-tab .nav-tabs li a:hover,
    .vertical-tab .nav-tabs li.active a{
        color: #0b697e;
        background: linear-gradient(#e9e9e9,transparent);
        border: none;
    }
    .vertical-tab .nav-tabs li.active a:hover,
    .vertical-tab .nav-tabs li.active a{ color: #0b697e; }
    .vertical-tab .nav-tabs li a:before,
    .vertical-tab .nav-tabs li a:after{
        content: "";
        background: #0b697e;
        height: 10px;
        width: 10px;
        border-radius: 50%;
        transform: scale(0);
        position: absolute;
        bottom: -2px;
        left: 0;
        z-index: -1;
        transition: all 0.3s ease 0s;
    }
    .vertical-tab .nav-tabs li a:after{
        width: calc(100% - 5px);
        height: 3px;
        border-radius: 0;
        transform-origin: left center;
        bottom: 1px;
        left: 5px;
    }
    .vertical-tab .nav-tabs li.active a:before,
    .vertical-tab .nav-tabs li a:hover:before,
    .vertical-tab .nav-tabs li.active a:after,
    .vertical-tab .nav-tabs li a:hover:after{
        transform: scale(1);
    }
    .vertical-tab .tab-content{
        color: #000;
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 1px;
        line-height: 23px;
        padding: 20px;
        display: table-cell;
    }
    .vertical-tab .tab-content h3{
        font-size: 20px;
        font-weight: 700;
        text-transform: uppercase;
        margin: 0 0 7px;
    }
    @media only screen and (max-width: 479px){
        .vertical-tab .nav-tabs{
            width: 100%;
            display: block;
        }
        .vertical-tab .nav-tabs li a{ padding: 15px 10px 14px; }
        .vertical-tab .tab-content{
            font-size: 14px;
            display: block;
        }
    }

    .player-profile {
        margin: 74px 70px 41px;
    }


    .img-account-profile {
        height: 10rem;
    }
    .rounded-circle {
        border-radius: 50% !important;
    }
    .card {
        box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
    }
    .card .card-header {
        font-weight: 500;
    }
    .card-header:first-child {
        border-radius: 0.35rem 0.35rem 0 0;
    }
    .card-header {
        padding: 1rem 1.35rem;
        margin-bottom: 0;
        background-color: rgba(33, 40, 50, 0.03);
        border-bottom: 1px solid rgba(33, 40, 50, 0.125);
    }
    .form-control, .dataTable-input {
        display: block;
        width: 100%;
        padding: 0.875rem 1.125rem;
        /*font-size: 0.875rem;*/
        font-weight: 400;
        line-height: 1;
        background-clip: padding-box;
        border: 1px solid #c5ccd6;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0.35rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>


<div class="container player-profile">
    <div class="row">
        <div class="col-md-12">
            <div class="vertical-tab" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#Profile" aria-controls="home" role="tab" data-toggle="tab">Profile</a></li>
                    <li role="presentation"><a href="#Team" aria-controls="profile" role="tab" data-toggle="tab">Team</a></li>
                    <li role="presentation"><a href="#TeamMembers" aria-controls="messages" role="tab" data-toggle="tab">Team Members</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in active" id="Profile">
                        <h3>Profile</h3>
                        <div class="container-xl px-4 mt-4">
                            <!-- Account page navigation-->
                            <hr class="mt-0 mb-4">
                            <div class="row">
                                <div class="col-xl-4">
                                    <!-- Profile picture card-->
                                    <div class="card mb-4 mb-xl-0">
                                        <div class="card-header">Profile Picture</div>
                                        <div class="card-body padding-20 ">
                                            <!-- Profile picture image-->
                                            <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                            <!-- Profile picture help block-->
                                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                            <!-- Profile picture upload button-->
                                            <button class="btn btn-primary" type="button">Upload new image</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <!-- Account details card-->
                                    <div class="card mb-4 padding-20">
                                        <div class="card-header">Account Details</div>
                                        <div class="card-body">
                                            <form>
                                                <!-- Form Group (username)-->
                                                <div class="mb-3  mt-10">
                                                    <label class="small mb-1" for="inputUsername">Player ID</label>
                                                    <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="username">
                                                </div>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3  mt-10">
                                                    <!-- Form Group (first name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputFirstName">First name</label>
                                                        <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="Valerie">
                                                    </div>
                                                    <!-- Form Group (last name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputLastName">Last name</label>
                                                        <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="Luna">
                                                    </div>
                                                </div>
                                                <!-- Form Row        -->
                                                <div class="row gx-3 mb-3 mt-10">
                                                    <!-- Form Group (organization name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputOrgName">Position</label>
                                                        <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" value="Start Bootstrap">
                                                    </div>
                                                    <!-- Form Group (location)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputLocation">Location</label>
                                                        <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location" value="San Francisco, CA">
                                                    </div>
                                                </div>
                                                <!-- Form Group (email address)-->
                                                <div class="mb-3 mt-10">
                                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                                    <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="name@example.com">
                                                </div>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3 mt-10">
                                                    <!-- Form Group (phone number)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputPhone">Phone number</label>
                                                        <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="555-123-4567">
                                                    </div>
                                                    <!-- Form Group (birthday)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputBirthday">Birthday</label>
                                                        <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="Enter your birthday" value="06/10/1988">
                                                    </div>
                                                </div>

                                                <div class=" gx-3 mb-3 display-flex mt-10">
                                                    <label class="small mb-1" >Position</label>
                                                    <div class="form-check form-check-inline display-flex">
                                                    <input class="form-check-input profile-radio-button" type="radio" name="position" id="Raider" value="Raider">
                                                    <label class="form-check-label" for="Raider">Raider</label>
                                                    </div>
                                                    <div class="form-check form-check-inline display-flex">
                                                        <input class="form-check-input profile-radio-button" type="radio" name="position" id="Defender" value="Defender">
                                                        <label class="form-check-label" for="Defender">Defender</label>
                                                    </div>

                                                    <div class="form-check form-check-inline display-flex">
                                                        <input class="form-check-input profile-radio-button" type="radio" name="position" id="allRounder" value="All Rounder">
                                                        <label class="form-check-label" for="allRounder">All Rounder</label>
                                                    </div>
                                                </div>

                                                <div class=" gx-3 mb-3 display-flex mt-10 display-flex">
                                                    <label class="small mb-1">Gender:</label>

                                                    <div class="form-check form-check-inline display-flex">
                                                        <input class="form-check-input profile-radio-button" type="radio" name="gender" id="Male" value="Male">
                                                        <label class="form-check-label" for="Male">Male</label>
                                                    </div>
                                                    <div class="form-check form-check-inline display-flex">
                                                        <input class="form-check-input profile-radio-button" type="radio" name="gender" id="Female" value="Female">
                                                        <label class="form-check-label" for="Female">Female</label>
                                                    </div>
                                                </div>

                                                <!-- Save changes button-->
                                                <button class="btn btn-primary mt-10" type="button">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="Team">
                        <h3>Team</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius, mi eros viverra massa.</p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="TeamMembers">
                        <h3>Team Members</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius, mi eros viverra massa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
