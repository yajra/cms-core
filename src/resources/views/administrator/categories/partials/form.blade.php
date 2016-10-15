<div class="row">
    <div class="col-md-6">
        <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="title">{{trans('cms::categories.form.fields.title')}}</label>
            {!! form()->input('text', 'title', null, ['id'=>'title','class'=>'form-control','placeholder'=>'Enter title here']) !!}
            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {!! $errors->has('alias') ? 'has-error' : '' !!}">
            <label class="form-label-style" for="alias">{{trans('cms::categories.form.fields.alias')}}</label>
            {!! form()->input('text', 'alias', null, ['id'=>'alias','class'=>'form-control','placeholder'=>'Enter alias here']) !!}
            {!! $errors->first('alias', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#category-content" data-toggle="tab">
                <i class="fa fa-info"></i> {{trans('cms::categories.tab.content')}}
            </a>
        </li>
        <li>
            <a href="#category-publishing" data-toggle="tab">
                <i class="fa fa-briefcase"></i> {{trans('cms::categories.tab.publishing')}}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="category-content">
            @include('administrator.categories.partials.tabs.content')
        </div>
        <div class="tab-pane" id="category-publishing">
            @include('administrator.categories.partials.tabs.publishing')
        </div>
    </div>
</div>

@push('js-plugins')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.9/ckeditor.js"></script>
@endpush

@push('scripts')
<script>
    $(function () {
        CKEDITOR.replace('description', {
            allowedContent: true,
            filebrowserBrowseUrl: '/administrator/media/browse',
            filebrowserImageBrowseUrl: '/administrator/media/browse/images',
            customConfig: '/plugins/ckeditor/plugins/justify/plugin.js',
            extraPlugins: 'colorbutton,justify',
        });
    });
</script>
@endpush
