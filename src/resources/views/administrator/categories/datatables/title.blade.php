<a href="{{url($category->present()->alias)}}"
   target="_blank"
   data-toggle="tooltip"
   title="Visit Page">
    <i class="fa fa-globe"></i>
</a>

<a href="{{ route('administrator.categories.edit', $category->id) }}">
    {{ $category->present()->name }}
</a>
<small>
    (Slug: {{ $category->present()->alias }})
</small>


