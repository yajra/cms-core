<div class="form-group">
    <label class="form-label-style block" for="title">Connection
        @tooltip('Specify redis connection.')
    </label>
    {!! form()->input('text', 'connection', $configuration->key("cache.stores.redis.connection"), [
        'id'            => 'app_connection',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Memcached Hosts Here',
        'v-model'       => 'cache.storesAAAredisAAAconnection'
    ]) !!}
</div>