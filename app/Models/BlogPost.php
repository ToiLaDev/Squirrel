<?php

namespace Squirrel\Blog\Models;

use App\Models\Base;
use App\Models\Employee;
use App\Traits\CastTrait;
use App\Traits\LogActivityTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Base {
    use SoftDeletes, CastTrait, LogActivityTrait;

    protected $table = 'blog_posts';

    protected $fillable = ['name', 'image', 'title', 'excerpt', 'body', 'owner_id'];

    public function owner()
    {
        return $this->belongsTo(Employee::class, 'owner_id');
    }

    public function categories() {
        return $this->belongsToMany(BlogCategory::class, 'blog_categories_posts', 'post_id', 'category_id');
    }
}
