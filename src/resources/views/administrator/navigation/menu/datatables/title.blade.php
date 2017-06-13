<a href="{{ route('administrator.navigation.menu.edit', [$menu->navigation_id, $menu->id]) }}"
   data-toggle="tooltip"
   data-title="{{trans('cms::button.edit')}}"
>
    {{ $menu->present()->name }}
</a>
<small>
    (URL:
    <a href="{{$menu->present()->url}}"
       target="_blank"
       data-toggle="tooltip"
       title="{{trans('cms::button.preview')}}"
       class="text-orange"
    >
        {{ $menu->present()->url }}
    </a>)
</small>
