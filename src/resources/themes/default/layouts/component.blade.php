<!DOCTYPE html>
<html>
<head>
    @include('system.meta')
    {{ Asset::css() }}
    @stack('styles')
    <style>
        body {
            margin-top: 20px;
            background: #ecf0f5;
        }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue @yield('body')">
    <div class="container">
        @yield('content')
    </div>

    {{ Asset::js() }}
    @stack('js-plugins')
    @stack('scripts')
    @include('system.sweetalert')
</body>
</html>
