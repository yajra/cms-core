<div class="box box-solid">
    <div class="box-body">
        <div class="form-actions">
            <a href="{{ route('administrator.widgets.index') }}" class="btn btn-warning text-bold">CANCEL</a>
            <button type="submit" class="btn btn-primary text-bold">
                <i class="fa fa-check"></i> {{trans('cms::button.save')}}
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            <label class="form-label-style block" for="title">
                {{trans('cms::widget.field.title')}}
                @tooltip('cms::widget.tooltip.title')
            </label>
            {!! form()->input('text', 'title', null, ['id'=>'title','class'=>'form-control input-sm','placeholder'=>trans('cms::widget.field.title_placeholder')]) !!}
            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#widget" data-toggle="tab" aria-expanded="true">
                <i class="fa fa-info"></i> {{trans('cms::widget.tab.widget')}}</a></li>
        <li class=""><a href="#menu-assignment" data-toggle="tab" aria-expanded="false">
                <i class="fa fa-external-link"></i> {{trans('cms::widget.tab.assignment')}}</a></li>
        <li class=""><a href="#widget-permissions" data-toggle="tab" aria-expanded="false">
                <i class="fa fa-lock"></i> {{trans('cms::widget.tab.permission')}}</a></li>
        <li class=""><a href="#advanced" data-toggle="tab" aria-expanded="false">
                <i class="fa fa-recycle"></i> {{trans('cms::widget.tab.advanced')}}</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="widget">
            @include('administrator.widgets.partials.tabs.widget')
        </div>
        <div class="tab-pane" id="menu-assignment">
            @include('administrator.widgets.partials.tabs.menu')
        </div>
        <div class="tab-pane" id="widget-permissions">
            <div class="content no-padding">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {!! $errors->has('authorization') ? 'has-error' : '' !!}">
                            <label class="form-label-style" for="authorization">
                                {{trans('cms::widget.field.authorization')}}
                                @tooltip('cms::widget.tooltip.authorization')
                            </label>

                            {{ form()->select('authorization', ['can' => trans('cms::widget.authorization.can'), 'canAtLeast' => trans('cms::widget.authorization.canAtLeast')], null, ['class' => 'form-control']) }}
                            {!! $errors->first('authorization', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
                @include('administrator.partials.permissions', ['model' => $widget])
            </div>
        </div>
        <div class="tab-pane" id="advanced">
            @include('administrator.widgets.partials.tabs.advanced')
        </div>
    </div>
    <!-- /.tab-content -->
</div>

@push('js-plugins')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.9/ckeditor.js"></script>
@endpush

@push('scripts')
<script>
    new Vue({
        el: '#widget-form',
        data: {
            widget: {!! $widget->toJson() !!},
            types: [],
            templates: []
        },
        methods: {
            fetchTemplates: function () {
                $.blockUI();
                $.getJSON('/administrator/widgets/' + this.widget.extension_id + '/templates', {}, function (json) {
                    this.templates = json.data;
                    this.widget.extension_id = json.selected;
                    this.widget.template = json.template;
                    $.unblockUI();
                }.bind(this))
            }
        },
        ready: function () {
            this.fetchTemplates();

            CKEDITOR.replace('body', {
                allowedContent: true,
                filebrowserBrowseUrl: '/administrator/media/browse',
                filebrowserImageBrowseUrl: '/administrator/media/browse/images'
            });
        }
    });
</script>
@endpush
