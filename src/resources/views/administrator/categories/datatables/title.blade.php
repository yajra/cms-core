<a href="{{url($category->present()->alias)}}"
   target="_blank"
   data-toggle="tooltip"
   title="Visit Page"
   class="btn btn-primary btn-xs"
>
    <i class="fa fa-link"></i>
</a>
<a href="{{ route('administrator.categories.edit', $category->id) }}">
    {{ $category->present()->name }}
</a>
<small>
    (Slug: {{ $category->present()->alias }})
</small>


