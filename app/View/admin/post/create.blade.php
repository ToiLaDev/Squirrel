@extends('layouts.admin')
@section('title', __('Create Blog Post'))
@scripts('vendor', [
    asset(mix('vendors/js/ui/jquery.sticky.js')),
    asset(mix('vendors/js/extensions/toastr.min.js'))
])
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Form -->
                    <form class="mt-2" action="{{ route('admin.blog.posts.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <x-forms.input name="name" slug="slug" same="title" />
                            </div>
                            <div class="col-md-6 col-12">
                                <x-forms.input name="slug" />
                            </div>
                            <div class="col-12">
                                <x-forms.input name="title" />
                            </div>
                            <div class="col-12">
                                <x-forms.select name="categories" :options="$options" :multiple="true" />
                            </div>
                            <div class="col-12">
                                <x-forms.textarea name="excerpt" />
                            </div>
                            <div class="col-12">
                                <x-forms.quill name="body" />
                            </div>
                            <div class="col-12 mt-50">
                                <x-forms.image name="image" />
                            </div>
                            <div class="col-12 mt-50">
                                <x-forms.action />
                            </div>
                        </div>
                    </form>
                    <!--/ Form -->
                </div>
            </div>
        </div>
    </div>
@endsection