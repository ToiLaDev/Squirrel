<?php

namespace Squirrel\Blog\Services;

use App\Services\RepositoryService;
use Squirrel\Blog\Repositories\CategoryRepository;
use Squirrel\Blog\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;

class BlogService extends RepositoryService implements BlogServiceImpl
{

    public function __construct(PostRepository $postRepo, CategoryRepository $categoryRepo) {
        $this->firstRepo = $postRepo;
        $this->secondRepo = $categoryRepo;
    }

    public function createFromRequest($request)
    {
        $attributes = $request->only(['name', 'image', 'title', 'excerpt', 'body']);
        $slug = $request->get('slug');
        $categories = $request->get('categories');

        $attributes['owner_id'] = Auth::id();
        $post = $this->firstRepo->create($attributes);

        $post->setCast($slug);

        $post->categories()->attach($categories);

        return $post;
    }

    public function updateFromRequest(int $id, $request)
    {
        $attributes = $request->only(['name', 'image', 'title', 'excerpt', 'body']);
        $slug = $request->get('slug');

        $post = $this->firstRepo->update($id, $attributes);

        $post->setCast($slug);

        return $post;
    }

    public function createCategoryFromRequest($request)
    {
        $attributes = $request->only(['name', 'title', 'excerpt', 'image', 'parent_id']);
        $slug = $request->get('slug');

        $category = $this->secondRepo->create($attributes);

        $category->setCast($slug);

        return $category;
    }

    public function updateCategoryFromRequest(int $id, $request)
    {
        $attributes = $request->only(['name', 'title', 'excerpt', 'image', 'parent_id']);
        $slug = $request->get('slug');

        $category = $this->secondRepo->update($id, $attributes);

        $category->setCast($slug);

        return $category;
    }

    public function sortCategoryFromRequest($request)
    {
        $data = $request->get('sort');

        $this->secondRepo->model()->rebuildTree($data);
    }

    public function allCategories()
    {
        return $this->secondRepo->newQuery()->withDepth()->defaultOrder()->get();
    }

    public function toSelect($categories) {
        $categories = $categories->toFlatTree();
        $options = [];
        foreach ($categories as $category) {
            $options[] = [
                'title' => $this->depthName($category->name, $category->depth),
                'value' => $category->id
            ];
        }
        return $options;
    }

    public function toTree($categories) {
        return $categories->toTree();
    }

    protected function depthName($name, $depth, $prefix = '-') {
        while ($depth > 0) {
            $depth--;
            $name = $prefix . $name;
        }
        return $name;
    }

    public function idCategories($post) {
        return $post->categories->pluck('id')->toArray();
    }

    public function recentPosts($limit = 5) {
        return $this->firstRepo->newQuery()->with('cast')->limit($limit)->orderBy('id', 'desc')->get();
    }
}