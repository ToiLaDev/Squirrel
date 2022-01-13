@extends('layouts.blank')
@section('title', 'Page Not Found')
@styles('page', asset(mix('css/base/pages/page-misc.css')))
@section('content')
    <!-- Not authorized-->
    <div class="misc-wrapper">
        <a class="brand-logo" href="{{ route('home') }}">
            <x-images.logo />
            <h2 class="brand-text text-primary">{{ config('app.name') }}</h2>
        </a>
        <div class="misc-inner p-2 p-sm-3">
            <div class="w-100 text-center">
                <h2 class="mb-1">{{__('Page Not Found 🕵🏻‍♀')}}</h2>
                <p class="mb-2">{{__('Oops! 😖 The requested URL was not found on this server.')}}</p>
                <a class="btn btn-primary mb-2 btn-sm-block" href="{{ route('home') }}">{{__('Back to home')}}</a>

                <img class="img-fluid" src="{{asset('images/pages/error.svg')}}" alt="Error page" />
            </div>
        </div>
    </div>
    <!-- / Not authorized-->
@endsection
