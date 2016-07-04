<div class="form-group">
    <label class="form-label-style block" for="title">Key
        @tooltip('S3 key.')
    </label>
    {!! form()->input('text', 'key', $configuration->key("filesystems.disks.s3.key"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Key Here',
        'v-model'       => 'filesystems.disksAAAs3AAAkey'
    ]) !!}
</div>
<div class="form-group">
    <label class="form-label-style block" for="title">Secret
        @tooltip('S3 secret key.')
    </label>
    {!! form()->input('text', 'secret', $configuration->key("filesystems.disks.s3.secret"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Secret Here',
        'v-model'       => 'filesystems.disksAAAs3AAAsecret'
    ]) !!}
</div>
<div class="form-group">
    <label class="form-label-style block" for="title">Region
        @tooltip('S3 region.')
    </label>
    {!! form()->input('text', 'region', $configuration->key("filesystems.disks.s3.region"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Region Here',
        'v-model'       => 'filesystems.disksAAAs3AAAregion'
    ]) !!}
</div>
<div class="form-group">
    <label class="form-label-style block" for="title">Bucket
        @tooltip('S3 bucket.')
    </label>
    {!! form()->input('text', 'bucket', $configuration->key("filesystems.disks.s3.bucket"), [
        'class'         => 'form-control',
        'placeholder'   =>' Enter Region Here',
        'v-model'       => 'filesystems.disksAAAs3AAAbucket'
    ]) !!}
</div>