<div class="row">
    <div class="form-group col-md-6 {{ hasError('parameters[navigation_id]') }}">
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
        @error('parameters[navigation_id]')
    </div>

    <div class="form-group col-md-6 {{ hasError('parameters[menu_class]') }}">
        <label class="form-label-style block" for="parameters[menu_class]">
            {{trans('cms::widget.field.parameters.menu_class')}}
            @tooltip('cms::widget.tooltip.parameters.menu_class')
        </label>
        {{ form()->input('text', 'parameters[menu_class]', $widget->param('menu_class', 'nav navbar-nav'), ['id'=>'parameters[menu_class]','class'=>'form-control input-sm']) }}
        @error('parameters[menu_class]')
    </div>
</div>
