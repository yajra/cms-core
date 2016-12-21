<div class="form-group">
    <label class="form-label-style block">
        Filesystem Disks
        @tooltip('Here you may configure as many filesystem "disks" as you wish, and you may even configure multiple disks of the same driver. Defaults have been setup for each driver as an example of the required options.')
    </label>
    <input type="text" v-model="filesystems.disks.public.root" class="form-control">
</div>
<div class="form-group">
    <label class="form-label-style block">
        Visibility
        @tooltip('File system visibility.')
    </label>
    <input type="text" v-model="filesystems.disks.public.visibility" class="form-control">
</div>
