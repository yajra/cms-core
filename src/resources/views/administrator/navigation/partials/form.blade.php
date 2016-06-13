<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
    <label class="form-label-style block" for="title">
        {{trans('navigation.field.title')}}
        @tooltip('navigation.tooltip.title')
    </label>
    {!! form()->input('text', 'title', null, ['id'=>'title','class'=>'form-control','placeholder'=>trans('navigation.field.title_placeholder')]) !!}
    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {!! $errors->has('type') ? 'has-error' : '' !!}">
    <label class="form-label-style block" for="type">
        {{trans('navigation.field.type')}}
        @tooltip('navigation.tooltip.type')
    </label>
    {!! form()->input('text', 'type', null, ['id'=>'type','class'=>'form-control','placeholder'=>trans('navigation.field.type_placeholder')]) !!}
    {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {!! $errors->has('published') ? 'has-error' : '' !!}">
    <label class="form-label-style" for="published">
        {{trans('navigation.field.published')}}
        @tooltip('navigation.tooltip.published')
    </label>
    <br>
    {!! form()->checkbox('published', $value = 1, $checked = null, ['id'=>'published','class'=>'form-control bootstrap-checkbox']) !!}
    {!! $errors->first('published', '<span class="help-block">:message</span>') !!}
</div>