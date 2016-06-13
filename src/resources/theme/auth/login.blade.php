<!DOCTYPE html>
<html>
<head>
    @section('title', config('site.name') . ' | Login to Administrator Panel')
    @section('keywords', config('site.keywords'))
    @section('author', config('site.author'))
    @section('description', config('site.description'))
    @include('system.headers.header')
    @include('system.headers.libraries')
    @include('system.headers.plugins')
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link href="{{ asset('themes/admin-lte/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css"/>
    @stack('styles')
</head>
<body class="hold-transition login-page">
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Login to Administrator Panel</h3>
                            <p>Enter your email and password to log on:</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form method="post" class="login-form" role="form">
                            {!! csrf_field() !!}
                            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </form>
                        <a href="{{ url('/password/reset') }}" class="pull-right">I forgot my password</a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('system.scripts.libraries')
@include('system.scripts.plugins')
<script src="{{ asset('themes/admin-lte/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('js/jquery.backstretch.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });

        $.backstretch([
            "/img/backgrounds/2.jpg",
            "/img/backgrounds/3.jpg",
            "/img/backgrounds/1.jpg"
        ], {duration: 3000, fade: 750});
    });
</script>
@stack('scripts')
@include('system.sweetalert')
</body>
</html>
