<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.database.host')}}
        @tooltip('cms::config.database.host-info')
    </label>
    <input type="text" v-model="database.connections.pgsql.host" class="form-control">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.database.username')}}
                @tooltip('cms::config.database.username-info')
            </label>
            <input type="text" v-model="database.connections.pgsql.username" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.database.password')}}
                @tooltip('cms::config.database.password-info')
            </label>
            <input type="password" v-model="database.connections.pgsql.password" class="form-control">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.database.database')}}
        @tooltip('cms::config.database.database-info')
    </label>
    <input type="text" v-model="database.connections.pgsql.database" class="form-control">
</div>
<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.database.schema')}}
        @tooltip('cms::config.database.schema-info')
    </label>
    <input type="text" v-model="database.connections.pgsql.schema" class="form-control">
</div>
