<div class="panel panel-default">
    <div class="panel-heading">{{$widget->title}}</div>
    <div class="panel-body">
        @if(auth()->check())
            @if($widget->param('show_greeting'))
                <p>Hi, {{ auth()->user()->present()->name }}</p>
            @endif
            <a href="/logout" class="btn btn-primary">Logout</a>
        @else
            @include('widgets.login.form')
        @endif
    </div>
</div>
