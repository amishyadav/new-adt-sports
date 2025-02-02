<div>
    <div class="row mb-5">
        <div class="col-6">
            {{ Form::label('first_name', __('messages.user.first_name').':', ['class' => 'required form-label']) }}
            {{ Form::text('first_name',$user->first_name, ['class' => 'form-control ', 'placeholder' => __('messages.user.first_name'), 'required']) }}
        </div>
        <div class="col-6">
            {{ Form::label('last_name', __('messages.user.last_name').':', ['class' => 'required   form-label ']) }}
            {{ Form::text('last_name', $user->last_name, ['class' => 'form-control', 'placeholder' => __('messages.user.last_name'), 'required']) }}
        </div>
    </div>
    <div class="row mb-5">
        <div class=" col-6">
            {{ Form::label('contact', __('messages.user.contact_no').':', ['class' => 'form-label']) }}
            <br>
            {{ Form::tel('contact', isset($user) && $user->contact ? '+91'.$user->contact : null, ['class' => 'form-control w-100', 'placeholder' => __('messages.user.contact_no'), 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
            {{ Form::hidden('region_code',isset($user) ? $user->region_code : null,['id'=>'prefix_code']) }}
            <span id="valid-msg" class="text-success d-none fw-400 fs-small mt-2">{{ __('messages.valid_number') }}</span>
            <span id="error-msg" class="text-danger d-none fw-400 fs-small mt-2">{{ __('messages.invalid_number') }}</span>
        </div>
        <div class="col-6">
            {{ Form::label('email', __('messages.user.email').':', ['class' => 'required fs-5  form-label']) }}
            {{ Form::text('email', $user->email, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.user.email'), 'required']) }}
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-6">
            {{ Form::label('position', 'Position:', ['class' => 'required form-label']) }}
            {{ Form::text('position',$user->position, ['class' => 'form-control ', 'placeholder' => __('messages.user.first_name'), 'required']) }}
        </div>
        @if($user->position === 'Defender')
        <div class="col-6">
            {{ Form::label('position_type', 'Position Type:', ['class' => 'required   form-label ']) }}
            {{ Form::select('position_type', \App\Models\User::POSITION_TYPE,$user->position_type, ['class' => 'form-control', 'required']) }}
        </div>
        @endif
    </div>
    <div class="row mb-5">
        <div class="col-6">
            {{ Form::label('gender', 'Gender:', ['class' => 'required form-label']) }}
            {{ Form::radio('gender',$user->gender, ['class' => 'form-check-input', 'required']) }}Male
            {{ Form::radio('gender',$user->gender, ['class' => 'form-check-input', 'required']) }}Female
        </div>
            <div class="col-6">
                {{ Form::label('dob', 'DOB:', ['class' => 'required   form-label ']) }}
                {{ Form::date('dob', $user->dob, ['class' => 'form-control', 'placeholder' => __('messages.user.last_name'), 'required']) }}
            </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="mb-5">
                <div class="mb-3" io-image-input="true">
                    <label for="exampleInputImage" class="form-label">{{__('messages.common.profile')}}:</label>
                    <div class="d-block">
                        <div class="image-picker">
                            <div class="image previewImage" id="exampleInputImage"
                                 style="background-image: url({{ !empty($user->profile_image) ? $user->profile_image : asset('web/media/avatars/male.png') }})">
                            </div>
                            <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                  data-placement="top" data-bs-original-title="{{ __('messages.user.edit_profile') }}">
                        <label>
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="profilePicture" name="profile" class="image-upload d-none" accept="image/*" />
                        </label>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-5">
                <div class="mb-3" io-image-input="true">
                    <label for="exampleInputImage" class="form-label">Aadhar Card Image:</label>
                    <div class="d-block">
                        <div class="image-picker">
                            <div class="image previewImage" id="exampleInputImage"
                                 style="background-image: url({{ !empty($user->aadhar_image) ? $user->aadhar_image : asset('web/media/avatars/male.png') }})">
                            </div>
                            <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                  data-placement="top" data-bs-original-title="{{ __('messages.user.edit_profile') }}">
                        <label>
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="profilePicture" name="aadhar_image" class="image-upload d-none" accept="image/*" />
                        </label>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-5">
            <label class="form-label">{{__('messages.common.status')}}:</label>
            <div class="col-lg-8">
                <div class="form-check form-check-solid form-switch">
                    <input tabindex="12" name="status" value="0" class="form-check-input" type="checkbox"
                           id="allowmarketing" checked="checked">
                    <label class="form-check-label" for="allowmarketing"></label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex">
    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
    <a href="{{route('users.index')}}" type="reset"
       class="btn btn-secondary">{{__('messages.common.discard')}}</a>
</div>
