<div class="form-group">
    <label class="form-label-style block">
        Host
        @tooltip('Oracle host name.')
    </label>
    <input type="text" v-model="database.connections.oracle.host" class="form-control">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Database Username
                @tooltip('Oracle database username.')
            </label>
            <input type="text" v-model="database.connections.oracle.username" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Database Password
                @tooltip('Oracle database password.')
            </label>
            <input type="password" v-model="database.connections.oracle.password" class="form-control">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block">
        Database Name
        @tooltip('Oracle database name.')
    </label>
    <input type="text" v-model="database.connections.oracle.database" class="form-control">
</div>
