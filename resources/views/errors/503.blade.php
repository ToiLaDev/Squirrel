@extends('layouts.blank')
@section('title', 'Under Maintenance')
@styles('page', asset(mix('css/base/pages/page-misc.css')))
@section('content')
    <!-- Under maintenance-->
    <div class="misc-wrapper">
        <a class="brand-logo" href="{{ route('home') }}">
            <x-images.logo />
            <h2 class="brand-text text-primary">{{ config('app.name') }}</h2>
        </a>
        <div class="misc-inner p-2 p-sm-3">
            <div class="w-100 text-center">
                <h2 class="mb-1">{{ __('Under Maintenance 🛠') }}</h2>
                <p class="mb-3">{{ __('Sorry for the inconvenience but we\'re performing some maintenance at the moment') }}</p>
                <form class="form-inline justify-content-center row m-0 mb-2" action="javascript:void(0);">
                    <input class="form-control col-12 col-md-5 mb-1 me-md-2" id="notify-email" type="text" placeholder="john@example.com" />
                    <button class="btn btn-primary mb-1 btn-sm-block" type="submit">{{ __('Notify') }}</button>
                </form>
                <img class="img-fluid" src="{{asset('images/pages/under-maintenance.svg')}}" alt="Under maintenance page" />
            </div>
        </div>
    </div>
    <!-- / Under maintenance -->
@endsection
