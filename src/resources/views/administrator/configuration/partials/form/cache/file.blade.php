<div class="form-group">
    <label class="form-label-style block">
        Path
        @tooltip('Local path you wish to store cache.')
    </label>
    {!! form()->input('text', 'file', config("cache.stores.file.path"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Path Here',
        'v-model'       => 'cache.stores.file.path'
    ]) !!}
</div>
