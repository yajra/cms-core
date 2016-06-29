<div class="{{$widget->param('class_suffix')}}">
    @if($widget->show_title)
        <h3 class="{{$widget->param('header_class')}}">{{$widget->title}}</h3>
    @endif
    <ul class="{{$widget->param('menu_class', 'nav navbar-nav')}}">
        @include('system.menu.bootstrap', ['menu' => $$menu])
    </ul>
</div>
