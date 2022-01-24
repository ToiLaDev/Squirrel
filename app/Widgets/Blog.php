<?php

namespace Squirrel\Blog\Widgets;

use Squirrel\Blog\Services\BlogService;

class Blog
{

    public static function categories() {
        $blogService = app()->make(BlogService::class);
        $categories = $blogService->allCategories();
        $categories->load(['cast']);
        echo widgetView('categories', [
            'categories'    => $blogService->toTree($categories)
        ]);
    }

    public static function recentPosts() {
        $blogService = app()->make(BlogService::class);
        echo widgetView('recent-posts', [
            'posts'    => $blogService->recentPosts()
        ]);
    }

    public static function search() {
        echo widgetView('search');
    }
}