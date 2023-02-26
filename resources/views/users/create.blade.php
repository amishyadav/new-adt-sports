@extends('layouts.app')
@section('title')
    {{__('messages.user.add_user')}}
@endsection
@section('header_toolbar')
    <div class="toolbar">
        <div class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <a class="btn btn-outline-primary float-end"
                   href="{{ route('users.index') }}">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @include('layouts.errors')
                {{ Form::open(['route' => 'users.store' ,'files' => true]) }}
                @include('users.fields')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
