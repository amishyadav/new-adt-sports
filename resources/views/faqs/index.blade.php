@extends('layouts.app')
@section('title')
    {{ __('messages.faqs.faqs') }}
@endsection
@section('content')
    <div class="container-fluid">
        <livewire:faqs-table/>
        @include('faqs.create_modal')
        @include('faqs.edit_modal')
    </div>
@endsection
