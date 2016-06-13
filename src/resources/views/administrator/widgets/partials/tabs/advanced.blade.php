<div class="content no-padding">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label-style" for="parameters[widget_class_suffix]">
                    Widget Class Suffix
                    @tooltip('A suffix to be applied to the CSS of the widget. This allows for individual widget styling.')
                </label>

                {!! form()->input('text', 'parameters[widget_class_suffix]', $widget->fluentParameters()->widget_class_suffix, ['placeholder' => 'Enter widget class suffix here','class'=>'form-control input-sm']) !!}
            </div>

            <div class="form-group">
                <label class="form-label-style" for="parameters[header_class]">
                    Header Class
                    @tooltip('The CSS class for widget header/title.')
                </label>

                {!! form()->input('text', 'parameters[header_class]', $widget->fluentParameters()->header_class, ['placeholder' => 'Enter header class here','class'=>'form-control input-sm']) !!}
            </div>
        </div>
    </div>
</div>
