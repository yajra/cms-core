<div class="form-group">
    <label class="form-label-style block" for="title">Host
        @tooltip('Some Text Here.')
    </label>
    {!! form()->input('text', 'host', $configuration->key("database.connections.mysql.host"), [
        'id'            => '' ,
        'class'         => 'form-control',
        'placeholder'   => 'Enter Host Name Here',
        'v-model'       => 'database.connectionsAAAmysqlAAAhost'
    ]) !!}
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Database Username
                @tooltip('Some Text Here.')
            </label>
            {!! form()->input('text', 'username', $configuration->key("database.connections.mysql.username"), [
                'id'            => '',
                'class'         => 'form-control',
                'placeholder'   => 'Enter Username Name Here',
                'v-model'       => 'database.connectionsAAAmysqlAAAusername'
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Database Password
                @tooltip('Some Text Here.')
            </label>
            {!! form()->input('password', 'password', '', [
                'id'            => '',
                'class'         => 'form-control',
                'placeholder'   => 'Enter Password Here',
                'v-model'       => 'database.connectionsAAAmysqlAAApassword'
            ]) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label class="form-label-style block" for="title">Database Name
        @tooltip('Some Text Here.')
    </label>
    {!! form()->input('text', 'name', $configuration->key("database.connections.mysql.database"), [
        'id'            => '',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Database Name Here',
        'v-model'       => 'database.connectionsAAAmysqlAAAdatabase'
    ]) !!}
</div>