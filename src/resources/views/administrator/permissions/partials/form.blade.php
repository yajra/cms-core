<div class="box box-primary">
    <div class="box-header with-border">
        <h3 style="color: #505b69;" class="box-title">
            {{trans('cms::permission.form.title')}}
            <small>
                {{trans('cms::permission.form.help')}}
            </small>
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                    <label class="form-label-style" for="name">
                        {{trans('cms::permission.form.field.name')}}
                    </label>
                    {!! form()->input('text', 'name', null, ['id'=>'name','class'=>'form-control','placeholder'=>trans('cms::permission.form.field.name_placeholder')]) !!}
                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {!! $errors->has('slug') ? 'has-error' : '' !!}">
                    <label class="form-label-style" for="slug">
                        {{trans('cms::permission.form.field.slug')}}
                    </label>
                    {!! form()->input('text', 'slug', null, ['id'=>'slug','class'=>'form-control','placeholder'=>trans('cms::permission.form.field.slug_placeholder')]) !!}
                    {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {!! $errors->has('resource') ? 'has-error' : '' !!}">
                    <label class="form-label-style" for="resource">
                        {{trans('cms::permission.form.field.resource')}}
                    </label>
                    {!! form()->input('text', 'resource', null, ['id'=>'resource','class'=>'form-control','placeholder'=>trans('cms::permission.form.field.resource_placeholder')]) !!}
                    {!! $errors->first('resource', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-6">
                @include('administrator.permissions.partials.roles-form')
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="form-actions">
            <a href="{{ route('administrator.permissions.index') }}" class="btn btn-warning text-bold">
                {{trans('cms::button.back')}}
            </a>
            <button type="reset" class="btn btn-default text-bold">
                {{trans('cms::button.reset')}}
            </button>
            <button type="submit" class="btn btn-primary text-bold">
                <i class="fa fa-check"></i> {{trans('cms::button.save')}}
            </button>
        </div>
    </div>
</div>
