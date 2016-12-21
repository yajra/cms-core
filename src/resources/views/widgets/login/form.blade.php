@if($widget->body)
    {!! $widget->body !!}
@endif
<form class="form-vertical" role="form" method="POST" action="{{ url('/login') }}">
    {!! csrf_field() !!}

    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="control-label" for="email">Email</label>

        <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email">
        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="control-label" for="password">Password</label>

        <input type="password" id="password" class="form-control" name="password"/>

        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
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
