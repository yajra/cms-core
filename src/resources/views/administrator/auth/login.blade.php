<!DOCTYPE html>
<html>
<head>
    @section('title', 'Administrator Login')
    @include('system.meta')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link href="{{mix('css/plugins.css')}}" rel="stylesheet">
    <link href="{{mix('css/admin.css')}}" rel="stylesheet">
    @stack('styles')
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 300;
            color: #888;
            line-height: 30px;
            text-align: center;
        }

        strong { font-weight: 500; }

        a, a:hover, a:focus {
            color: #de995e;
            text-decoration: none;
            -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
        }

        h1, h2 {
            margin-top: 10px;
            font-size: 38px;
            font-weight: 100;
            color: #555;
            line-height: 50px;
        }

        h3 {
            font-size: 22px;
            font-weight: 300;
            color: #555;
            line-height: 30px;
        }

        img { max-width: 100%; }

        ::-moz-selection { background: #de995e; color: #fff; text-shadow: none; }
        ::selection { background: #de995e; color: #fff; text-shadow: none; }


        .btn-link-1 {
            display: inline-block;
            height: 50px;
            margin: 5px;
            padding: 16px 20px 0 20px;
            background: #de995e;
            font-size: 16px;
            font-weight: 300;
            line-height: 16px;
            color: #fff;
            -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
        }
        .btn-link-1:hover, .btn-link-1:focus, .btn-link-1:active { outline: 0; opacity: 0.6; color: #fff; }

        .btn-link-1.btn-link-1-facebook { background: #4862a3; }
        .btn-link-1.btn-link-1-twitter { background: #55acee; }
        .btn-link-1.btn-link-1-google-plus { background: #dd4b39; }

        .btn-link-1 i {
            padding-right: 5px;
            vertical-align: middle;
            font-size: 20px;
            line-height: 20px;
        }

        .btn-link-2 {
            display: inline-block;
            height: 50px;
            margin: 5px;
            padding: 15px 20px 0 20px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid #fff;
            font-size: 16px;
            font-weight: 300;
            line-height: 16px;
            color: #fff;
            -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;
        }
        .btn-link-2:hover, .btn-link-2:focus,
        .btn-link-2:active, .btn-link-2:active:focus { outline: 0; opacity: 0.6; background: rgba(0, 0, 0, 0.3); color: #fff; }


        /***** Top content *****/

        .inner-bg {
            padding: 100px 0 170px 0;
        }

        .top-content .text {
            color: #fff;
        }

        .top-content .text h1 { color: #fff; }

        .top-content .description {
            margin: 20px 0 10px 0;
        }

        .top-content .description p { opacity: 0.8; }

        .top-content .description a {
            color: #fff;
        }
        .top-content .description a:hover,
        .top-content .description a:focus { border-bottom: 1px dotted #fff; }

        .form-box {
            margin-top: 35px;
        }

        .form-top {
            overflow: hidden;
            padding: 0 25px 15px 25px;
            background: #fff;
            -moz-border-radius: 4px 4px 0 0; -webkit-border-radius: 4px 4px 0 0; border-radius: 4px 4px 0 0;
            text-align: left;
        }

        .form-top-left {
            float: left;
            width: 75%;
            padding-top: 25px;
        }

        .form-top-left h3 { margin-top: 0; }

        .form-top-right {
            float: left;
            width: 25%;
            padding-top: 5px;
            font-size: 66px;
            color: #ddd;
            line-height: 100px;
            text-align: right;
        }

        .form-bottom {
            padding: 25px 25px 30px 25px;
            background: #eee;
            -moz-border-radius: 0 0 4px 4px; -webkit-border-radius: 0 0 4px 4px; border-radius: 0 0 4px 4px;
            text-align: left;
        }

        .form-bottom form textarea {
            height: 100px;
        }

        .form-bottom form button.btn {
            width: 100%;
        }

        .form-bottom form .input-error {
            border-color: #de995e;
        }

        .social-login {
            margin-top: 35px;
        }

        .social-login h3 {
            color: #fff;
        }

        .social-login-buttons {
            margin-top: 25px;
        }


        /***** Media queries *****/

        @media (min-width: 992px) and (max-width: 1199px) {}

        @media (min-width: 768px) and (max-width: 991px) {}

        @media (max-width: 767px) {

            .inner-bg { padding: 60px 0 110px 0; }

        }

        @media (max-width: 415px) {

            h1, h2 { font-size: 32px; }

        }
    </style>
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
                            <div class="form-group has-feedback {{ hasError('email') }}">
                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-control"
                                       placeholder="{{trans('cms::auth.placeholder.email')}}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @error('email')
                            </div>

                            <div class="form-group has-feedback {{ hasError('password') }}">
                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="{{trans('cms::auth.placeholder.password')}}">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @error('password')
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

<script src="{{mix('js/core.js')}}"></script>
<script src="{{mix('js/plugins.js')}}"></script>
<script src="{{mix('js/settings.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
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
