<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.cache.redis.connection')}}
        @tooltip('cms::config.cache.redis.connection-info')
    </label>
    <input type="text" v-model="cache.stores.redis.connection" class="form-control">
</div>
