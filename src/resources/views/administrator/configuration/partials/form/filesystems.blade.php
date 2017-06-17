<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.filesystems.default')}}
        @tooltip('cms::config.filesystems.default-info')
    </label>
    <select class="form-control" id="default-filesytem" v-model="filesystems.default">
        <option value="local">Local</option>
        <option value="public">Public</option>
        <option value="s3">Cloud Filesystem Disk (S3)</option>
    </select>
</div>
<div class="row">
    <div class="col-md-12">
        @foreach(config("filesystems.disks") as $key => $type)
            <div class="@if(config("filesystems.default") == $key) @else hide @endif filesystem-container"
                 id="{{$key}}-filesystem-container">
                @include('administrator.configuration.partials.form.filesystems.'.$key)
            </div>
        @endforeach
    </div>
</div>
