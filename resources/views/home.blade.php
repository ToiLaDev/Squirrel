@extends('layouts.content')

@section('title', __('Home'))

@push('page-styles')
    {{-- Page Css files --}}
@endpush

@section('content')
    <section>
        <img class="w-100" src="/images/banner.png">
    </section>
{{--    <div class="col-3">--}}
{{--        <div class="row">--}}
{{--            @foreach($numbers as $number)--}}
{{--                <div class="col-2"><h3>{{$number}}</h3></div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
