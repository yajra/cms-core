<div class="form-group">
    <label class="form-label-style block" for="title">Filesystem Disks
        @tooltip('Here you may configure as many filesystem "disks" as you wish, and you may even configure multiple disks of the same driver. Defaults have been setup for each driver as an example of the required options.')
    </label>
    {!! form()->input('text', 'public', $configuration->key("filesystems.disks.public.root"), [
        'id'            => 'app_public',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Public Directory Here',
        'v-model'       => 'filesystems.disksAAApublicAAAroot'
    ]) !!}
</div>
<div class="form-group">
    <label class="form-label-style block" for="title">Visibility
        @tooltip('File system visibility.')
    </label>
    {!! form()->input('text', 'visibility', $configuration->key("filesystems.disks.public.visibility"), [
        'id'            => 'app_visibility',
        'class'         => 'form-control',
        'placeholder'   => 'Enter Visibility Here','disabled',
        'v-model'       => 'filesystems.disksAAApublicAAAvisibility'
    ]) !!}
</div>