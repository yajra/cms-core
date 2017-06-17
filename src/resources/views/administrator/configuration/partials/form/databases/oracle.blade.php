<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.database.host')}}
        @tooltip('cms::config.database.host-info')
    </label>
    <input type="text" v-model="database.connections.oracle.host" class="form-control">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.database.username')}}
                @tooltip('cms::config.database.username-info')
            </label>
            <input type="text" v-model="database.connections.oracle.username" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.database.password')}}
                @tooltip('cms::config.database.password-info')
            </label>
            <input type="password" v-model="database.connections.oracle.password" class="form-control">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.database.database')}}
        @tooltip('cms::config.database.database-info')
    </label>
    <input type="text" v-model="database.connections.oracle.database" class="form-control">
</div>
