@extends('layouts.app')
@section('title')
    {{ __('messages.common.blog') }}
@endsection
@section('content')
    <div class="container-fluid">
        <livewire:blog-table/>
        @include('cms.blog.create_modal')
        @include('cms.blog.edit_modal')
    </div>
@endsection
