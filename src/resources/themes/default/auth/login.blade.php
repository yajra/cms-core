<!DOCTYPE html>
<html>
<head>
    @include('system.meta')
    {{ Asset::css() }}
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
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
                            <h3>{{trans('cms::auth.title')}}</h3>
                            <p>{{trans('cms::auth.form.title')}}</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form method="post" class="login-form" role="form">
                            {!! csrf_field() !!}
                            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-control"
                                       placeholder="{{trans('cms::auth.placeholder.email')}}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="{{trans('cms::auth.placeholder.password')}}">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label>
                                        <input type="checkbox" name="remember"> {{trans('cms::auth.form.remember')}}
                                    </label>
                                </div>
                            </div>
                            <button type="submit"
                                    class="btn btn-primary btn-block btn-flat">
                                {{trans('cms::auth.form.sign-in')}}
                            </button>
                        </form>
                        <a href="{{ url('/password/reset') }}" class="pull-right">{{trans('cms::auth.form.forgot')}}</a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{ Asset::js() }}
<script src="{{ asset('js/jquery.backstretch.min.js') }}"></script>
<script>
    $(function () {
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
