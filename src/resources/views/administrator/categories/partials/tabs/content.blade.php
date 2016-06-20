<div class="row">
    <div class="col-md-8">
        <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
            {!! form()->textarea('description', null, ['id'=>'description','class'=>'form-control','rows'=>3,'cols'=>10]) !!}
            {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {!! $errors->has('parent_id') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="parent_id">
                {{trans('cms::categories.form.fields.parent')}}
            </label>
            {!! form()->select('parent_id', $category->getParentsList(), null,['class' => 'select2 form-control']) !!}
            {!! $errors->first('params', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group {!! $errors->has('published') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="published">
                {{trans('cms::categories.form.fields.published')}}
                @tooltip('cms::categories.tooltip.published')
            </label>
            <br>
            {!! form()->checkbox('published', $value = 1, $checked = null, ['name' =>'published','id'=>'published','class'=>'form-control bootstrap-checkbox']) !!}
            {!! $errors->first('published', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group {!! $errors->has('authenticated') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="authenticated">
                {{trans('cms::categories.form.fields.auth')}}
                @tooltip('cms::categories.tooltip.auth')
            </label>
            <br>
            {!! form()->checkbox('authenticated', $value = 1, $checked = null, ['name' =>'authenticated','id'=>'authenticated','class'=>'form-control bootstrap-checkbox']) !!}
            {!! $errors->first('authenticated', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>
