<input type="hidden" v-model="filesystems.config" value="filesystems">
<div class="form-group">
    <label class="form-label-style block" for="title">Default File System
        @tooltip('Here you may specify the default filesystem disk that should be used by the framework. A "local" driver, as well as a variety of cloud based drivers are available for your choosing. Just store away!')
    </label>
    {!! form()->select('filesystem', [
            'local'     => 'Local',
            'public'    => 'Public',
            's3'        => 'Cloud Filesystem Disk (S3)'],
        $configuration->key("filesystems.default"),[
            'class'     => 'form-control select2',
            'id'        => 'default-filesytem',
            'v-model'   => 'filesystems.default',
            'config'    => 'filesystems.default'
    ]) !!}
</div>
<div class="row">
    <div class="col-md-12">
        @foreach($configuration->key("filesystems.disks") as $type)
            <div class="@if($configuration->key("filesystems.default") == $type['location']) @else hide @endif filesystem-container"
                 id="{{$type['location']}}-filesystem-container">
                @include('administrator.configuration.partials.form.filesystems.'.$type['location'])
            </div>
        @endforeach
    </div>
</div>