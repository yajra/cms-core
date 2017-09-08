<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {!! $errors->has('parameters[page_title]') ? 'has-error' : '' !!}">
                <label class="form-label-style block" for="parameters[page_title]">
                    {{trans('cms::menu.field.page_title')}}
                    @tooltip('cms::menu.tooltip.page_title')
                </label>
                {!! form()->input('text', 'parameters[page_title]', $menu->param('page_title'), ['id'=>'parameters[page_title]','class'=>'form-control input-sm','placeholder'=>trans('cms::menu.field.page_title_placeholder')]) !!}
                {!! $errors->first('parameters[page_title]', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group {!! $errors->has('parameters[page_heading]') ? 'has-error' : '' !!}">
                <label class="form-label-style block" for="parameters[page_heading]">
                    {{trans('cms::menu.field.page_heading')}}
                    @tooltip('cms::menu.tooltip.page_heading')
                </label>
                {!! form()->input('text', 'parameters[page_heading]', $menu->param('page_heading'), ['id'=>'parameters[page_heading]','class'=>'form-control input-sm','placeholder'=>trans('cms::menu.field.page_heading_placeholder')]) !!}
                {!! $errors->first('parameters[page_title]', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group {!! $errors->has('parameters[page_class]') ? 'has-error' : '' !!}">
                <label class="form-label-style block" for="parameters[page_class]">
                    {{trans('cms::menu.field.page_class')}}
                    @tooltip('cms::menu.tooltip.page_class')
                </label>
                {!! form()->input('text', 'parameters[page_class]', $menu->param('page_class'), ['id'=>'parameters[page_class]','class'=>'form-control input-sm','placeholder'=>trans('cms::menu.field.page_class_placeholder')]) !!}
                {!! $errors->first('parameters[page_title]', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {!! $errors->has('parameters[link_title]') ? 'has-error' : '' !!}">
                <label class="form-label-style block" for="parameters[link_title]">
                    {{trans('cms::menu.field.link_title')}}
                    @tooltip('cms::menu.tooltip.link_title')
                </label>
                {!! form()->input('text', 'parameters[link_title]', $menu->param('link_title'), ['id'=>'parameters[link_title]','class'=>'form-control input-sm','placeholder'=>trans('cms::menu.field.link_title_placeholder')]) !!}
                {!! $errors->first('parameters[page_title]', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group {!! $errors->has('parameters[link_style]') ? 'has-error' : '' !!}">
                <label class="form-label-style block" for="parameters[link_style]">
                    {{trans('cms::menu.field.link_style')}}
                    @tooltip('cms::menu.tooltip.link_style')
                </label>
                {!! form()->input('text', 'parameters[link_style]', $menu->param('link_style'), ['id'=>'parameters[link_style]','class'=>'form-control input-sm','placeholder'=>trans('cms::menu.field.link_style_placeholder')]) !!}
                {!! $errors->first('parameters[page_title]', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
    </div>
</div>
