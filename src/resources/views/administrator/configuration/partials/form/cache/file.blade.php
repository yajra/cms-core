<div class="form-group">
    <label class="form-label-style block" for="title">Path
        @tooltip('Local path you wish to store cache.')
    </label>
    {!! form()->input('text', 'file', $configuration->key("cache.stores.file.path"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Path Here',
        'v-model'       => 'cache.storesAAAfileAAApath'
    ]) !!}
</div>