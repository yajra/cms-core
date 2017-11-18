<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ hasError('first_name') }}">
            <label class="form-label-style block" for="first_name">
                {{trans('cms::user.form.field.first_name')}}
                @tooltip('cms::user.form.tooltip.first_name')
            </label>
            {!! form()->input('text', 'first_name', null, ['id'=>'first_name','class'=>'form-control input-sm','placeholder'=>trans('cms::user.form.placeholder.first_name')]) !!}
            @error('first_name')
        </div>
        <div class="form-group {{ hasError('last_name') }}">
            <label class="form-label-style block" for="last_name">
                {{trans('cms::user.form.field.last_name')}}
                @tooltip('cms::user.form.tooltip.last_name')
            </label>
            {!! form()->input('text', 'last_name', null, ['id'=>'last_name','class'=>'form-control input-sm','placeholder'=>trans('cms::user.form.placeholder.last_name')]) !!}
            @error('last_name')
        </div>
        <div class="form-group {{ hasError('email') }}">
            <label class="form-label-style block" for="email">
                {{trans('cms::user.form.field.email')}}
                @tooltip('cms::user.form.tooltip.email')
            </label>
            {!! form()->input('text', 'email', null, ['id'=>'email','class'=>'form-control input-sm','placeholder'=>trans('cms::user.form.placeholder.email')]) !!}
            @error('email')
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ hasError('password') }}">
            <label class="form-label-style block" for="password">
                {{trans('cms::user.form.field.password')}}
                @tooltip('cms::user.form.tooltip.password')
            </label>
            {!! form()->password('password', ['id'=>'password','class'=>'form-control input-sm','placeholder'=>trans('cms::user.form.placeholder.password')]) !!}
            @error('password')
        </div>
        <div class="form-group {{ hasError('password_confirmation') }}">
            <label class="form-label-style block" for="password_confirmation">
                {{trans('cms::user.form.field.password_confirmation')}}
                @tooltip('cms::user.form.tooltip.password_confirmation')
            </label>
            {!! form()->password('password_confirmation', ['id'=>'password_confirmation','class'=>'form-control input-sm','placeholder'=>trans('cms::user.form.placeholder.password_confirmation')]) !!}
            @error('password_confirmation')
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{ hasError('is_activated') }} {{ hasError('is_activated') }}">
                    <label class="form-label-style">
                        {{trans('cms::user.form.field.is_activated')}}
                        @tooltip('cms::user.form.tooltip.is_activated')
                    </label>
                    <br>
                    {!! form()->checkbox('is_activated', $value = 1, $checked = null, ['id'=>'is_activated','class'=>'bootstrap-checkbox']) !!}
                    @error('is_activated')
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{ hasError('is_blocked') }}">
                    <label class="form-label-style">
                        {{trans('cms::user.form.field.is_blocked')}}
                        @tooltip('cms::user.form.tooltip.is_blocked')
                    </label>
                    <br>
                    {!! form()->checkbox('is_blocked', $value = 1, $checked = null, ['id'=>'is_blocked','class'=>'bootstrap-checkbox']) !!}
                    @error('is_blocked')
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{ hasError('is_admin') }}">
                    <label class="form-label-style">
                        {{trans('cms::user.form.field.is_admin')}}
                        @tooltip('cms::user.form.tooltip.is_admin')
                    </label>
                    <br>
                    {!! form()->checkbox('is_admin', $value = 1, $checked = null, ['id'=>'is_admin','class'=>'bootstrap-checkbox']) !!}
                    @error('is_admin')
                </div>
            </div>
        </div>
    </div>
</div>
