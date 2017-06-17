<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.database.database')}}
        @tooltip('cms::config.database.database-info')
    </label>
    <input type="text" v-model="database.connections.sqlite.database" class="form-control">
</div>
