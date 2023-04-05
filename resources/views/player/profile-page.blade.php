<div class="profile-content profile-block">
    <div class="card">
        <form class="form-card" onsubmit="event.preventDefault()">
            <div class="row justify-content-between text-left">
                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">First name
                        <span class="text-danger"> *</span>
                    </label>
                    <input type="text" id="fname" name="fname" placeholder="Enter your first name" class="form-control" value="{{ $user->first_name }}" disabled>
                </div>
                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Last name
                        <span class="text-danger"> *</span>
                    </label>
                    <input type="text" id="lname" name="lname" placeholder="Enter your last name" class="form-control" value="{{ $user->last_name }}" disabled>
                </div>
            </div>
            <div class="row justify-content-between text-left">
                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Email
                        <span class="text-danger"> *</span>
                    </label>
                    <input type="text" id="email" name="email" placeholder="Enter Email" class="form-control" value="{{ $user->email  }}" disabled>
                </div>
                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Phone number
                        <span class="text-danger"> *</span>
                    </label>
                    <input type="text" id="mob" name="mob" placeholder="Enter Mobile" class="form-control" value="{{ $user->contact }}" disabled>
                </div>
            </div>
            <div class="row justify-content-between text-left">
                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Position
                        <span class="text-danger"> *</span>
                    </label>
                    <input type="text" id="job" name="position" placeholder="" class="form-control" value="{{ $user->position }}" disabled>
                </div>
                @if($user->position_type)
                    <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Position Type
                            <span class="text-danger"> *</span>
                        </label>
                        <input type="text" id="job" name="type" placeholder="" class="form-control" value="{{ $user->position_type }}" disabled>
                    </div>
                @endif
            </div>
            <div class="row justify-content-between text-left">
                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Gender
                        <span class="text-danger"> *</span>
                    </label>
                    <input type="text" id="job" name="position" placeholder="" class="form-control" value="{{ $user->gender }}" disabled>
                </div>
                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Date of Birth
                        <span class="text-danger"> *</span>
                    </label>
                    <input type="text" id="job" name="type" placeholder="" class="form-control" value="{{ $user->dob }}" disabled>
                </div>
            </div>
            <div class="row justify-content-between text-left">
                <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Aadhar Card Image
                        <span class="text-danger"> *</span>
                    </label>
                    <div class="profile-header-img">
                        <img src="{{ $user->aadhar_image }}" alt="">
                    </div>
                </div>
            </div>
            {{--                                        <div class="row justify-content-end">--}}
            {{--                                            <div class="form-group col-sm-6">--}}
            {{--                                                <button type="submit" class="btn btn-primary">Submit</button>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
        </form>
    </div>
</div>
