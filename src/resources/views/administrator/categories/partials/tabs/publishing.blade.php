<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="author_alias">
                {{trans('cms::categories.form.fields.author_alias')}}
                @tooltip('cms::categories.tooltip.author_alias')
            </label>
            {!! form()->input('text','parameters[author_alias]', $category->param('author_alias'), ['id'=>'author_alias','class'=>'form-control','placeholder'=>trans('cms::categories.form.fields.author_alias_placeholder')]) !!}
        </div>
        <div class="form-group">
            <label class="form-label-style block" for="meta_description">
                {{trans('cms::categories.form.fields.meta_description')}}
                @tooltip('cms::categories.tooltip.meta_description')
            </label>
            {!! form()->textarea('parameters[meta_description]', $category->param('meta_description'), ['placeholder' => trans('cms::categories.form.fields.meta_description_placeholder'), 'class' => 'form-control', 'rows' => 3, 'cols' => 3]) !!}
        </div>
        <div class="form-group">
            <label class="form-label-style block" for="meta_keywords">
                {{trans('cms::categories.form.fields.meta_keywords')}}
                @tooltip('cms::categories.tooltip.meta_keywords')
            </label>
            {!! form()->textarea('parameters[meta_keywords]', $category->param('meta_keywords'), ['placeholder' => trans('cms::categories.form.fields.meta_keywords_placeholder'), 'class' => 'form-control', 'rows' => 3, 'cols' => 3]) !!}
        </div>
    </div>
</div>
