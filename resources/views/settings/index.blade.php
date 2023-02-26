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
                        {{ Form::label('copy_right_text',__('messages.setting.copy_right_text').':',['class'=>'form-label required ']) }}
                    </div>
                    <div class="col-lg-8">
                        {{ Form::text('copy_right_text', $setting['copy_right_text']??null, ['class' => 'form-control','placeholder'=>__('messages.setting.copy_right_text'),'required']) }}
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
                                         style="background-image: url({{($setting['logo'])?asset($setting['logo']):asset('images/logo.png')}})">
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
                <div class="row mb-5">
                    <div class="col-lg-4">
                        {{ Form::label('clear_cache',__('messages.setting.clear_cache').':',['class'=>'form-label']) }}
                    </div>
                    <div class="form-group col-sm-2 mb-5">
                        <a class="btn btn-primary" data-turbo="false" aria-current="page"
                           href="{{ route('clear-cache') }}">
                            <span>{{ __('messages.setting.clear_cache') }}</span>
                        </a>
                    </div>
                </div>
                <div class="card-header px-0 border-1">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="m-0">{{__('messages.payment.payment_method')}}
                        </h3>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-6">
                        <div class="table-responsive px-0">
                            <table>
                                <tbody class="d-flex flex-wrap">
                                @foreach($paymentGateways as $key => $paymentGateway)
                                    <tr class="w-100 d-flex justify-content-between">
                                        <td class="p-2">
                                            <div class="form-check form-check-custom">
                                                <input class="form-check-input" type="checkbox" value="{{$key}}"
                                                       name="payment_gateway[]"
                                                       id="{{$key}}" {{in_array($paymentGateway, $selectedPaymentGateways) ?'checked':''}} />
                                                <label class="form-label" for="{{$key}}">
                                                    {{$paymentGateway}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex pt-0 justify-content-start">
                    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary']) }}
                </div>
                {{Form::close()}}
                <div class="card-header px-0 border-1">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="m-0">{{__('Google Captcha')}}</h3>
                    </div>
                </div>
                {{ Form::open(['route' => 'settings.update', 'files' => true, 'id'=>'google_captcha_form','class'=>'form']) }}
                {{--            {{ Form::hidden('sectionName', $sectionName.'_1') }}--}}
                    <div class="row my-5">
                        <div class="col-lg-4">
                            {{ Form::label('show_captcha',__('Show Captcha').':',
                                         ['class'=>'form-label fs-6']) }}
                        </div>
                        <div class="col-lg-8">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input w-30px h-20px is-active"
                                       name="show_captcha" id="show_captcha"
                                       type="checkbox" value="1"
                                        {{ $setting['show_captcha'] ? 'checked' : ''}} >
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 mb-5 captchaOptions {{$setting['show_captcha'] ? '' : 'd-none'}}">
                        <div class="col-lg-4">
                            {{ Form::label('site_key',__('Site Key').':',
                                     ['class'=>'form-label required fs-6']) }}
                        </div>
                        <div class="col-lg-8">
                            {{ Form::text('site_key', $setting['site_key']??null, ['class' => 'form-control','placeholder'=>__('Site Key')]) }}
                        </div>
                    </div>
                    <div class="row mb-5 captchaOptions {{$setting['show_captcha'] ? '' : 'd-none'}}">
                        <div class="col-lg-4">
                            {{ Form::label('secret_key',__('Secret Key').':',
                                    ['class'=>'col-lg-4 form-label required fs-6']) }}
                        </div>
                        <div class="col-lg-8">
                            {{ Form::text('secret_key', $setting['secret_key']??null, ['class' => 'form-control','placeholder'=>__('Secret Key')]) }}
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mt-5">
                        {{ Form::submit(__('Save Changes'),['class' => 'btn btn-primary']) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
@endsection

