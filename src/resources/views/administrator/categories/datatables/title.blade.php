<a href="{{ route('administrator.categories.edit', $category->id) }}">
    {{ $category->present()->indentedTitle() }}
</a>
<small>(Alias: {{ $category->alias }})</small>