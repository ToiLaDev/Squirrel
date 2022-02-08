@extends('layouts.admin')
@section('title', __('Notifications'))
@scripts('vendor', asset(mix('vendors/js/forms/validation/jquery.validate.min.js')))
@styles('page', asset(mix('css/base/plugins/forms/form-validation.css')))
@section('content')
<div class="row">
    <div class="col-12">
        @include('Admin::account.nav')
        <!-- profile -->
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">{{ __('Notifications') }}</h4>
            </div>
            <div class="card-body pt-2">
                <h5 class="mb-0">
                    {!! __('We need permission from your browser to show notifications. <strong>Request permission</strong>') !!}
                </h5>
            </div>
            <form method="post">
                @method('put')
                @csrf
                <div class="table-responsive">
                    <table class="table text-nowrap text-center border-bottom">
                        <thead>
                            <tr>
                                <th class="text-start">{{ __('Type') }}</th>
                                @if(config('notify.email_enable'))
                                <th><i data-feather="mail"></i> {{ __('Email') }}</th>
                                @endif
                                @if(config('notify.browser_enable'))
                                <th><i data-feather="chrome"></i> {{ __('Browser') }}</th>
                                @endif
                                @if(config('notify.app_enable'))
                                <th><i data-feather="tablet"></i> {{ __('App') }}</th>
                                @endif
                                @if(config('notify.sms_enable'))
                                <th><i data-feather="message-square"></i> {{ __('Sms') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notifySetting as $setting)
                            <tr>
                                <td class="text-start">{{ __($setting['title']) }}</td>
                                @if(config('notify.email_enable'))
                                <td>
                                    @isset($setting['email'])
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input" type="checkbox" name="{{$setting['email']['key']}}" @if($setting['email']['value']) checked @endif />
                                    </div>
                                    @endisset
                                </td>
                                @endif
                                @if(config('notify.browser_enable'))
                                <td>
                                    @isset($setting['browser'])
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input" type="checkbox" name="{{$setting['browser']['key']}}" @if($setting['browser']['value']) checked @endif />
                                    </div>
                                    @endisset
                                </td>
                                @endif
                                @if(config('notify.app_enable'))
                                <td>
                                    @isset($setting['app'])
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input" type="checkbox" name="{{$setting['app']['key']}}" @if($setting['app']['value']) checked @endif />
                                    </div>
                                    @endisset
                                </td>
                                @endif
                                @if(config('notify.sms_enable'))
                                <td>
                                    @isset($setting['sms'])
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input" type="checkbox" name="{{$setting['sms']['key']}}" @if($setting['sms']['value']) checked @endif />
                                    </div>
                                    @endisset
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-body mt-50">
                    <div class="row gy-2">
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-1">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Discard</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--/ profile -->
    </div>
</div>
@endsection