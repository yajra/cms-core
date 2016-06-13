@foreach($menu->roots() as $item)
    <li
            @if($item->hasChildren())
            class ="dropdown @foreach($item->children() as $child) @if($child->active)active @endif @endforeach"
            @elseif($item->active)
            class="active"
            @endif
    >
        @if($item->link)
            <a @if($item->hasChildren()) class="treeview" @endif href="{!! $item->url() !!}">
                @if($item->icon)
                    <i class="fa fa-{{$item->icon}}"></i>
                @endif
                <span>{!! $item->title !!}</span>
                @if($item->badge)
                    <small class="pull-right label {!! $item->color ?: 'bg-green' !!}">{!! $item->badge !!}</small>
                @endif
                @if($item->hasChildren())
                    <i class="fa fa-angle-left pull-right"></i>
                @endif
            </a>
            @if($item->append)
                <a href="{{$item->append}}" class="pull-right append"><i class="fa fa-plus"></i></a>
            @endif
        @else
            @if($item->icon)
                <i class="fa fa-{{$item->icon}}"></i>
            @endif
            <span>{!!$item->title!!}</span>
            @if($item->badge)
                <small class="pull-right label {!! $item->color ?: 'bg-green' !!}">{!! $item->badge !!}</small>
            @endif
        @endif
        @if($item->hasChildren())
            <ul class="treeview-menu">
                @foreach($item->children() as $child)
                    <li @if($child->active)class="active"@endif>
                        <a href="{!! $child->url() !!}">
                            @if($child->icon)
                                <i class="fa fa-{{$child->icon}}"></i>
                            @endif
                            <span>{!! $child->title !!}</span>
                            @if($child->badge)
                                <small class="pull-right label {!! $child->color ?: 'bg-green' !!}">{!! $child->badge !!}</small>
                            @endif
                        </a>
                        @if($child->append)
                            <a href="{{$child->append}}" class="pull-right append"><i class="fa fa-plus"></i></a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </li>
    @if($item->divider)
        <li {!!html()->attributes($item->divider)!!}></li>
    @endif
@endforeach