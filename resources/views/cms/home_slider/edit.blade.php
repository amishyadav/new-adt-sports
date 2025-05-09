@extends('layouts.app')
@section('title')
    Edit Home Slider
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-5">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a href="{{ route('home-slider.index') }}" class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                    @include('layouts.errors')
                </div>
                {{ Form::model($homeSlider, ['route' => ['home-slider.update', $homeSlider->id], 'method' => 'put', 'id' => 'editHomeSliderForm', 'files' => 'true']) }}
                <div class="section-body">
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="col-sm-12 mb-5">
                                        {{ Form::label('main_title',__('Main Title').(':'), ['class' => 'form-label']) }}
                                        <span class="required"></span>
                                        {{ Form::text('main_title', $homeSlider['main_title'] ?? null, ['id'=>'editSliderMainTitle','class' => 'form-control']) }}
                                    </div>
                                    <div class="col-sm-12 mb-5">
                                        {{ Form::label('title',__('Title').(':'), ['class' => 'form-label']) }}
                                        <span class="required"></span>
                                        {{ Form::text('title', $homeSlider['title'] ?? null, ['id'=>'editSliderTitle','class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3" io-image-input="true">
                                        <label for="exampleInputImage" class="form-label">{{__('Image')}}
                                            :</label>
                                        <div class="d-block">
                                            <div class="image-picker">
                                                <div class="image previewImage" id="exampleInputImage"
                                                     style="width: 320px; height: 235px; background-image: url({{ !empty($homeSlider->slider_image) ? $homeSlider->slider_image : asset('web/media/avatars/male.png') }})">
                                                </div>
                                                <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                      data-bs-toggle="tooltip"
                                                      data-placement="top"
                                                      data-bs-original-title="{{ __('Slider Image') }}">
                                                <label>
                                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                    <input type="file" name="slider_image" id="editSliderImage"
                                                           class="image-upload d-none"
                                                           accept="image/*"/>
                                                </label>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-10">
                                {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        {{Form::hidden('editBlogBody',json_encode($emailTemplateGlobal['email_body'] ?? null),['id'=>'editBlogBody'])}}
    </div>
@endsection
