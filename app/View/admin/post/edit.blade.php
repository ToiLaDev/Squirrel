@extends('layouts.admin')
@section('title', __('Edit Blog Post'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Form -->
                    <form class="mt-2" action="{{ route('admin.blog.posts.update', $post->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" value="{{ $post->id }}" >
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <x-forms.input name="name" :value="$post->name" />
                            </div>
                            <div class="col-md-6 col-12">
                                <x-forms.input name="slug" :value="$post->slug" />
                            </div>
                            <div class="col-12">
                                <x-forms.input name="title" :value="$post->title" />
                            </div>
                            <div class="col-12">
                                <x-forms.select name="categories" :options="$options" :multiple="true" :value="$categories" />
                            </div>
                            <div class="col-12">
                                <x-forms.textarea name="excerpt" :value="$post->excerpt" />
                            </div>
                            <div class="col-12">
                                <x-forms.quill name="body" :value="$post->body" />
                            </div>
                            <div class="col-12 mt-50">
                                <x-forms.image name="image" :value="$post->image" />
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