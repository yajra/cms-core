<div class="box box-primary">
    <div class="box-header with-border">
        <h3 style="color: #505b69;" class="box-title">
            {{trans('cms::role.form.title')}}
            <small>
                {{trans('cms::role.form.help')}}
            </small>
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6 form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                <label class="form-label-style" for="name">
                    {{trans('cms::role.form.field.name')}}
                </label>
                {!! form()->input('text', 'name', null, ['id'=>'name','class'=>'form-control','placeholder'=>trans('cms::role.form.field.name_placeholder')]) !!}
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="col-md-6 form-group {!! $errors->has('slug') ? 'has-error' : '' !!}">
                <label class="form-label-style" for="slug">
                    {{trans('cms::role.form.field.slug')}}
                </label>
                {!! form()->input('text', 'slug', null, ['id'=>'slug','class'=>'form-control','placeholder'=>trans('cms::role.form.field.slug_placeholder')]) !!}
                {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('administrator.partials.permissions-multiselect', ['model' => $role])
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="form-actions">
            <a href="{{ route('administrator.roles.index') }}" class="btn btn-warning text-bold">Back</a>
            <button type="reset" class="btn btn-default text-bold">Reset</button>
            <button type="submit" class="btn btn-primary text-bold">Save Changes</button>
        </div>
    </div>
</div>
