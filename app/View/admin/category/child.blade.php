<li id="menuItem_{{$category->id}}" data-id="{{$category->id}}">
    <div>
        <span class="item-move">
            <i class="fa fa-arrows-alt"></i>
        </span>
        {{ $category->name }}
        <span class="float-end">
            <a class="item-edit btn btn-sm btn-icon btn-flat-success" href="{{ route('admin.blog.categories.edit', $category->id) }}">
                <i class="fa fa-edit"></i>
            </a>
            <button class="item-delete btn btn-sm btn-icon btn-flat-danger">
                <i class="fa fa-trash-alt"></i>
            </button>
        </span>
    </div>
    @if($category->children)
        <ol>
            @foreach($category->children as $children)
                @include('Blog::admin.category.child', ['category' => $children])
            @endforeach
        </ol>
    @endif
</li>
