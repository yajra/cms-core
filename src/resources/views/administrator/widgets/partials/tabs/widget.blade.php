<div class="box-body no-padding" id="widget-form">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group {!! $errors->has('type') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="type">
                            {{trans('cms::widget.field.type')}}
                            @tooltip('cms::widget.tooltip.type')
                        </label>
                        <select name="extension_id"
                                class="form-control"
                                v-model="widget.extension_id"
                                v-on:change="fetchDependencies"
                        >
                            <option v-for="extension in extensions"
                                    :value="extension.id"
                                    v-text="extension.name"
                            ></option>
                        </select>
                        {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group {!! $errors->has('template') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="template">
                            {{trans('cms::widget.field.template')}}
                            @tooltip('cms::widget.tooltip.template')
                        </label>
                        <select name="template" v-model="widget.template" class="form-control select-menu">
                            <option v-for="template in templates"
                                    :value="template.key" v-text="template.value"
                            ></option>
                        </select>
                        {!! $errors->first('template', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group {!! $errors->has('custom_template') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="custom_template">
                            {!! trans('cms::widget.field.custom_template') !!}
                            @tooltip('cms::widget.field.custom_template_required')
                        </label>
                        {!! form()->input('text', 'custom_template', null, ['id'=>'custom_template','class'=>'form-control input-sm','placeholder'=>'path.to.widget.view']) !!}
                        {!! $errors->first('custom_template', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>

            <div id="widget-custom-form"></div>

            <div class="form-group {!! $errors->has('body') ? 'has-error' : '' !!}">
                <div class="input-control">
                    {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                    {!! form()->textarea('body', null, ['id'=>'body','class'=>'form-control','rows'=>3,'cols'=>10]) !!}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {!! $errors->has('position') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="position">
                            {{$theme->name}}&nbsp;{{trans('cms::widget.field.position')}}
                            @tooltip('cms::widget.tooltip.position')
                        </label>
                        {!! form()->select('position', $widget_positions , null , ['class' => 'form-control select2']) !!}
                        {!! $errors->first('position', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('order') ? 'has-error' : '' !!}">
                        <label class="form-label-style block" for="order">
                            {{trans('cms::widget.field.order')}}
                            @tooltip('cms::widget.tooltip.order')
                        </label>
                        {!! form()->select('order', array_combine(range(1, 100), range(1, 100)) , null , ['class' => 'form-control select2']) !!}
                        {!! $errors->first('order', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {!! $errors->has('show_title') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="show_title">
                            {{trans('cms::widget.field.show_title')}}
                            @tooltip('cms::widget.tooltip.show_title')
                        </label>
                        <br>
                        {!! form()->checkbox('show_title', $value = 1, $checked = null, ['id'=>'show_title','class'=>'bootstrap-checkbox']) !!}
                        {!! $errors->first('show_title', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('published') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="published">
                            {{trans('cms::widget.field.published')}}
                            @tooltip('cms::widget.tooltip.published')
                        </label>
                        <br>
                        {!! form()->checkbox('published', $value = 1, $checked = null, ['id'=>'published','class'=>'bootstrap-checkbox']) !!}
                        {!! $errors->first('published', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('authenticated') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="authenticated">
                            {{trans('cms::widget.field.authenticated')}}
                            @tooltip('cms::widget.tooltip.authenticated')
                        </label>
                        <br>
                        {!! form()->checkbox('authenticated', $value = 1, $checked = null, ['name' =>'authenticated','id'=>'authenticated','class'=>'form-control bootstrap-checkbox']) !!}
                        {!! $errors->first('authenticated', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
