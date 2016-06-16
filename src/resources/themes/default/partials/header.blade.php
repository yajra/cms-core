<a href="{{ url('/administrator') }}" class="logo">
    <span class="logo-mini"><i class="fa fa-chrome"></i></span>
    <span class="logo-lg">{{config('site.name')}}</span>
</a>

<nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        @include('admin::partials.menu-user')
    </div>
</nav>
