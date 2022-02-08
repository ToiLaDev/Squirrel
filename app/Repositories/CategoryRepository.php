<?php

namespace Squirrel\Blog\Repositories;

use App\Repositories\Repository;
use Squirrel\Blog\Models\BlogCategory;

class CategoryRepository extends Repository implements CategoryRepositoryImpl
{
    public function __construct(BlogCategory $category) {
        $this->_model = $category;
    }
}