<div class="modal fade" tabindex="-1" role="dialog" id="articles-list-modal">
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Select or Change Article <small>(Click row to select the article.)</small></h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover" id="articles-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>CATEGORY</th>
                        <th><i class="fa fa-check-circle" data-toggle="tooltip" data-title="Published"></i></th>
                        <th><i class="fa fa-key" data-toggle="tooltip" data-title="Authentication Required"></i></th>
                        <th><i class="fa fa-list" data-toggle="tooltip" data-title="Sort/Order"></i></th>
                        <th>CREATED AT</th>
                        <th>UPDATED AT</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th><input class="form-control footer-text" style="width: 100%" placeholder="Search Id..." /></th>
                        <th><input class="form-control footer-text" style="width: 100%" placeholder="Search title..." /></th>
                        <th>{{ form()->categories('category_id', null, ['class' => 'form-control select2', 'style' => 'width: 100%']) }}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><input class="form-control footer-text" style="width: 100%" placeholder="Search date created..." /></th>
                        <th><input class="form-control footer-text" style="width: 100%" placeholder="Search date updated..." /></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->