<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-user"></i>&nbsp;
                    {{trans('cms::profile.form.box-title')}}
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div role="row">
                    <div class="col-xs-12">
                        <label for="first_name">{{trans('cms::profile.form.field.first-name')}}</label>
                        {{ form()->input('text', 'first_name', null, ['class' => 'form-control', 'required']) }}
                        {!! $errors->first('first_name', '<small class="help-inline text-danger">:message</small>') !!}
                    </div>

                    <div class="col-xs-12">
                        <label for="last_name">{{trans('cms::profile.form.field.last-name')}}</label>
                        {{ form()->input('text', 'last_name', null, ['class' => 'form-control', 'required']) }}
                        {!! $errors->first('last_name', '<small class="help-inline text-danger">:message</small>') !!}
                    </div>
                    <div class="col-xs-12">
                        <label for="email">{{trans('cms::profile.form.field.email')}}</label>
                        {{ form()->input('email', 'email', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Please enter e-mail',
                            'required'
                        ]) }}
                        {!! $errors->first('email', '<small class="help-inline text-danger">:message</small>') !!}
                    </div>

                    <div class="col-xs-12">
                        <hr>
                        <h4 class="box-title"><i class="fa fa-key"></i>
                            {{trans('cms::profile.form.sep-title.change-pass')}}
                        </h4>
                        <hr>
                        <label>{{trans('cms::profile.form.field.pass-new')}}</label>
                        {{ form()->input('password', 'password', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Enter new password'
                        ]) }}
                        {!! $errors->first('password', '<small class="help-inline text-danger">:message</small>') !!}
                    </div>
                    <div class="col-xs-12">
                        <label>{{trans('cms::profile.form.field.pass-conf')}}</label>
                        {{ form()->input('password', 'password_confirmation', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Confirm new password '
                        ]) }}
                    </div>
                    <div class="col-xs-12">
                        <hr>
                        <h4 class="box-title"><i class="fa fa-image"></i> {{trans('cms::profile.form.sep-title.upload-av')}}</h4>
                        <hr>
                        {{ form()->file('avatar') }}

                        <p class="help-block">{{trans('cms::profile.form.require.avatar')}}</p>
                        {!! $errors->first('avatar', '<small class="help-inline text-danger">:message</small>') !!}
                    </div>
                </div>
            </div>
                <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">{{trans('cms::profile.form.button.save')}}</button>
            </div>
        </div>
    </div>
</div>