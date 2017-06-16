<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{trans('cms::user.form.attach-roles')}}</h3>
    </div>
    <div class="panel-body">
        <div class="row {!! $errors->has('roles') ? 'has-error' : '' !!}">
            <div class="col-md-12">
                {{ form()->select('roles[]', $roles, $selectedRoles , ['id'=>'role-multi-select','class' => 'form-control', 'multiple', 'size' => 5]) }}
                {!! $errors->first('roles', '<span class="help-block font-red-pink">:message</span>')  !!}
            </div>
        </div>
        <br>
        <p class="quoted">
            <strong>{{trans('cms::user.form.note')}}</strong> <br>{{trans('cms::user.form.attach-roles-note')}}
        </p>
    </div>
</div>
