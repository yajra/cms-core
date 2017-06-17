<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.cache.database.table')}}
        @tooltip('cms::config.cache.database.table-info')
    </label>
    {!! form()->input('text', 'database', config("cache.stores.database.table"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Database Table Name Here',
        'v-model'       => 'cache.stores.database.table'
    ]) !!}
</div>
<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.cache.database.connection')}}
        @tooltip('cms::config.cache.database.connection-info')
    </label>
    {!! form()->input('text', 'connection', config("cache.stores.database.connection"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Database Connection Here',
        'v-model'       => 'cache.stores.database.connection'
    ]) !!}
</div>
