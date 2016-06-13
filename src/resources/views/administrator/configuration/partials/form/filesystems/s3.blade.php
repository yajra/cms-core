<div class="form-group">
    <label class="form-label-style block" for="title">Key
        @tooltip('')
    </label>
    {!! form()->input('text', 'key', $configuration->key("filesystems.disks.s3.key"), [
        'id'            => 'app_key',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Key Here',
        'v-model'       => 'filesystems.disksAAAs3AAAkey'
    ]) !!}
</div>

<div class="form-group">
    <label class="form-label-style block" for="title">Secret
        @tooltip('')
    </label>
    {!! form()->input('text', 'secret', $configuration->key("filesystems.disks.s3.secret"), [
        'id'            => 'app_secret',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Secret Here',
        'v-model'       => 'filesystems.disksAAAs3AAAsecret'
    ]) !!}
</div>

<div class="form-group">
    <label class="form-label-style block" for="title">Region
        @tooltip('')
    </label>
    {!! form()->input('text', 'region', $configuration->key("filesystems.disks.s3.region"), [
        'id'            => 'app_region',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Region Here',
        'v-model'       => 'filesystems.disksAAAs3AAAregion'
    ]) !!}
</div>

<div class="form-group">
    <label class="form-label-style block" for="title">Bucket
        @tooltip('')
    </label>
    {!! form()->input('text', 'bucket', $configuration->key("filesystems.disks.s3.bucket"), [
        'id'            => 'app_bucket',
        'class'         => 'form-control',
        'placeholder'   =>' Enter Region Here',
        'v-model'       => 'filesystems.disksAAAs3AAAbucket'
    ]) !!}
</div>