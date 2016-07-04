<div class="form-group">
    <label class="form-label-style block" for="title">Database Table Name
        @tooltip('Database table name you wish to store cache.')
    </label>
    {!! form()->input('text', 'database', $configuration->key("cache.stores.database.table"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Database Table Name Here',
        'v-model'       => 'cache.storesAAAdatabaseAAAtable'
    ]) !!}
</div>
<div class="form-group">
    <label class="form-label-style block" for="title">Database Connection
        @tooltip('Specify cache database connection.')
    </label>
    {!! form()->input('text', 'connection', $configuration->key("cache.stores.database.connection"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Database Connection Here',
        'v-model'       => 'cache.storesAAAdatabaseAAAconnection'
    ]) !!}
</div>