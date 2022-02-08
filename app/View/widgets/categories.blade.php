<div class="blog-sidebar">
    <!-- Categories -->
    <div class="blog-categories mt-3">
        <h6 class="section-label">{{ __('Categories') }}</h6>
        <div class="mt-1">
            @foreach($categories as $category)
                <div class="mb-75">
                    <a class="d-flex justify-content-start align-items-center " href="{{ $category->cast->url }}">
                        <span class="avatar bg-light-primary rounded">
                            <span class="avatar-content">
                                <i data-feather="watch" class="avatar-icon font-medium-1"></i>
                            </span>
                        </span>
                        <span class="blog-category-title text-body">{{ $category->name }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <!--/ Categories -->
</div>