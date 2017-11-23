<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ hasError('parameters[meta_description]') }}">
            <label class="form-label-style block" for="parameters[meta_description]">
                {{trans('cms::menu.field.meta_description')}}
                @tooltip('cms::menu.tooltip.meta_description')
            </label>
            {!! form()->textarea('parameters[meta_description]', $menu->param('meta_description'), ['id'=>'parameters[meta_description]','class'=>'form-control input-sm','placeholder'=>trans('cms::menu.field.meta_description_placeholder')]) !!}
            @error('parameters[meta_description]')
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ hasError('parameters[meta_keywords]') }}">
            <label class="form-label-style block" for="parameters[meta_keywords]">
                {{trans('cms::menu.field.meta_keywords')}}
                @tooltip('cms::menu.tooltip.meta_keywords')
            </label>
            {!! form()->textarea('parameters[meta_keywords]', $menu->param('meta_keywords'), ['id'=>'parameters[meta_keywords]','class'=>'form-control input-sm','placeholder'=>trans('cms::menu.field.meta_keywords_placeholder')]) !!}
            @error('parameters[meta_keywords]')
        </div>
    </div>
</div>
