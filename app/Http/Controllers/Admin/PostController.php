<?php

namespace Squirrel\Blog\Controllers\Admin;


use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use Squirrel\Blog\DataTables\PostsDataTable;
use Squirrel\Blog\Requests\PostRequest;
use Squirrel\Blog\Services\BlogService;

class PostController extends Controller
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

    public $mainRouteName = 'admin.blog.posts.index';

    public $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();
        $this->blogService = $blogService;
    }

    public function index(PostsDataTable $dataTable)
    {
        $this->breadcrumb('Blogs');

        return $dataTable->render('Blog::admin.post.list');
    }

    public function create(Request $request)
    {
        $this->breadcrumb('Blogs')->withButtonMain();
        $categories = $this->blogService->allCategories();

        return view('Blog::admin.post.create', [
            'options' => $this->blogService->toSelect($categories)
        ]);
    }

    public function edit(int $id, Request $request)
    {
        $this->breadcrumb('Blogs')->withButtonMain();

        $categories = $this->blogService->allCategories();
        $post = $this->blogService->find($id);
        return view('Blog::admin.post.edit', [
            'post' => $post,
            'options' => $this->blogService->toSelect($categories),
            'categories' => $this->blogService->idCategories($post)
        ]);
    }

    public function store(PostRequest $request) {
        $post = $this->blogService->createFromRequest($request);

        return $this->storeResponse($post);
    }

    public function update(int $id, PostRequest $request) {
        $post = $this->blogService->updateFromRequest($id, $request);
        return $this->updateResponse($post);
    }

    public function destroy(int $id, Request $request) {

        $this->blogService->delete($id);

        return $this->deleteResponse();
    }

}
