<div class="form-group">
    <label class="form-label-style block" for="title">Database Name
        @tooltip('Some Text Here.')
    </label>
    {!! form()->input('text', 'author', $configuration->key("database.connections.sqlite.database"), [
        'id'            => 'site_author',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Database Name Here',
        'v-model'       => 'database.connectionsAAAsqliteAAAdatabase'
    ]) !!}
</div>