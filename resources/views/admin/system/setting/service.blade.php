@extends('layouts.admin')
@section('title', __('Services'))
@section('content')
    <div class="row">
        <div class="col-12">
            @include('Admin::system.setting.nav')
            <div class="card">
                <form class="form" method="post">
                    @method('put')
                    @csrf
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Facebook</h4>
                    </div>
                    <div class="card-body pt-1">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="customSwitch1" />
                                        <label class="form-check-label" for="customSwitch1">Toggle this switch element</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label for="company_name">{{__('Client Id')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="company_name" class="form-control" name="facebook[client_id]" value="123" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label for="company_name">{{__('Client Secret')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="company_name" class="form-control" name="facebook[client_secret]" value="121113" />
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1">{{__('Save Changes')}}</button>
                                <button type="reset" class="btn btn-outline-secondary">{{__('Discard')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
