@extends('layouts.app')
@section('title')
    {{ __('messages.common.option') }}
@endsection
@section('content')
    <div class="container-fluid">
        <livewire:options-table/>
        @include('manage_matches.questions_option.create_modal')
        @include('manage_matches.questions_option.edit_modal')
    </div>
@endsection
