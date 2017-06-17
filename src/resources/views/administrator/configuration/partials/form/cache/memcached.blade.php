<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.cache.memcached.host')}}
                @tooltip('cms::config.cache.memcached.host-info')
            </label>
            <input type="text" v-model="cache.stores.memcached.servers[0].host" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.cache.memcached.port')}}
                @tooltip('cms::config.cache.memcached.port-info')
            </label>
            <input type="text" v-model="cache.stores.memcached.servers[0].port" class="form-control">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.cache.memcached.weight')}}
        @tooltip('cms::config.cache.memcached.weight-info')
    </label>
    <input type="text" v-model="cache.stores.memcached.servers[0].weight" class="form-control">
</div>
