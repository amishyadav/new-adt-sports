@extends('layouts.app')
@section('title')
    {{ __('messages.matches.all_matches') }}
@endsection
@section('content')
    <div class="container-fluid">
        <livewire:all-matches-table/>
        @include('manage_matches.all_matches.create_modal')
        @include('manage_matches.all_matches.edit_modal')
    </div>
@endsection
