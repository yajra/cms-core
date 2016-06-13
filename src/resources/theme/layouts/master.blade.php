<!DOCTYPE html>
<html>
<head>
    @include('system.headers.header')
    @include('system.headers.libraries')
    @include('system.headers.plugins')
    <link href="{{ asset('themes/admin-lte/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/admin-lte/css/skins/skin-'.config('site.admin_theme').'.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet" type="text/css" />
    @stack('styles')
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

@include('system.scripts.libraries')
@include('system.scripts.plugins')
@stack('js-plugins')
<script src="{{ asset('themes/admin-lte/js/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dt-filter-placeholder.js') }}" type="text/javascript"></script>
@stack('scripts')
@include('system.sweetalert')
</body>
</html>
