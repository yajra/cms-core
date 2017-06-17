<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.filesystems.s3.key')}}
        @tooltip('cms::config.filesystems.s3.key-info')
    </label>
    <input type="text" v-model="filesystems.disks.s3.key" class="form-control">
</div>
<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.filesystems.s3.secret')}}
        @tooltip('cms::config.filesystems.s3.secret-info')
    </label>
    <input type="text" v-model="filesystems.disks.s3.secret" class="form-control">
</div>
<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.filesystems.s3.region')}}
        @tooltip('cms::config.filesystems.s3.region-info')
    </label>
    <input type="text" v-model="filesystems.disks.s3.region" class="form-control">
</div>
<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.filesystems.s3.bucket')}}
        @tooltip('cms::config.filesystems.s3.bucket-info')
    </label>
    <input type="text" v-model="filesystems.disks.s3.bucket" class="form-control">
</div>
