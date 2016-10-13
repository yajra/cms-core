<div class="form-group">
    <label class="form-label-style block" for="title">Host
        @tooltip('PGSQL host name.')
    </label>
    {!! form()->input('text', 'host', $configuration->key("database.connections.pgsql.host"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Host Name Here',
        'v-model'       => 'database.connections.pgsql.host'
    ]) !!}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Database Username
                @tooltip('PGSQL database username.')
            </label>
            {!! form()->input('text', 'username', $configuration->key("database.connections.pgsql.username"), [
                'class'         => 'form-control',
                'placeholder'   => 'Enter Username Name Here',
                'v-model'       => 'database.connections.pgsql.username'
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Database Password
                @tooltip('PGSQL database password.')
            </label>
            {!! form()->input('password', 'password', null, [
                'class'         => 'form-control',
                'placeholder'   => 'Enter Password Here',
                'v-model'       => 'database.connections.pgsql.password'
            ]) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block" for="title">Database Name
        @tooltip('PGSQL database name.')
    </label>
    {!! form()->input('text', 'name', $configuration->key("database.connections.pgsql.database"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Databas Name Here',
        'v-model'       => 'database.connections.pgsql.database'
    ]) !!}
</div>
<div class="form-group">
    <label class="form-label-style block" for="title">Schema
        @tooltip('PGSQL database scheme.')
    </label>
    {!! form()->input('text', 'name', $configuration->key("database.connections.pgsql.schema"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Schema Name Here',
        'v-model'       => 'database.connections.pgsql.schema'
    ]) !!}
</div>