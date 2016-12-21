<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">Host
                @tooltip('Memcache host name,')
            </label>
            <input type="text" v-model="cache.stores.memcached.servers[0].host" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">Port
                @tooltip('Memcached port.')
            </label>
            <input type="text" v-model="cache.stores.memcached.servers[0].port" class="form-control">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block">Weight
        @tooltip('Memcached weight.')
    </label>
    <input type="text" v-model="cache.stores.memcached.servers[0].weight" class="form-control">
</div>
