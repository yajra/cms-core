<div class="form-group">
    <label class="form-label-style block" for="title">Filesystem Disks
        @tooltip('Here you may configure as many filesystem "disks" as you wish, and you may even configure multiple disks of the same driver. Defaults have been setup for each driver as an example of the required options.')
    </label>
    {!! form()->input('text', 'local', $configuration->key("filesystems.disks.local.root"), [
        'class'         => 'form-control',
        'placeholder'   => 'Enter Local Directory Here',
        'v-model'       => 'filesystems.disks.local.root'
    ]) !!}
</div>