<!DOCTYPE html>
<html>
<head>
    @include('system.headers.header')
    @include('system.headers.libraries')
    @include('system.headers.plugins')
    @stack('styles')
    <style>
        h1 {
            font-size: 120px;
            text-align: center;
        }
    </style>
</head>
<body class="@yield('body')">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
