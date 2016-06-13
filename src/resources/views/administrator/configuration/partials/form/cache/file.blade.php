<div class="form-group">
    <label class="form-label-style block" for="title">Path
        @tooltip('')
    </label>
    {!! form()->input('text', 'file', $configuration->key("cache.stores.file.path"), [
        'id'            => 'cach_path',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Application URL Here',
        'v-model'       => 'cache.storesAAAfileAAApath'
    ]) !!}
</div>