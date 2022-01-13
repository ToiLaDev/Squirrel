@extends('layouts.admin')
@section('title', __('Account'))
@scripts('vendor', asset(mix('vendors/js/forms/validation/jquery.validate.min.js')))
@styles('page', asset(mix('css/base/plugins/forms/form-validation.css')))
@push('page-scripts')
    <script type="text/javascript">
        $(function () {
            $('#account-avatar-file').on('change', function (e) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#account-avatar').attr('src', e.target.result);
                };
                reader.readAsDataURL($(this)[0].files[0]);
            });
            $('#account-avatar-reset').on('click', function (e) {
                $('#account-avatar-file').val(null);
                $('#account-avatar').attr('src', '{!! $admin->avatar !!}');
            });
        });
    </script>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
        @include('Admin::account.nav')
            <!-- profile -->
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{ __('Profile Details') }}</h4>
                </div>
                <div class="card-body py-2 my-25">
                    <!-- form -->
                    <form class="validate-form" method="post" enctype="multipart/form-data" >
                    @method('put')
                    @csrf
                    <!-- header section -->
                    <div class="d-flex">
                        <a href="#" class="me-25">
                            <img
                                src="{{$admin->avatar}}"
                                id="account-avatar"
                                class="uploadedAvatar rounded me-50"
                                alt="profile image"
                                height="100"
                                width="100"
                            />
                        </a>
                        <!-- upload and reset button -->
                        <div class="d-flex align-items-end mt-75 ms-1">
                            <div>
                                <label for="account-avatar-file" class="btn btn-sm btn-primary mb-75 me-75">{{ __('Upload') }}</label>
                                <input type="file" id="account-avatar-file" name="avatar" hidden accept="image/*" />
                                <button type="button" id="account-avatar-reset" class="btn btn-sm btn-outline-secondary mb-75">{{ __('Reset') }}</button>
                                <p class="mb-0">{{ __('Allowed file types: png, jpg, jpeg.') }}</p>
                            </div>
                        </div>
                        <!--/ upload and reset button -->
                    </div>
                    <!--/ header section -->
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <x-forms.input name="first_name" :value="$admin->first_name" />
                            </div>
                            <div class="col-12 col-sm-6">
                                <x-forms.input name="last_name" :value="$admin->last_name" />
                            </div>
                            <div class="col-12 col-sm-6">
                                <x-forms.input name="email" type="email" :value="$admin->email" />
                            </div>
                            <div class="col-12 col-sm-6">
                                <x-forms.input name="phone" :value="$admin->phone" title="Phone Number" />
                            </div>
                            <div class="col-12 col-sm-6">
                                <x-forms.input name="birthday" type="date" :value="$admin->birthday" title="Birth date" />
                            </div>
                            <div class="col-12 col-sm-6">
                                <x-forms.select name="gender" :value="$admin->gender" :options="['other','male','female']" />
                            </div>
                            <div class="col-12 mt-2">
                                <x-forms.action />
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
