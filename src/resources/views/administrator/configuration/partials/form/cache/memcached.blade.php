<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Host
                @tooltip('Memcache host name,')
            </label>
            {!! form()->input('text', 'host', $configuration->key("cache.stores.memcached.servers")[0]['host'], [
                'class'         => 'form-control',
                'placeholder'   => 'Enter Memcached Hosts Here',
                'v-model'       => 'cache.storesAAAmemcachedAAAserversAAAhost'
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Port
                @tooltip('Memcached port.')
            </label>
            {!! form()->input('text', 'port', $configuration->key("cache.stores.memcached.servers")[0]['port'], [
                'class'         =>'form-control',
                'placeholder'   =>'Enter Memcached Port Here',
                'v-model'       => 'cache.storesAAAmemcachedAAAserversAAAport'
            ]) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block" for="title">Weight
        @tooltip('Memcached weight.')
    </label>
    {!! form()->input('text', 'weight', $configuration->key("cache.stores.memcached.servers")[0]['weight'], [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Memcached Weight Here',
        'v-model'       => 'cache.storesAAAmemcachedAAAserversAAAweight'
    ]) !!}
</div>