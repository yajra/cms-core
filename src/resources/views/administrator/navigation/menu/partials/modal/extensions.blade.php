<div class="modal fade" tabindex="-1" role="dialog" id="menu-items-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Menu Extension</h4>
            </div>
            <div id="assets-body" class="modal-body">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($extensions as $extension)
                        <li>
                            <a @click="generateSelectedItem('{{$extension->id}}','{{$extension->name}}')"
                                href="javascript:void(0)">
                                <i class="fa fa-file-text-o"></i>
                                {{$extension->name}}
                                &nbsp; / &nbsp;
                                <small class="text-muted">
                                    {{ $extension->description }}
                                </small>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
