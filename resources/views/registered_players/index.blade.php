@extends('layouts.app')
@section('title')
    Registered Players
@endsection
@section('content')
    <div class="container-fluid">
                <livewire:registered-player-table/>
                @include('registered_players.create_modal')
                @include('registered_players.edit_modal')
    </div>
@endsection
