<a href="{{url($menu->present()->url)}}"
   target="_blank"
   data-toggle="tooltip"
   title="Visit Page">
    <i class="fa fa-globe"></i>
</a>

<a href="{{ route('administrator.navigation.menu.edit', [$menu->navigation_id, $menu->id]) }}">
    {{ $menu->present()->name }}
</a>
<small>(URL: {{ $menu->present()->url }})</small>
<br>
<small><span class="label label-info">MENU TYPE:</span> <span class="label label-success">{{ $menu->extension->name }}</span></small>
