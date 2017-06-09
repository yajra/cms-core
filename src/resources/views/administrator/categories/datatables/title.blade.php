<a href="{{ route('administrator.categories.edit', $category->id) }}"
   data-toggle="tooltip"
   data-title="{{trans('cms::button.edit')}}"
>
    {{ $category->present()->name }}
</a>
<small>
    (Alias:
    <a href="{{url($category->present()->alias)}}"
       target="_blank"
       data-toggle="tooltip"
       title="{{trans('cms::button.preview')}}"
       class="text-orange"
    >
        {{ $category->present()->alias }}
    </a>
    )
</small>
