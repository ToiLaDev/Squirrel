@extends('layouts.blank')
@section('title', 'Not Authorized')
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
                <h2 class="mb-1">{{__('You are not authorized! 🔐')}}</h2>
                <p class="mb-2">{{__($exception->getMessage() ?: 'The Webtrends Marketing Lab website in IIS uses the default IUSR account credentials to access the web pages it serves.')}}</p>
                <img class="img-fluid" src="{{asset('images/pages/not-authorized.svg')}}" alt="Not authorized page" />
            </div>
        </div>
    </div>
    <!-- / Not authorized-->
@endsection
