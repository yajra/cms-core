<div class="box-body no-padding" id="widget-form">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {!! $errors->has('type') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="type">Type
                            @tooltip('Type of widget.')
                        </label>
                        <select name="type" class="form-control" v-model="widget.type" @change="fetchTemplates">
                        <option v-for="type in types" v-bind:value="type.key">@{{ type.value }}</option>
                        </select>
                        {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {!! $errors->has('template') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="template">Template
                            @tooltip('Widget blade template.')
                        </label>
                        <select name="template" class="form-control" v-model="widget.template">
                            <option v-for="template in templates" v-bind:value="template.key">@{{ template.value }}</option>
                        </select>
                        {!! $errors->first('template', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {!! $errors->has('custom_template') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="custom_template">Custom Template Path
                            <small>(Required if Custom)</small>
                        </label>
                        {!! form()->input('text', 'custom_template', null, ['id'=>'custom_template','class'=>'form-control input-sm','placeholder'=>'path.to.widget.view']) !!}
                        {!! $errors->first('custom_template', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {!! $errors->has('parameter') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="parameter">Parameter
                            @tooltip('If widget is menu, the parameter value should be a navigation type like (mainmenu).')
                        </label>
                        {!! form()->input('text', 'parameter', null, ['id'=>'parameter','class'=>'form-control','placeholder'=>'param1,param2,param3...']) !!}
                        {!! $errors->first('parameter', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>

            <div class="form-group {!! $errors->has('body') ? 'has-error' : '' !!}">
                <div class="input-control">
                    {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                    {!! form()->textarea('body', null, ['id'=>'body','class'=>'form-control','rows'=>3,'cols'=>10]) !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {!! $errors->has('position') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="position">Position
                            @tooltip('A pre-defined widget group position on your site template where the widget will be displayed.')
                        </label>
                        {!! form()->select('position', $widget_positions , null , ['class' => 'form-control select2']) !!}
                        {!! $errors->first('position', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {!! $errors->has('order') ? 'has-error' : '' !!}">
                        <label class="form-label-style block" for="order">Order
                            @tooltip('Display order in widget position/group.')
                        </label>
                        {!! form()->select('order', array_combine(range(1, 100), range(1, 100)) , null , ['class' => 'form-control select2']) !!}
                        {!! $errors->first('order', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {!! $errors->has('published') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="published">Published
                            @tooltip('If published, this widget will be displayed on site.')
                        </label>
                        <br>
                        {!! form()->checkbox('published', $value = 1, $checked = null, ['id'=>'published','class'=>'bootstrap-checkbox']) !!}
                        {!! $errors->first('published', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {!! $errors->has('authenticated') ? 'has-error' : '' !!}">
                        <label class="form-label-style" for="authenticated">Authenticated
                            @tooltip('Requires authentication to access the widget.')
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
