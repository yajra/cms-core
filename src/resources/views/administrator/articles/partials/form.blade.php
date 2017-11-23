<div id="app">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group {{ hasError('title') }}">
                <label class="form-label-style block" for="title">
                    {{trans('cms::article.form.field.title')}}
                    @tooltip('cms::article.form.tooltip.title')
                </label>
                {!! form()->input('text', 'title', null, ['id'=>'title','class'=>'form-control','placeholder'=>trans('cms::article.form.field.title_placeholder')]) !!}
                @error('title')
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ hasError('alias') }}">
                <label class="form-label-style block" for="alias">
                    {{trans('cms::article.form.field.alias')}}
                    @tooltip('cms::article.form.tooltip.alias')
                </label>
                {!! form()->input('text', 'alias', null, ['id'=>'alias','class'=>'form-control','placeholder'=>trans('cms::article.form.field.alias_placeholder')]) !!}
                @error('alias')
            </div>
        </div>
    </div>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#article-content" data-toggle="tab">
                    <i class="fa fa-info"></i> {{trans('cms::article.tab.content')}}
                </a>
            </li>
            <li>
                <a href="#article-publishing" data-toggle="tab">
                    <i class="fa fa-briefcase"></i> {{trans('cms::article.tab.publishing')}}
                </a>
            </li>
            <li>
                <a href="#article-images-links" data-toggle="tab">
                    <i class="fa fa-image"></i> {{trans('cms::article.tab.images_links')}}
                </a>
            </li>
            <li>
                <a href="#article-options" data-toggle="tab">
                    <i class="fa fa-eye"></i> {{trans('cms::article.tab.options')}}
                </a>
            </li>
            <li>
                <a href="#article-permission" data-toggle="tab">
                    <i class="fa fa-lock"></i> {{trans('cms::article.tab.permission')}}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="article-content">
                @include('administrator.articles.partials.form.content')
            </div>
            <div class="tab-pane" id="article-publishing">
                @include('administrator.articles.partials.form.publishing')
            </div>
            <div class="tab-pane" id="article-images-links">
                @include('administrator.articles.partials.form.images-links')
            </div>
            <div class="tab-pane" id="article-options">
                @include('administrator.articles.partials.form.options')
            </div>
            <div class="tab-pane {{ $errors->has('permissions') ? 'has-error' : '' }}" id="article-permission">
                <div class="content">
                    <div class="row">
                        <div class="form-group {{ hasError('authorization') }}">
                            <label class="form-label-style" for="authorization">
                                {{trans('cms::article.form.field.authorization')}}
                                @tooltip('cms::article.form.tooltip.authorization')
                            </label>

                            {{ form()->select('authorization', ['can' => trans('cms::article.authorization.can'), 'canAtLeast' => trans('cms::article.authorization.canAtLeast')], null, ['class' => 'form-control']) }}
                            @error('authorization')
                        </div>
                    </div>
                    <div class="row">
                        @include('administrator.partials.permissions', ['model' => $article])
                        @error('permissions')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js-plugins')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.6.2/ckeditor.js"></script>
@endpush

@push('scripts')
<script>
    new Vue({
        el: '#app',
        mounted() {
            var tags = [
                    @foreach ($tags as $tag)
                {tag: "{{$tag}}" },
                @endforeach
            ];

            $('#tags').selectize({
                delimiter: ',',
                persist: false,
                valueField: 'tag',
                labelField: 'tag',
                searchField: 'tag',
                options: tags,
                create: function(input) {
                    return {
                        tag: input
                    }
                }
            });

            CKEDITOR.replace('body', {
                allowedContent: true,
                filebrowserBrowseUrl: YajraCMS.adminPath + '/media/browse',
                filebrowserImageBrowseUrl: YajraCMS.adminPath + '/media/browse/images',
                customConfig: '/plugins/ckeditor/config.js',
                extraPlugins: 'colorbutton,justify,colordialog,readmore',
            });
        }
    });
</script>
@endpush
