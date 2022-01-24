<div class="blog-sidebar">
    <!-- Recent Posts -->
    <div class="blog-recent-posts mt-3">
        <h6 class="section-label">{{ __('Recent Posts') }}</h6>
        <div class="mt-75">
            @foreach($posts as $post)
            <div class="d-flex mb-2">
                <a href="{{ $post->cast->url }}" class="me-2">
                    <img
                            class="rounded"
                            src="{{ $post->image }}"
                            width="100"
                            height="70"
                            alt="{{ $post->title }}"
                    />
                </a>
                <div class="blog-info">
                    <h6 class="blog-recent-post-title">
                        <a href="{{ $post->cast->url }}" class="text-body-heading">{{ $post->name }}</a>
                    </h6>
                    <div class="text-muted mb-0">{{ $post->created_at->toFormattedDateString() }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!--/ Recent Posts -->
</div>
