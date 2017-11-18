<div class="form-group {{ hasError('parameters[show_greeting]') }}">
    <label class="form-label-style block" for="parameters[show_greeting]">
        {{trans('cms::widget.login.show_greeting')}}
        @tooltip('cms::widget.login.tooltip.show_greeting')
    </label>
    {!! form()->select('parameters[show_greeting]', ['No', 'Yes'], $widget->param('show_greeting'), ['id'=>'parameters[show_greeting]','class'=>'form-control input-sm']) !!}
    @error('parameters[show_greeting]')
</div>

<label class="form-label-style block" for="body">
    {{trans('cms::widget.login.pre_text')}}
    @tooltip('cms::widget.login.tooltip.pre_text')
</label>
