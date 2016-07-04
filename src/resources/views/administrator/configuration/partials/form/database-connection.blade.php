<input type="hidden" v-model="database.config" value="database">
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label-style block" for="title">Default Database
                @tooltip('Here you may specify which of the database connections below you wish to use as your default connection for all database work. Of course you may use many connections at once using the Database library.')
            </label>
            {!! form()->select('default', [
                    'sqlite'    => 'SQLite',
                    'mysql'     => 'MYSQL',
                    'pgsql'     => 'PGSQL',
                    'oracle'    => 'ORACLE',
                ],$configuration->key("database.default"),[
                    'class'     => 'form-control select2',
                    'id'        => 'default-db',
                    'v-model'   => 'database.default',
                    'config'    => 'database.default'
                ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="@if($configuration->key("database.default") == 'mysql') @else hide @endif db-container"
             id="mysql-db-container">
            @include('administrator.configuration.partials.form.databases.mysql')
        </div>
        <div class="@if($configuration->key("database.default") == 'oracle') @else hide @endif db-container"
             id="oracle-db-container">
            @include('administrator.configuration.partials.form.databases.oracle')
        </div>
        <div class="@if($configuration->key("database.default") == 'pgsql') @else hide @endif db-container"
             id="pgsql-db-container">
            @include('administrator.configuration.partials.form.databases.pgsql')
        </div>
        <div class="@if($configuration->key("database.default") == 'sqlite') @else hide @endif db-container"
             id="sqlite-db-container">
            @include('administrator.configuration.partials.form.databases.sqlite')
        </div>
    </div>
</div>