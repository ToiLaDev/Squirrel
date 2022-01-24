<?php

namespace Squirrel\Blog\DataTables;

use App\DataTables\BaseDataTable;
use Squirrel\Blog\Repositories\PostRepository;

class PostsDataTable extends BaseDataTable
{

    protected $exportColumns = [
        ['data' => 'id', 'title' => 'id'],
        ['data' => 'name', 'title' => 'name'],
        ['data' => 'title', 'title' => 'title'],
        ['data' => 'slug', 'title' => 'slug'],
        ['data' => 'image', 'title' => 'image'],
        ['data' => 'excerpt', 'title' => 'excerpt'],
        ['data' => 'owner_id', 'title' => 'owner_id'],
        ['data' => 'created_at', 'title' => 'created_at']
    ];

    protected $columns = [
        'id' => [
            'data' => '_id',
            'title' => 'ID',
            'raw' => [
                'type' => 'id'
            ]
        ],
        'image' => [
            'raw' => [
                'type' => 'image'
            ],
            'width' => 80
        ],
        'name' => [],
        'created_at' => [
            'raw' => []
        ],
        'action' => [
            'raw' => [
                'type' => 'acast'
            ],
            'width' => 80,
            'addClass' => 'text-center'
        ]
    ];

    protected $showButtons = ['create', 'excel', 'reload'];

    public function query(PostRepository $repository)
    {
        return $repository->newQuery();
    }
}
