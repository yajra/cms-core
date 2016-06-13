<div class="row">
    <div class="col-md-8 {!! $errors->has('body') ? 'has-error' : '' !!}">
        <div class="form-group {!! $errors->has('blade_template') ? 'has-error' : '' !!}">
            <label class="form-label-style block" for="blade_template">
                {{trans('article.field.blade_template')}}
                @tooltip('article.tooltip.blade_template')
            </label>
            {!! form()->input('text', 'blade_template', null, ['id'=>'blade_template','class'=>'form-control input-sm','placeholder'=>trans('article.field.blade_template_placeholder')]) !!}
            {!! $errors->first('blade_template', '<span class="help-block">:message</span>') !!}
        </div>

        {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
        {!! form()->textarea('body', null, ['id'=>'body','class'=>'form-control','rows'=>10,'cols'=>30]) !!}
    </div>

    <div class="col-md-4">
        <div class="form-group {!! $errors->has('category_id') ? 'has-error' : '' !!}">
            <label for="category_id" class="form-label-style block">
                {{trans('article.field.category')}}
                @tooltip('article.tooltip.category')
            </label>
            {!! form()->select('category_id', $categories, null, ['class' => 'form-control']) !!}
            {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group {!! $errors->has('order') ? 'has-error' : '' !!}">
            <label class="form-label-style block" for="order">
                {{trans('article.field.order')}}
                @tooltip('article.tooltip.order')
            </label>
            {!! form()->select('order', array_combine(range(1, 100), range(1, 100)) , null , ['class' => 'form-control']) !!}
            {!! $errors->first('order', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group {!! $errors->has('authenticated') ? 'has-error' : '' !!}">
                    <label class="form-label-style" for="authenticated">
                        {{trans('article.field.authenticated')}}
                        @tooltip('article.tooltip.authenticated')
                    </label>
                    <br>
                    {!! form()->checkbox('authenticated', $value = 1, $checked = null, ['name' =>'authenticated','id'=>'authenticated','class'=>'form-control bootstrap-checkbox']) !!}
                    {!! $errors->first('authenticated', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {!! $errors->has('published') ? 'has-error' : '' !!}">
                    <label class="form-label-style" for="published">
                        {{trans('article.field.published')}}
                        @tooltip('article.tooltip.published')
                    </label>
                    <br>
                    {!! form()->checkbox('published', $value = 1, $checked = null, ['name' =>'published','id'=>'published','class'=>'form-control bootstrap-checkbox']) !!}
                    {!! $errors->first('published', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {!! $errors->has('featured') ? 'has-error' : '' !!}">
                    <label class="form-label-style" for="featured">
                        {{trans('article.field.featured')}}
                        @tooltip('article.tooltip.featured')
                    </label>
                    <br>
                    {!! form()->checkbox('featured', $value = 1, $checked = null, ['name' =>'featured','id'=>'featured','class'=>'form-control bootstrap-checkbox']) !!}
                    {!! $errors->first('featured', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>
