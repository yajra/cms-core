@foreach($menu->roots() as $item)
    <li {!! ($item->hasChildren()) ? 'class="dropdown  menu-item"' : null !!}>
        <a href="{!! ($item->hasChildren()) ? '#' : $item->url() !!}"
                {!! $item->attributes() !!}
                {!! ($item->hasChildren()) ? 'class="dropdown-toggle" data-toggle="dropdown"' : null !!}
        >
            {{ $item->title }} {!! ($item->hasChildren()) ? '<b class="caret"></b>' : null !!}
        </a>
        @if($item->hasChildren())
            <ul class="dropdown-menu">
                @foreach($item->children() as $child)
                    @if($child->hasChildren())
                        @foreach($child->children() as $subChild)
                            @include('system.menu.bootstrap-dropdown', ['menu' => $subChild])
                        @endforeach
                    @else
                        <li>
                            <a href="{!! $child->url() !!}" {!! $child->attributes() !!}>
                                {!! $child->title !!}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </li>
    @if($item->divider)
        <li {!!html()->attributes($item->divider)!!}></li>
    @endif
@endforeach
