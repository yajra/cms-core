@if($widget->body)
    {!! $widget->body !!}
@endif
<form class="form-vertical" role="form" method="POST" action="{{ url('/login') }}">
    {!! csrf_field() !!}

    <div class="form-group {{ hasError('email') }}">
        <label class="control-label" for="email">Email</label>

        <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email">
        @error('email')
    </div>

    <div class="form-group {{ hasError('password') }}">
        <label class="control-label" for="password">Password</label>

        <input type="password" id="password" class="form-control" name="password"/>

        @error('password')
    </div>

    <div class="form-group">
        <div class="control-label">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="control-label">
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fa fa-btn fa-sign-in"></i>Login
            </button>

            <a class="btn btn-link pull-right" href="{{ url('/password/reset') }}">
                Forgot Your Password?
            </a>
        </div>
    </div>
</form>
