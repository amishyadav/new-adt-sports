@extends('layouts.app')
@section('title')
    Add Home Slider
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
                {{ Form::open(['route' => 'home-slider.store', 'method' => 'post', 'id' => 'addHomeSliderForm', 'files' => 'true']) }}
                <div class="section-body">
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="col-sm-12 mb-5">
                                        {{ Form::label('main_title','Main Title:', ['class' => 'form-label']) }}
                                        <span class="required"></span>
                                        {{ Form::text('main_title', null, ['id'=>'sliderMainTitle','class' => 'form-control']) }}
                                    </div>
                                    <div class="col-sm-12 mb-5">
                                        {{ Form::label('title','Title:', ['class' => 'form-label']) }}
                                        <span class="required"></span>
                                        {{ Form::text('title', null, ['id'=>'sliderTitle','class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3" io-image-input="true">
                                        <label for="exampleInputImage" class="form-label">
                                            Image:</label>
                                        @php $styleCss = 'style' @endphp
                                        <div class="d-block">
                                            <div class="image-picker">
                                                <div class="image previewImage" id="exampleInputImage" {{ $styleCss }}="background-image: url('{{ asset(getAppLogo()) }}');width: 330px; height: 235px;">
                                                </div>
                                                <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                      data-bs-toggle="tooltip"
                                                      data-placement="top"
                                                      data-bs-original-title="Change image">
                                                <label>
                                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                    <input type="file" name="slider_image" id="sliderImage"
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
    </div>
@endsection
