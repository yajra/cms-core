<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.cache.file.path')}}
        @tooltip('cms::config.cache.file.path-info')
    </label>
    {!! form()->input('text', 'file', config("cache.stores.file.path"), [
        'class'         => 'form-control',
        'placeholder'   => trans('cms::config.cache.file.path-info'),
        'v-model'       => 'cache.stores.file.path'
    ]) !!}
</div>
