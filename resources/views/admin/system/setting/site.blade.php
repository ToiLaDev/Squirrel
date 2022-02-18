@extends('layouts.admin')
@section('title', __('Site Settings'))
@section('content')
    <div class="row">
        <div class="col-12">
            @include('Admin::system.setting.nav')
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{ __('Site Information') }}</h4>
                </div>
                <div class="card-body pt-1">
                    @form(['App\Forms\SettingForm', 'site'])
                </div>
            </div>
        </div>
    </div>
@endsection
