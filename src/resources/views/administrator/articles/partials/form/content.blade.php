<div class="row">
    <div class="col-md-8 {{ hasError('body') }}">
        <div class="form-group {{ hasError('blade_template') }}">
            <label class="form-label-style block" for="blade_template">
                {{trans('cms::article.form.field.blade_template')}}
                @tooltip('cms::article.form.tooltip.blade_template')
            </label>
            {!! form()->input('text', 'blade_template', null, ['id'=>'blade_template','class'=>'form-control input-sm','placeholder'=>trans('cms::article.form.field.blade_template_placeholder')]) !!}
            @error('blade_template')
        </div>

        @error('body')
        {!! form()->textarea('body', null, ['id'=>'body','class'=>'form-control','rows'=>10,'cols'=>30]) !!}
    </div>

    <div class="col-md-4">
        <div class="form-group {{ hasError('theme') }}">
            <label for="theme" class="form-label-style block">
                {{trans('cms::article.form.field.theme')}}
                @tooltip('cms::article.form.tooltip.theme')
            </label>
            {!! form()->themes('theme', null, ['class' => 'form-control']) !!}
            @error('theme')
        </div>

        <div class="form-group {{ hasError('category_id') }}">
            <label for="category_id" class="form-label-style block">
                {{trans('cms::article.form.field.category')}}
                @tooltip('cms::article.form.tooltip.category')
            </label>
            {!! form()->categories('category_id', null, ['class' => 'form-control']) !!}
            @error('category_id')
        </div>

        <div class="form-group {{ hasError('order') }}">
            <label class="form-label-style block" for="order">
                {{trans('cms::article.form.field.order')}}
                @tooltip('cms::article.form.tooltip.order')
            </label>
            {!! form()->text('order', null , ['class' => 'form-control']) !!}
            @error('order')
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{ hasError('authenticated') }}">
                    <label class="form-label-style" for="authenticated">
                        {{trans('cms::article.form.field.authenticated')}}
                        @tooltip('cms::article.form.tooltip.authenticated')
                    </label>
                    <br>
                    {!! form()->checkbox('authenticated', $value = 1, $checked = null, ['name' =>'authenticated','id'=>'authenticated','class'=>'form-control bootstrap-checkbox']) !!}
                    @error('authenticated')
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{ hasError('published') }}">
                    <label class="form-label-style" for="published">
                        {{trans('cms::article.form.field.published')}}
                        @tooltip('cms::article.form.tooltip.published')
                    </label>
                    <br>
                    {!! form()->checkbox('published', $value = 1, $checked = null, ['name' =>'published','id'=>'published','class'=>'form-control bootstrap-checkbox']) !!}
                    @error('published')
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{ hasError('featured') }}">
                    <label class="form-label-style" for="featured">
                        {{trans('cms::article.form.field.featured')}}
                        @tooltip('cms::article.form.tooltip.featured')
                    </label>
                    <br>
                    {!! form()->checkbox('featured', $value = 1, $checked = null, ['name' =>'featured','id'=>'featured','class'=>'form-control bootstrap-checkbox']) !!}
                    @error('featured')
                </div>
            </div>
        </div>

        <div class="form-group {{ hasError('tags') }}">
            <label class="form-label-style block" for="tags">
                {{trans('cms::article.form.field.tags')}}
                @tooltip('cms::article.form.tooltip.tags')
            </label>
            {!! form()->text('tags', $selectedTags ?? null, ['class' => 'form-control', 'id' => 'tags']) !!}
            @error('tags')
        </div>

        <div class="form-group {{ hasError('is_page') }}">
            <label class="form-label-style" for="featured">
                {{trans('cms::article.form.field.is_page')}}
                @tooltip('cms::article.form.tooltip.is_page')
            </label>
            <br>
            {!! form()->checkbox('is_page', $value = 1, $checked = null, ['name' =>'is_page','id'=>'is_page','class'=>'form-control bootstrap-checkbox']) !!}
            @error('is_page')
        </div>
    </div>
</div>
