<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Type
                @tooltip('Asset type.')
            </label>
            {!! form()->select('type',
                ['css' => 'CSS', 'js' => 'Javascript'],
                'css',[
                    'class'     => 'form-control select2',
                    'id'        => 'edit-asset-type',
                    'v-model'   => 'editasset.type',
                    'config'    => 'editasset.type'
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Category
                @tooltip('Asset category.')
            </label>
            {!! form()->select('type',
                ['cdn' => 'CDN', 'local' => 'Local'],
                'cdn',[
                    'class'     => 'form-control select2',
                    'id'        => 'edit-asset-category',
                    'v-model'   => 'editasset.category',
                    'config'    => 'editasset.category'
            ]) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block" for="title">Name
        @tooltip('Asset name.')
    </label>
    {!! form()->input('text', 'name', null,[
            'v-model'       => 'editasset.name',
            'class'         => 'form-control',
            'id'            => 'edit-asset-name',
            'placeholder'   => 'Enter Asset Name Here',
        ]) !!}
</div>
<div class="form-group">
    <label id="edit-asset-url-label" class="form-label-style inline-block" for="title">URL</label>
    @tooltip('Asset source file.')
    {!! form()->input('text', 'url', null,[
        'v-model'       => 'editasset.url',
        'class'         => 'form-control',
        'id'            => 'edit-asset-url',
        'placeholder'   => 'Enter URL Here',
    ]) !!}
</div>