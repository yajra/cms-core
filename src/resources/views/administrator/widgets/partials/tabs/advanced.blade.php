<div class="content no-padding">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label-style" for="parameters[class_suffix]">
                    {{trans('cms::widget.field.class_suffix')}}
                    @tooltip('cms::widget.tooltip.class_suffix')
                </label>

                {!! form()->input('text', 'parameters[class_suffix]', $widget->fluentParameters()->widget_class_suffix, ['placeholder' => trans('cms::widget.field.class_suffix_placeholder'),'class'=>'form-control input-sm']) !!}
            </div>

            <div class="form-group">
                <label class="form-label-style" for="parameters[header_class]">
                    {{trans('cms::widget.field.header_class')}}
                    @tooltip('cms::widget.tooltip.header_class')
                </label>

                {!! form()->input('text', 'parameters[header_class]', $widget->fluentParameters()->header_class, ['placeholder' => trans('cms::widget.field.header_class_placeholder'),'class'=>'form-control input-sm']) !!}
            </div>
        </div>
    </div>
</div>
