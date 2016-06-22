<div class="modal fade" tabindex="-1" role="dialog" id="new-asset-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" v-on:submit.prevent="submitNewAsset(this.newasset)">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        New Asset
                        <small>(Please fill up all required field.)</small>
                    </h4>
                </div>
                <div class="modal-body">
                    @include('administrator.configuration.partials.form.form-asset')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary text-bold">SAVE</button>
                    <button type="button" class="btn btn-warning text-bold" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="customize-asset-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    Site Assets
                    <small>(Please fill up all required field.)</small>
                </h4>
            </div>
            <div class="modal-body">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->