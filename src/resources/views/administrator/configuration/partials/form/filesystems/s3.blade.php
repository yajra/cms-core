<div class="form-group">
    <label class="form-label-style block">
        Key
        @tooltip('S3 key.')
    </label>
    <input type="text" v-model="filesystems.disks.s3.key" class="form-control">
</div>
<div class="form-group">
    <label class="form-label-style block">
        Secret
        @tooltip('S3 secret key.')
    </label>
    <input type="text" v-model="filesystems.disks.s3.secret" class="form-control">
</div>
<div class="form-group">
    <label class="form-label-style block">
        Region
        @tooltip('S3 region.')
    </label>
    <input type="text" v-model="filesystems.disks.s3.region" class="form-control">
</div>
<div class="form-group">
    <label class="form-label-style block">
        Bucket
        @tooltip('S3 bucket.')
    </label>
    <input type="text" v-model="filesystems.disks.s3.bucket" class="form-control">
</div>
