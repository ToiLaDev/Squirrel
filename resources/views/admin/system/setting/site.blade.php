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
                    <form class="form" method="post">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <x-forms.input name="company_name" :value="config('site.company_name')" :required="true" />
                            </div>
                            <div class="col-md-6 col-12">
                                <x-forms.input name="company_address" :value="config('site.company_address')" :required="true" />
                            </div>
                            <div class="col-md-6 col-12">
                                <x-forms.input name="email" type="email" :value="config('site.email')" :required="true" />
                            </div>
                            <div class="col-md-6 col-12">
                                <x-forms.input name="phone" :value="config('site.phone')" :required="true" />
                            </div>
                            <div class="col-12 mt-1">
                                <h4>{{__('For SEO')}}</h4>
                                <hr>
                            </div>
                            <div class="col-md-6 col-12">
                                <x-forms.input name="name" :value="config('site.name')" :required="true" title="Site Name" />
                            </div>
                            <div class="col-md-6 col-12">
                                <x-forms.input name="title" :value="config('site.title')" :required="true" title="Site Title" />
                            </div>
                            <div class="col-12">
                                <x-forms.textarea name="description" :value="config('site.description')" :required="true" title="Site Description" />
                            </div>
                            <div class="col-12 mt-2">
                                <x-forms.action />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
