<?php

namespace Squirrel\Blog\Controllers\Admin;


use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Squirrel\Blog\Requests\PostRequest;
use Squirrel\Blog\Services\BlogService;

class CategoryController extends Controller
{
    public $permissions = [
        'blog.view' => ['index'],
        'blog.create' => ['create', 'store'],
        'blog.edit' => ['edit', 'update'],
        'blog.delete' => ['destroy']
    ];

    public $breadcrumbs = [
        ['link' => 'javascript:void(0)', 'name' => 'Content Manager']
    ];

    public $mainRouteName = 'admin.blog.categories.index';

    public $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();
        $this->blogService = $blogService;
    }

    public function index(Request $request)
    {
        $this->breadcrumb('Blogs');

        $categories = $this->blogService->allCategories();

        return view('Blog::admin.category.list', [
            'options' => $this->blogService->toSelect($categories),
            'categories' => $this->blogService->toTree($categories)
        ]);
    }

    public function store(Request $request) {

        $category = $this->blogService->createCategoryFromRequest($request);

        return $this->storeResponse($category);
    }

    public function edit(int $id, Request $request)
    {
        $this->breadcrumb('Blogs')->withButtonMain();

        $category = $this->blogService->secondFind($id);
        $categories = $this->blogService->allCategories();

        return view('Blog::admin.category.edit', [
            'options' => $this->blogService->toSelect($categories),
            'categories' => $this->blogService->toTree($categories),
            'category' => $category
        ]);
    }

    public function update(int $id, Request $request) {
        $category = $this->blogService->updateCategoryFromRequest($id, $request);

        return $this->updateResponse($category);
    }

    public function destroy(int $id, Request $request) {

        $this->blogService->secondDelete($id);

        return $this->deleteResponse();
    }

    public function sort(Request $request) {
        $this->blogService->sortCategoryFromRequest($request);

        return $this->updateResponse();
    }

}
