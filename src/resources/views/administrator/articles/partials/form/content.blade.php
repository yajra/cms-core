<div class="row">
    <div class="col-md-8 {!! $errors->has('body') ? 'has-error' : '' !!}">
        <div class="form-group {!! $errors->has('blade_template') ? 'has-error' : '' !!}">
            <label class="form-label-style block" for="blade_template">
                {{trans('cms::article.form.field.blade_template')}}
                @tooltip('cms::article.form.tooltip.blade_template')
            </label>
            {!! form()->input('text', 'blade_template', null, ['id'=>'blade_template','class'=>'form-control input-sm','placeholder'=>trans('cms::article.form.field.blade_template_placeholder')]) !!}
            {!! $errors->first('blade_template', '<span class="help-block">:message</span>') !!}
        </div>

        {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
        {!! form()->textarea('body', null, ['id'=>'body','class'=>'form-control','rows'=>10,'cols'=>30]) !!}
    </div>

    <div class="col-md-4">
        <div class="form-group {!! $errors->has('category_id') ? 'has-error' : '' !!}">
            <label for="category_id" class="form-label-style block">
                {{trans('cms::article.form.field.category')}}
                @tooltip('cms::article.form.tooltip.category')
            </label>
            {!! form()->categories('category_id', null, ['class' => 'form-control']) !!}
            {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group {!! $errors->has('order') ? 'has-error' : '' !!}">
            <label class="form-label-style block" for="order">
                {{trans('cms::article.form.field.order')}}
                @tooltip('cms::article.form.tooltip.order')
            </label>
            {!! form()->text('order', null , ['class' => 'form-control']) !!}
            {!! $errors->first('order', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group {!! $errors->has('authenticated') ? 'has-error' : '' !!}">
                    <label class="form-label-style" for="authenticated">
                        {{trans('cms::article.form.field.authenticated')}}
                        @tooltip('cms::article.form.tooltip.authenticated')
                    </label>
                    <br>
                    {!! form()->checkbox('authenticated', $value = 1, $checked = null, ['name' =>'authenticated','id'=>'authenticated','class'=>'form-control bootstrap-checkbox']) !!}
                    {!! $errors->first('authenticated', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {!! $errors->has('published') ? 'has-error' : '' !!}">
                    <label class="form-label-style" for="published">
                        {{trans('cms::article.form.field.published')}}
                        @tooltip('cms::article.form.tooltip.published')
                    </label>
                    <br>
                    {!! form()->checkbox('published', $value = 1, $checked = null, ['name' =>'published','id'=>'published','class'=>'form-control bootstrap-checkbox']) !!}
                    {!! $errors->first('published', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {!! $errors->has('featured') ? 'has-error' : '' !!}">
                    <label class="form-label-style" for="featured">
                        {{trans('cms::article.form.field.featured')}}
                        @tooltip('cms::article.form.tooltip.featured')
                    </label>
                    <br>
                    {!! form()->checkbox('featured', $value = 1, $checked = null, ['name' =>'featured','id'=>'featured','class'=>'form-control bootstrap-checkbox']) !!}
                    {!! $errors->first('featured', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>

        <div class="form-group {!! $errors->has('tags') ? 'has-error' : '' !!}">
            <label class="form-label-style block" for="tags">
                {{trans('cms::article.form.field.tags')}}
                @tooltip('cms::article.form.tooltip.tags')
            </label>
            {!! form()->text('tags', $selectedTags ?? null, ['class' => 'form-control', 'id' => 'tags']) !!}
            {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group {!! $errors->has('is_page') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="featured">
                {{trans('cms::article.form.field.is_page')}}
                @tooltip('cms::article.form.tooltip.is_page')
            </label>
            <br>
            {!! form()->checkbox('is_page', $value = 1, $checked = null, ['name' =>'is_page','id'=>'is_page','class'=>'form-control bootstrap-checkbox']) !!}
            {!! $errors->first('is_page', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>
