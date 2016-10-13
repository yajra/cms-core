<div class="form-group">
    <label class="form-label-style block" for="title">Host
        @tooltip('Mysql host name.')
    </label>
    {!! form()->input('text', 'host', $configuration->key("database.connections.mysql.host"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Host Name Here',
        'v-model'       => 'database.connections.mysql.host'
    ]) !!}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Database Username
                @tooltip('Mysql database username.')
            </label>
            {!! form()->input('text', 'username', $configuration->key("database.connections.mysql.username"), [
                'class'         => 'form-control',
                'placeholder'   => 'Enter Username Name Here',
                'v-model'       => 'database.connections.mysql.username'
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Database Password
                @tooltip('Mysql database password.')
            </label>
            {!! form()->input('password', 'password', '', [
                'class'         => 'form-control',
                'placeholder'   => 'Enter Password Here',
                'v-model'       => 'database.connections.mysql.password'
            ]) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block" for="title">Database Name
        @tooltip('Mysql database name.')
    </label>
    {!! form()->input('text', 'name', $configuration->key("database.connections.mysql.database"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Database Name Here',
        'v-model'       => 'database.connections.mysql.database'
    ]) !!}
</div>