@extends('layouts.app')
@section('title')
    {{__('messages.setting.setting')}}
@endsection
@section('header_toolbar')
    <div class="container-fluid mb-5">
        <h1>{{__('messages.setting.setting')}}</h1>
    </div>
@endsection
@section('content')
    @php $styleCss = 'style'; @endphp
    <div class="container-fluid">
        @include('layouts.errors')
        @include('flash::message')
        <div class="card">
            {{ Form::open(['route' => 'settings.update', 'files' => true, 'id'=>'SEOToolsForm','class'=>'form']) }}
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-lg-4">
                        {{ Form::label('app_name',__('messages.setting.app_name').':',['class'=>'form-label required']) }}
                    </div>
                    <div class="col-lg-8">
                        {{ Form::text('app_name', $setting['app_name'], ['class' => 'form-control','placeholder'=>__('messages.setting.app_name'),'required']) }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-4">
                        {{ Form::label('contact_no',__('messages.setting.contact_number').':',['class'=>'form-label required']) }}
                    </div>
                    <div class="col-lg-8">
                        {{ Form::text('contact_no', $setting['contact_no'], ['class' => 'form-control ','placeholder'=>__('messages.setting.contact_number'),'required']) }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-4">
                        {{ Form::label('email',__('messages.user.email').':',['class'=>'form-label required']) }}
                    </div>
                    <div class="col-lg-8">
                        {{ Form::email('email', $setting['email'], ['class' => 'form-control','placeholder'=>__('messages.user.email'),'required']) }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-4">
                        {{ Form::label('address','Address:',['class'=>'form-label']) }}
                    </div>
                    <div class="col-lg-8">
                        {{ Form::text('address', $setting['address'], ['class' => 'form-control','placeholder'=> 'Enter Address']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label for="exampleInputImage" class="form-label">{{__('messages.setting.logo')}}: </label>
                        <span data-bs-toggle="tooltip"
                              data-placement="top"
                              data-bs-original-title="Best resolution for this logo will be 90x60.">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                        </span>
                    </div>
                    <div class="col-lg-8">
                        <div class="mb-3" io-image-input="true">
                            <div class="d-block">
                                <div class="image-picker">
                                    <div class="image previewImage" id="exampleInputImage"
                                         {{$styleCss}}="background-image: url({{($setting['logo'])?$setting['logo']:asset('images/logo.png')}})">
                                    </div>

                                    <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                          data-bs-toggle="tooltip"
                                          data-placement="top"
                                          data-bs-original-title="{{__('messages.setting.change_logo')}}">
                                        <label>
                                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                            <input type="file" name="logo" class="image-upload d-none"
                                                   accept="image/*"/>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-4">
                        <label for="exampleInputImage" class="form-label">{{__('messages.setting.favicon')}}: </label>
                        <span data-bs-toggle="tooltip"
                              data-placement="top"
                              data-bs-original-title="Best resolution for this favicon will be 32X32.">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                        </span>
                    </div>
                    <div class="col-lg-8">
                        <div class="mb-3" io-image-input="true">
                            <div class="d-block">
                                <div class="image-picker">
                                    <div class="image previewImage w-60px h-60px" id="exampleInputImage"
                                         style="background-image: url({{($setting['favicon'])?asset($setting['favicon']):asset('images/Infy-hms-logo.png')}})">
                                    </div>
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                          data-bs-toggle="tooltip"
                                          data-placement="top"
                                          data-bs-original-title="{{__('messages.user.change_favicon')}}">
                                        <label>
                                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                            <input type="file" name="favicon" class="image-upload d-none"
                                                   accept="image/*"/>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex pt-0 justify-content-start">
                    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary']) }}
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection

