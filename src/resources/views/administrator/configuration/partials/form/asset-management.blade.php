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
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#css" data-toggle="tab">
                        <span class="label label-success">CSS</span>
                    </a></li>
                <li><a href="#javascript" data-toggle="tab" @click="showJsAssets()">
                    <span class="label label-warning">Javascript</span>
                    </a></li>
                <li class="pull-right">
                    <button @click="showModal('new-asset-modal')" type="button" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;New Asset</button>
                    <button @click="showModal('customize-asset-modal')" type="button" class="btn btn-danger"><i class="fa fa-cog"></i>&nbsp;Manage Site Assets</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="css">
                    <table class="table table-hover" id="css-assets-table" style="margin-top: 3px !important;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>URL</th>
                        </tr>
                        </thead>
                    </table>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="javascript">
                    <table class="table table-hover" id="js-assets-table" style="margin-top: 3px !important;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>URL</th>
                        </tr>
                        </thead>
                    </table>
                </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
        </div>
    </div>
</div>

@include('administrator.configuration.modal.new-asset')


