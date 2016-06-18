<input type="hidden" v-model="asset.config" value="asset">
<div class="form-group">
    <label class="form-label-style block" for="title">Default Asset
        @tooltip('Some text here.')
    </label>
    {!! form()->select('default',
        ['local' => 'Local', 'cdn' => 'CDN'],
        $configuration->key("asset.default"),[
            'class'     => 'form-control select2',
            'id'        => 'default-asset',
            'v-model'   => 'asset.default',
            'config'    => 'asset.default'
    ]) !!}
</div>


<div class="row">
    <div class="col-md-12">

    </div>
</div>