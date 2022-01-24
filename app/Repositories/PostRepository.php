<?php

namespace Squirrel\Blog\Repositories;

use App\Repositories\Repository;
use Squirrel\Blog\Models\BlogPost;

class PostRepository extends Repository implements PostRepositoryImpl
{
    public function __construct(BlogPost $post) {
        $this->_model = $post;
    }
}