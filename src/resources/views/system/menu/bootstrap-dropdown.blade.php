<li class="menu-item dropdown dropdown-submenu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{$menu->title}}</a>
    <ul class="dropdown-menu">
        @foreach($menu->children() as $item)
            @if($item->hasChildren())
                @foreach($item->children() as $child)
                @include('system.menu.bootstrap-dropdown', ['menu' => $child])
                @endforeach
            @else
                <li>
                    <a href="{{$item->url()}}" {!! $item->attributes() !!}>
                        {{$item->title}}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</li>