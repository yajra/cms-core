<!DOCTYPE html>
<html>
<head>
    @include('system.headers.header')
    @include('system.headers.libraries')
    @include('system.headers.plugins')
    <link href="{{ asset('themes/admin-lte/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/admin-lte/css/skins/skin-blue.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet" type="text/css" />
    @stack('styles')
    <style>
        body {
            margin-top: 20px;
            background: #ecf0f5;
        }
    </style>
</head>
<body class="skin-blue @yield('body')">
    <div class="container">
        @yield('content')
    </div>

    @include('system.scripts.libraries')
    @include('system.scripts.plugins')
    @stack('js-plugins')
    <script src="{{ asset('themes/admin-lte/js/app.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dt-filter-placeholder.js') }}" type="text/javascript"></script>
    @stack('scripts')
</body>
</html>
