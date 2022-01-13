@extends('layouts.admin')
@section('title', __('Security'))
@scripts('vendor', asset(mix('vendors/js/forms/validation/jquery.validate.min.js')))
@styles('page', asset(mix('css/base/plugins/forms/form-validation.css')))
@section('content')
    <div class="row">
        <div class="col-12">
        @include('Admin::account.nav')
            <!-- profile -->
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{ __('Change Password') }}</h4>
                </div>
                <div class="card-body pt-1">
                    <!-- form -->
                    <form class="validate-form" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="account-old-password">{{ __('Current password') }}</label>
                                <div class="input-group form-password-toggle input-group-merge">
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="account-old-password"
                                        name="password"
                                        placeholder="{{ __('Enter current password') }}"
                                        data-msg="{{ __('Please current password') }}"
                                    />
                                    <div class="input-group-text cursor-pointer">
                                        <i data-feather="eye"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="account-new-password">{{ __('New Password') }}</label>
                                <div class="input-group form-password-toggle input-group-merge">
                                    <input
                                        type="password"
                                        id="account-new-password"
                                        name="new-password"
                                        class="form-control"
                                        placeholder="{{ __('Enter new password') }}"
                                    />
                                    <div class="input-group-text cursor-pointer">
                                        <i data-feather="eye"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="account-retype-new-password">{{ __('Retype New Password') }}</label>
                                <div class="input-group form-password-toggle input-group-merge">
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="account-retype-new-password"
                                        name="confirm-new-password"
                                        placeholder="{{ __('Confirm your new password') }}"
                                    />
                                    <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="fw-bolder">{{ __('Password requirements:') }}</p>
                                <ul class="ps-1 ms-25">
                                    <li class="mb-50">{{ __('Minimum 8 characters long - the more, the better') }}</li>
                                    <li class="mb-50">{{ __('At least one lowercase character') }}</li>
                                    <li>{{ __('At least one number, symbol, or whitespace character') }}</li>
                                </ul>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1 mt-1">{{ __('Save changes') }}</button>
                                <button type="reset" class="btn btn-outline-secondary mt-1">{{ __('Discard') }}</button>
                            </div>
                        </div>
                    </form>
                    <!--/ form -->
                </div>
            </div>
            <!--/ profile -->
        </div>
    </div>
@endsection
