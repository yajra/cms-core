<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.filesystems.local.root')}}
        @tooltip('cms::config.filesystems.local.root-info')
    </label>
    <input type="text" v-model="filesystems.disks.local.root" class="form-control">
</div>
