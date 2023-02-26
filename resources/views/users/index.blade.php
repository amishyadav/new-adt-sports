@extends('layouts.app')
@section('title')
    {{__('messages.user.user')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('layouts.errors')
        @include('flash::message')
        <livewire:user-table/>
    </div>
@endsection
