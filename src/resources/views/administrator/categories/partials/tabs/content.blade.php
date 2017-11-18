<div class="row">
    <div class="col-md-8">
        <div class="form-group {{ hasError('description') }}">
            {!! form()->textarea('description', null, ['id'=>'description','class'=>'form-control','rows'=>3,'cols'=>10]) !!}
            @error('description')
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ hasError('parent_id') }}">
            <label class="form-label-style" for="parent_id">
                {{trans('cms::categories.form.fields.parent')}}
            </label>
            {!! form()->select('parent_id', $category->getParentsList(), null,['class' => 'select2 form-control']) !!}
            @error('params')
        </div>

        <div class="form-group {{ hasError('published') }}">
            <label class="form-label-style" for="published">
                {{trans('cms::categories.form.fields.published')}}
                @tooltip('cms::categories.tooltip.published')
            </label>
            <br>
            {!! form()->checkbox('published', $value = 1, $checked = null, ['name' =>'published','id'=>'published','class'=>'form-control bootstrap-checkbox']) !!}
            @error('published')
        </div>

        <div class="form-group {{ hasError('authenticated') }}">
            <label class="form-label-style" for="authenticated">
                {{trans('cms::categories.form.fields.auth')}}
                @tooltip('cms::categories.tooltip.auth')
            </label>
            <br>
            {!! form()->checkbox('authenticated', $value = 1, $checked = null, ['name' =>'authenticated','id'=>'authenticated','class'=>'form-control bootstrap-checkbox']) !!}
            @error('authenticated')
        </div>
    </div>
</div>
