@extends('layouts.app')
@section('title')
    {{ __('messages.common.question') }}
@endsection
@section('content')
    <div class="container-fluid">
        <livewire:questions-table/>
        @include('manage_matches.match_questions.create_modal')
        @include('manage_matches.match_questions.edit_modal')
    </div>
@endsection
