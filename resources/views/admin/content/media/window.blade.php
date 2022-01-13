@extends('layouts.blank')
@section('title', __('Media library'))
@push('page-styles')
    <style>
        html, body {
            height: 100%;
            overflow: hidden;
        }
        .media-manager {
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            position: fixed;
            margin-bottom: 0;
        }
        .media-manager > .card-body {
            max-height: calc(100% - 150px);
            overflow-x: auto;
        }
    </style>
@endpush
@section('content')
    <x-media.manager/>
@endsection
