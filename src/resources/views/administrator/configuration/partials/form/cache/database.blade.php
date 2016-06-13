<div class="form-group">
    <label class="form-label-style block" for="title">Database Table Name
        @tooltip('')
    </label>
    {!! form()->input('text', 'database', $configuration->key("cache.stores.database.table"), [
        'id'            => 'app_database',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Database Table Here',
        'v-model'       => 'cache.storesAAAdatabaseAAAtable'
    ]) !!}
</div>

<div class="form-group">
    <label class="form-label-style block" for="title">Database Connection
        @tooltip('')
    </label>
    {!! form()->input('text', 'connection', $configuration->key("cache.stores.database.connection"), [
        'id'            => 'app_connection',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Database Table Here',
        'v-model'       => 'cache.storesAAAdatabaseAAAconnection'
    ]) !!}
</div>