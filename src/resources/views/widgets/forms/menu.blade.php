<div class="row">
    <div class="form-group col-md-6 {!! $errors->has('parameters[navigation_id]') ? 'has-error' : '' !!}">
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

    <div class="form-group col-md-6 {{ $errors->has('parameters[menu_class]') ? 'has-error' : '' }}">
        <label class="form-label-style block" for="parameters[menu_class]">
            {{trans('cms::widget.field.parameters.menu_class')}}
            @tooltip('cms::widget.tooltip.parameters.menu_class')
        </label>
        {{ form()->input('text', 'parameters[menu_class]', $widget->param('menu_class', 'nav navbar-nav'), ['id'=>'parameters[menu_class]','class'=>'form-control input-sm']) }}
        {!! $errors->first('parameters[menu_class]', '<span class="help-block">:message</span>') !!}
    </div>
</div>
