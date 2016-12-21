<div class="form-group">
    <label class="form-label-style block">
        Host
        @tooltip('PGSQL host name.')
    </label>
    <input type="text" v-model="database.connections.pgsql.host" class="form-control">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Database Username
                @tooltip('PGSQL database username.')
            </label>
            <input type="text" v-model="database.connections.pgsql.username" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Database Password
                @tooltip('PGSQL database password.')
            </label>
            <input type="password" v-model="database.connections.pgsql.password" class="form-control">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block">
        Database Name
        @tooltip('PGSQL database name.')
    </label>
    <input type="text" v-model="database.connections.pgsql.database" class="form-control">
</div>
<div class="form-group">
    <label class="form-label-style block">
        Schema
        @tooltip('PGSQL database scheme.')
    </label>
    <input type="text" v-model="database.connections.pgsql.schema" class="form-control">
</div>
