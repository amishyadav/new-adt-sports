@extends('layouts.app')
@section('title')
    Teams
@endsection
@section('content')
    <div class="container-fluid">
        <livewire:teams-table/>
        @include('teams.create_modal')
        @include('teams.edit_modal')
    </div>
@endsection
