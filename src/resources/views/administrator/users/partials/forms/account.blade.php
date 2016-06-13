<div class="row">
    <div class="col-md-6">
        <div class="form-group {!! $errors->has('first_name') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="first_name">First Name</label>
            {!! form()->input('text', 'first_name', null, ['id'=>'first_name','class'=>'form-control','placeholder'=>'Enter first name here']) !!}
            {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {!! $errors->has('last_name') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="last_name">Last Name</label>
            {!! form()->input('text', 'last_name', null, ['id'=>'last_name','class'=>'form-control','placeholder'=>'Enter last name here']) !!}
            {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="email">Email</label>
            {!! form()->input('text', 'email', null, ['id'=>'email','class'=>'form-control','placeholder'=>'Enter email here']) !!}
            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" value="" placeholder="Enter password here" autocomplete="off"/>
            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {!! $errors->has('password_confirmation') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="password">Confirm Password</label>
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="" placeholder="Confirm password here" autocomplete="off"/>
            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('confirmed') || $errors->has('confirmed') ? 'has-error' : '' !!}">
            <label class="form-label-style" >Is Activated</label>
            <br>
            {!! form()->checkbox('confirmed', $value = 1, $checked = null, ['id'=>'confirmed','class'=>'bootstrap-checkbox']) !!}
            {!! $errors->first('confirmed', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('blocked') ? 'has-error' : '' !!}">
            <label class="form-label-style" >Is Blocked</label>
            <br>
            {!! form()->checkbox('blocked', $value = 1, $checked = null, ['id'=>'blocked','class'=>'bootstrap-checkbox']) !!}
            {!! $errors->first('blocked', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('administrator') ? 'has-error' : '' !!}">
            <label class="form-label-style" >Is Administrator</label>
            <br>
            {!! form()->checkbox('administrator', $value = 1, $checked = null, ['id'=>'administrator','class'=>'bootstrap-checkbox']) !!}
            {!! $errors->first('administrator', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>

<hr>
<div class="row margin-top-30">
    <div class="col-md-6">
        <a href="{{ route('administrator.users.index') }}" class="btn btn-warning text-bold">Cancel</a>
        <button type="submit" class="btn btn-primary text-bold">
            Save changes
        </button>
    </div>
</div>
