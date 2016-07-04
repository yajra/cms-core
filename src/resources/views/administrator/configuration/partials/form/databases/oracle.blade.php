<div class="form-group">
    <label class="form-label-style block" for="title">Host
        @tooltip('Oracle host name.')
    </label>
    {!! form()->input('text', 'host', $configuration->key("database.connections.oracle.host"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Host Name Here',
        'v-model'       => 'database.connectionsAAAoracleAAAhost'
    ]) !!}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Database Username
                @tooltip('Oracle database username.')
            </label>
            {!! form()->input('text', 'username', $configuration->key("database.connections.oracle.username"), [
                'class'         => 'form-control',
                'placeholder'   => 'Enter Username Name Here',
                'v-model'       => 'database.connectionsAAAoracleAAAusername'
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Database Password
                @tooltip('Oracle database password.')
            </label>
            {!! form()->input('password', 'password', null, [
                'class'         => 'form-control',
                'placeholder'   => 'Enter Password Here',
                'v-model'       => 'database.connectionsAAAoracleAAApassword'
            ]) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block" for="title">Database Name
        @tooltip('Oracle database name.')
    </label>
    {!! form()->input('text', 'name', $configuration->key("database.connections.oracle.database"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Database Name Here',
        'v-model'       => 'database.connectionsAAAoracleAAAdatabase'
    ]) !!}
</div>