@extends('layouts.admin')
@section('title', __('Blog Categories'))
@push('page-styles')
    <style>
        .sortable,
        .sortable ol {
            list-style: none;
            margin: 0;
        }
        .sortable {
            padding: 0;
        }
        .sortable li > div {
            min-height: 40px;
            border: 1px solid #d8d6de;
            border-radius: 5px;
            padding: 0 5px;
            line-height: 40px;
            margin-bottom: 5px;
            background-color: #fff;
        }
        .sortable .item-move {
            padding: 0.5rem;
            line-height: 0.5;
            background-color: transparent;
            color: #4b4b4b;
        }
    </style>
@endpush
@scripts('vendor', [
    'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
    'https://cdnjs.cloudflare.com/ajax/libs/nestedSortable/2.0.0/jquery.mjs.nestedSortable.js'
])
@push('page-scripts')
    <script>
        $(function () {
            const sortable = $('.sortable').nestedSortable({
                handle: '.item-move',
                items: 'li',
                toleranceElement: '> div',
                cursor: 'move'
            });
            $('.sortable-submit').on('click', function (e) {
                confirmAction(function () {
                    const sort = $('.sortable').nestedSortable('toHierarchy');
                    $.ajax({
                        url: '{{ route('admin.blog.categories.sort') }}',
                        type: 'PUT',
                        dataType: 'json',
                        data: {sort: sort},
                    });
                });
            });
            $('.sortable .item-delete').on('click', function (e) {
                confirmAction(function () {
                    const id = $(e.target).closest('li').data('id');
                    $.ajax({
                        url: `{{ route('admin.blog.categories.destroy', '') }}/${id}`,
                        type: 'DELETE',
                        dataType: 'json',
                    }).done(function(response) {
                        $(e.target).closest('li').remove();
                    });
                });
            });
        });
    </script>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-6 col-12">
            <form method="post" action="{{route('admin.blog.categories.store')}}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('Add New Category')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <x-forms.input name="name" same="title" slug="slug" />
                            </div>
                            <div class="col-12">
                                <x-forms.input name="title" />
                            </div>
                            <div class="col-12">
                                <x-forms.input name="slug" />
                            </div>
                            <div class="col-12">
                                <x-forms.textarea name="excerpt" />
                            </div>
                            <div class="col-12">
                                <x-forms.select name="parent_id" title="Parent" :options="$options" default="_____" />
                            </div>
                            <div class="col-12">
                                <x-forms.image name="image" />
                            </div>
                            <div class="col-12 mt-2">
                                <x-forms.action />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('Categories List')}}</h4>
                </div>
                <div class="card-body">
                    <ol class="sortable">
                        @foreach($categories as $category)
                            @include('Blog::admin.category.child', ['category' => $category])
                        @endforeach
                    </ol>
                </div>
                <div class="card-footer">
                    <button class="btn sortable-submit btn-primary me-1">{{ __('Save Changes') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection