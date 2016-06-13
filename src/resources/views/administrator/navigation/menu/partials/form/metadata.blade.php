<div class="row">
    <div class="col-md-6">
        <div class="form-group {!! $errors->has('parameters[meta_description]') ? 'has-error' : '' !!}">
            <label class="form-label-style block" for="parameters[meta_description]">
                {{trans('menu.field.meta_description')}}
                @tooltip('menu.tooltip.meta_description')
            </label>
            {!! form()->textarea('parameters[meta_description]', $menu->fluentParameters()->meta_description, ['id'=>'parameters[meta_description]','class'=>'form-control input-sm','placeholder'=>trans('menu.field.meta_description_placeholder')]) !!}
            {!! $errors->first('parameters[meta_description]', '<span class="help-block">:message</span>') !!}
        </div>

        <div class="form-group {!! $errors->has('parameters[meta_keywords]') ? 'has-error' : '' !!}">
            <label class="form-label-style block" for="parameters[meta_keywords]">
                {{trans('menu.field.meta_keywords')}}
                @tooltip('menu.tooltip.meta_keywords')
            </label>
            {!! form()->textarea('parameters[meta_keywords]', $menu->fluentParameters()->meta_keywords, ['id'=>'parameters[meta_keywords]','class'=>'form-control input-sm','placeholder'=>trans('menu.field.meta_keywords_placeholder')]) !!}
            {!! $errors->first('parameters[meta_keywords]', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>