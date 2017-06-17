<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.database.host')}}
        @tooltip('cms::config.database.host-info')
    </label>
    <input type="text" class="form-control" v-model="database.connections.mysql.host">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.database.username')}}
                @tooltip('cms::config.database.username-info')
            </label>
            <input type="text" class="form-control" v-model="database.connections.mysql.username">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.database.password')}}
                @tooltip('cms::config.database.password-info')
            </label>
            <input type="password" class="form-control" v-model="database.connections.mysql.password">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.database.database')}}
        @tooltip('cms::config.database.database-info')
    </label>
    <input type="text" class="form-control" v-model="database.connections.mysql.database">
</div>
