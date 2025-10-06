@extends('layouts.app')
@section('title')
    Team Match
@endsection
@section('content')
    <div class="container-fluid">
        <livewire:team-match-table/>
        @include('team_match.create_modal')
        @include('team_match.edit_modal')
    </div>
@endsection
