<div class="box box-solid">
    <div class="box-body">
        <div class="form-actions">
            <a href="{{ route('administrator.widgets.index') }}" class="btn btn-warning text-bold">CANCEL</a>
            <button type="submit" class="btn btn-primary text-bold">
                <i class="fa fa-check"></i> SAVE CHANGES
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="title">Title
                @tooltip('Widget must have a title.')
            </label>
            {!! form()->input('text', 'title', null, ['id'=>'title','class'=>'form-control','placeholder'=>'Enter title here']) !!}
            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#widget" data-toggle="tab" aria-expanded="true">
                <i class="fa fa-info"></i> Widget</a></li>
        <li class=""><a href="#menu-assignment" data-toggle="tab" aria-expanded="false">
                <i class="fa fa-external-link"></i> Menu Assignment</a></li>
        <li class=""><a href="#widget-permissions" data-toggle="tab" aria-expanded="false">
                <i class="fa fa-lock"></i> Widget Permissions</a></li>
        <li class=""><a href="#advanced" data-toggle="tab" aria-expanded="false">
                <i class="fa fa-recycle"></i> Advanced</a></li>
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
                                Widget Authorization Condition
                                @tooltip('Widget authorization will only apply if at least one permission was selected.')
                            </label>

                            {{ form()->select('authorization', ['can' => 'Must have all selected permissions', 'canAtLeast' => 'Must have at least one of selected permissions'], null, ['class' => 'form-control']) }}
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
                $.getJSON('/administrator/lookup/search/widgets.' + this.widget.type + '.templates', {selected: this.widget.type}, function (json) {
                    this.templates = json.data;
                    this.widget.type = json.selected;
                }.bind(this))
            }
        },
        ready: function () {
            $.blockUI();
            $.getJSON('/administrator/lookup/search/widgets.types', {}, function (json) {
                this.types = json.data;
                $.unblockUI();
            }.bind(this));

            this.fetchTemplates();

            CKEDITOR.replace('body', {
                filebrowserBrowseUrl: '/administrator/media/browse',
                filebrowserImageBrowseUrl: '/administrator/media/browse/images'
            });
        }
    });
</script>
@endpush
