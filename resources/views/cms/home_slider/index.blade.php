@extends('layouts.app')
@section('title')
    Home Slider
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('css/header-padding.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column ">
            @include('flash::message')
            <livewire:home-slider-table/>
        </div>
    </div>
@endsection
@section('page_js')
    <script>
        $(document).ready(function (){
            listenClick('.home-slider-delete-btn', function (event) {
                let homeSliderID = $(event.currentTarget).data('id')
                deleteItem(route('home-slider.destroy', homeSliderID), 'Home Slider')
            })
        });
    </script>
@endsection
