<!DOCTYPE html>
<html>
<head>
    @include('system.meta')
    {{ Asset::css() }}
    @stack('styles')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="sidebar-mini skin-{{config('site.admin_theme')}} @yield('body')">
<div class="wrapper">
    <header class="main-header">
        @include('admin::partials.header')
    </header>

    <aside class="main-sidebar">
        @include('admin::partials.sidebar')
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @section('page-title')
                    {{ isset($title) ? $title: 'Administration' }}
                    <small>{{ isset($description) ? $description : '' }}</small>
                @show
            </h1>
            @include('admin::partials.breadcrumbs')
        </section>

        <section class="content">
            @yield('content')
        </section>
    </div>

    <footer class="main-footer">
        @include('admin::partials.footer')
    </footer>

    <!--aside class="control-sidebar control-sidebar-dark">
    {{--@include('admin::partials.control-sidebar')--}}
    </aside>

    <div class='control-sidebar-bg'></div-->
</div>

{{ Asset::js() }}
@stack('js-plugins')
@stack('scripts')
@include('system.sweetalert')
</body>
</html>
