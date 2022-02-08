<?php

namespace Squirrel\Blog\Services;


interface BlogServiceImpl
{
    public function createCategoryFromRequest($request);
    public function updateCategoryFromRequest(int $id, $request);
    public function sortCategoryFromRequest($request);
    public function idCategories($post);
    public function toSelect($categories);
    public function allCategories();
}