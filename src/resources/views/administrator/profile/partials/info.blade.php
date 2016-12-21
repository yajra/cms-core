<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                {{ html()->image(
                    current_user()->present()->avatar ,
                    'alt',
                    array( 'class' => 'profile-user-img img-responsive img-circle', 'style' => "" ))
                }}
                <h3 class="profile-username text-center">
                    {{current_user()->present()->first_name}} {{current_user()->present()->last_name}}
                </h3>
                <p class="text-muted text-center">{{trans('cms::profile.position')}}</p>
                <a href="{{route('administrator.profile.remove-avatar')}}" class="btn btn-warning btn-block"><b>{{trans('cms::profile.form.button.remove-avatar')}}</b></a>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#basic-info" data-toggle="tab"><i class="fa fa-info"></i>
                        {{trans('cms::profile.form.box-title')}}</a>
                </li>
                <li><a href="#change-pass" data-toggle="tab"><i class="fa fa-lock"></i>
                        {{trans('cms::profile.form.sep-title.change-pass')}}</a>
                </li>
                <li><a href="#change-avatar" data-toggle="tab"><i class="fa fa-image"></i>
                        {{trans('cms::profile.form.sep-title.upload-av')}}</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="basic-info">
                    <div class="form-group">
                        <label class="form-label-style"
                               for="first_name">{{trans('cms::profile.form.field.first-name')}}
                            @tooltip('')
                        </label>
                        {{ form()->input('text', 'first_name', null, ['class' => 'form-control', 'required']) }}
                        {!! $errors->first('first_name', '<small class="help-inline text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group">
                        <label class="form-label-style"
                               for="last_name">{{trans('cms::profile.form.field.last-name')}}
                            @tooltip('')
                        </label>
                        {{ form()->input('text', 'last_name', null, ['class' => 'form-control', 'required']) }}
                        {!! $errors->first('last_name', '<small class="help-inline text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group">
                        <label class="form-label-style" for="email">{{trans('cms::profile.form.field.email')}}
                            @tooltip('')
                        </label>
                        {{ form()->input('email', 'email', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Please enter e-mail',
                            'required'
                        ]) }}
                        {!! $errors->first('email', '<small class="help-inline text-danger">:message</small>') !!}
                    </div>
                </div>
                <div class="tab-pane" id="change-pass">
                    <div class="form-group">
                        <label class="form-label-style">{{trans('cms::profile.form.field.pass-new')}}
                            @tooltip('')
                        </label>
                        {{ form()->input('password', 'password', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Enter new password'
                        ]) }}
                        {!! $errors->first('password', '<small class="help-inline text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group">
                        <label class="form-label-style">{{trans('cms::profile.form.field.pass-conf')}}
                            @tooltip('')
                        </label>
                        {{ form()->input('password', 'password_confirmation', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Confirm new password '
                        ]) }}
                    </div>
                </div>
                <div class="tab-pane" id="change-avatar">
                    <div class="form-group">
                        {{ form()->file('avatar') }}

                        <p class="help-block">{{trans('cms::profile.form.require.avatar')}}</p>
                        {!! $errors->first('avatar', '<small class="help-inline text-danger">:message</small>') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit"
                                class="btn btn-primary">{{trans('cms::profile.form.button.save')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
