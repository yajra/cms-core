<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Type
                @tooltip('Some text here.')
            </label>
            {!! form()->select('type',
                ['css' => 'CSS', 'js' => 'Javascript'],
                'css',[
                    'class'     => 'form-control select2',
                    'id'        => 'asset-type',
                    'v-model'   => 'newasset.type',
                    'config'    => 'newasset.type'
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Category
                @tooltip('Some text here.')
            </label>
            {!! form()->select('type',
                ['cdn' => 'CDN', 'local' => 'Local'],
                'cdn',[
                    'class'     => 'form-control select2',
                    'id'        => 'asset-category',
                    'v-model'   => 'newasset.category',
                    'config'    => 'newasset.category'
            ]) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label class="form-label-style block" for="title">Name
        @tooltip('Some text here.')
    </label>
    {!! form()->input('text', 'name', null,[
            'v-model'       => 'newasset.name',
            'class'         => 'form-control',
            'placeholder'   => 'Enter Asset Name Here',
        ]) !!}
</div>

<div class="form-group">
    <label id="asset-url-label" class="form-label-style inline-block" for="title">URL</label>
    @tooltip('Some text here.')

    {!! form()->input('text', 'url', null,[
            'v-model'       => 'newasset.url',
            'class'         => 'form-control',
            'placeholder'   => 'Enter URL Here',
        ]) !!}
</div>
