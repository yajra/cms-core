<div class="form-group {!! $errors->has('parameters[navigation_id]') ? 'has-error' : '' !!}">
    <label class="form-label-style block" for="parameters[navigation_id]">
        {{trans('cms::widget.field.parameters.navigation_id')}}
        @tooltip('cms::widget.tooltip.parameters.navigation_id')
    </label>
    {{ form()->select(
        'parameters[navigation_id]',
        app('navigation')->all()->pluck('title', 'id'),
        $widget->param('navigation_id'),
        ['class' => 'form-control']
        ) }}
    {!! $errors->first('parameters[navigation_id]', '<span class="help-block">:message</span>') !!}
</div>
