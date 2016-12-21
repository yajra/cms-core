<div class="form-group">
    <label class="form-label-style block">
        Host
        @tooltip('Mysql host name.')
    </label>
    <input type="text" class="form-control" v-model="database.connections.mysql.host">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Database Username
                @tooltip('Mysql database username.')
            </label>
            <input type="text" class="form-control" v-model="database.connections.mysql.username">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Database Password
                @tooltip('Mysql database password.')
            </label>
            <input type="password" class="form-control" v-model="database.connections.mysql.password">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block">
        Database Name
        @tooltip('Mysql database name.')
    </label>
    <input type="text" class="form-control" v-model="database.connections.mysql.database">
</div>
