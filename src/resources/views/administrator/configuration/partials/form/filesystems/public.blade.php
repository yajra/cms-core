<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.filesystems.public.root')}}
        @tooltip('cms::config.filesystems.public.root-info')
    </label>
    <input type="text" v-model="filesystems.disks.public.root" class="form-control">
</div>
<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.filesystems.public.visibility')}}
        @tooltip('cms::config.filesystems.public.visibility-info')
    </label>
    <input type="text" v-model="filesystems.disks.public.visibility" class="form-control">
</div>
