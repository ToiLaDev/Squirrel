@extends('layouts.blank')
@section('title', 'Internal Error Server')
@styles('page', asset(mix('css/base/pages/page-misc.css')))
@section('content')
    <!-- Not authorized-->
    <div class="misc-wrapper">
        <a class="brand-logo" href="/">
            <x-images.logo />
            <h2 class="brand-text text-primary">{{ config('app.name') }}</h2>
        </a>
        <div class="misc-inner p-2 p-sm-3">
            <div class="w-100 text-center">
                <h2 class="mb-1">{{__('Internal Error Server 🕵🏻‍♀')}}</h2>
                <p class="mb-2">{{__($exception->getMessage() ?: 'Oops! 😖 The server encountered an internal error or misconfiguration and was unable to complete your request.')}}</p>
                <img class="img-fluid" src="{{asset('images/pages/error.svg')}}" alt="Error page" />
            </div>
        </div>
    </div>
    <!-- / Not authorized-->
@endsection
