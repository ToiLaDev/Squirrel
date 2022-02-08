<?php

namespace Squirrel\Blog\Controllers;

use App\Http\Controllers\Controller;
use Squirrel\Blog\Models\BlogPost;

class PostController extends Controller
{
    public function displayView(BlogPost $post) {
        $post->load(['owner:id,first_name,last_name,email,avatar', 'categories:id,name', 'categories.cast']);
        return moduleView('post' , ['post' => $post]);
    }
}
