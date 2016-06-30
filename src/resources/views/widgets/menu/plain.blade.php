@if($widget->show_title)
<h3 @if($widget->param('header_class'))class="{{$widget->param('header_class')}}"@endif>{{$widget->title}}</h3>
@endif
<ul class="{{$widget->param('menu_class', 'nav navbar-nav')}}">
    @include('system.menu.bootstrap', ['menu' => $$menu])
</ul>
