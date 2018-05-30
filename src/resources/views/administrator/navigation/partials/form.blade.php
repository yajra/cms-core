<div class="form-group {{ hasError('title') }}">
    <label class="form-label-style block" for="title">
        {{trans('cms::navigation.field.title')}}
        @tooltip('cms::navigation.tooltip.title')
    </label>
    {!! form()->input('text', 'title', null, ['id'=>'title','class'=>'form-control','placeholder'=>trans('cms::navigation.field.title_placeholder')]) !!}
    @error('title')
</div>

<div class="form-group {{ hasError('type') }}">
    <label class="form-label-style block" for="type">
        {{trans('cms::navigation.field.type')}}
        @tooltip('cms::navigation.tooltip.type')
    </label>
    {!! form()->input('text', 'type', null, ['id'=>'type','class'=>'form-control','placeholder'=>trans('cms::navigation.field.type_placeholder')]) !!}
    @error('type')
</div>

<div class="form-group {{ hasError('published') }}">
    <label class="form-label-style" for="published">
        {{trans('cms::navigation.field.published')}}
        @tooltip('cms::navigation.tooltip.published')
    </label>
    <br>
    {!! form()->checkbox('published', $value = 1, $checked = null, ['id'=>'published','class'=>'form-control bootstrap-checkbox']) !!}
    @error('published')
</div>
