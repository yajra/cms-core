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
        @foreach($databases as $database)
            <div class="@if($configuration->key("database.default") == $database['driver']) @else hide @endif db-container"
                 id="{{$database['driver']}}-db-container">
                @include('administrator.configuration.partials.form.databases.'.$database['driver'])
            </div>
        @endforeach
    </div>
</div>