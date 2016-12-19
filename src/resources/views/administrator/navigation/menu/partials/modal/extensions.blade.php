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
                    <li v-for="extension in extensions">
                        <a v-on:click="setExtension(extension)">
                            <span v-text="extension.name"></span> / <small v-text="extension.manifest.description"></small>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
