<div class="form-group">
    <label class="form-label-style block" for="title">Host
        @tooltip('Some Text Here.')
    </label>
    {!! form()->input('text', 'host', $configuration->key("database.connections.pgsql.host"), [
        'id'            => '',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Host Name Here',
        'v-model'       => 'database.connectionsAAApgsqlAAAhost'
    ]) !!}
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Database Username
                @tooltip('Some Text Here.')
            </label>
            {!! form()->input('text', 'username', $configuration->key("database.connections.pgsql.username"), [
                'id'            => '',
                'class'         => 'form-control',
                'placeholder'   => 'Enter Username Name Here',
                'v-model'       => 'database.connectionsAAApgsqlAAAusername'
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Database Password
                @tooltip('Some Text Here.')
            </label>
            {!! form()->input('password', 'password', null, [
                'id'            => '',
                'class'         => 'form-control',
                'placeholder'   => 'Enter Password Here',
                'v-model'       => 'database.connectionsAAApgsqlAAApassword'
            ]) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label class="form-label-style block" for="title">Database Name
        @tooltip('Some Text Here.')
    </label>
    {!! form()->input('text', 'name', $configuration->key("database.connections.pgsql.database"), [
        'id'            => '',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Databas Name Here',
        'v-model'       => 'database.connectionsAAApgsqlAAAdatabase'
    ]) !!}
</div>

<div class="form-group">
    <label class="form-label-style block" for="title">Schema
        @tooltip('Some Text Here.')
    </label>
    {!! form()->input('text', 'name', $configuration->key("database.connections.pgsql.schema"), [
        'id'            => '',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Schema Name Here',
        'v-model'       => 'database.connectionsAAApgsqlAAAschema'
    ]) !!}
</div>