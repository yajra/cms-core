<div class="form-group">
    <label class="form-label-style block">
        Database Table Name
        @tooltip('Database table name you wish to store cache.')
    </label>
    {!! form()->input('text', 'database', config("cache.stores.database.table"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Database Table Name Here',
        'v-model'       => 'cache.stores.database.table'
    ]) !!}
</div>
<div class="form-group">
    <label class="form-label-style block">
        Database Connection
        @tooltip('Specify cache database connection.')
    </label>
    {!! form()->input('text', 'connection', config("cache.stores.database.connection"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Database Connection Here',
        'v-model'       => 'cache.stores.database.connection'
    ]) !!}
</div>
