<input type="hidden" v-model="asset.config" value="asset">
<div class="form-group">
    <label class="form-label-style block" for="title">Default
        @tooltip('Some text here.')
    </label>
    {!! form()->select('default',
        ['local' => 'Local', 'cdn' => 'CDN'],
        $configuration->key("asset.default"),[
            'class'     => 'form-control select2',
            'id'        => 'default-asset',
            'v-model'   => 'asset.default',
            'config'    => 'asset.default',
    ]) !!}
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="pull-right">
            <button @click="showModal('new-asset-modal')" type="button" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;New Asset</button>
            <button @click="showModal('customize-asset-modal')" type="button" class="btn btn-danger"><i class="fa fa-cog"></i>&nbsp;Manage Site Assets</button>
        </div>
        <table class="table table-hover" id="css-assets-table" style="margin-top: 3px !important;">
            <thead>
            <tr>
                <th>Name</th>
                <th>TYPE</th>
                <th>URL</th>
                <th>ACTION</th>
            </tr>
            </thead>
        </table>
    </div>
</div>