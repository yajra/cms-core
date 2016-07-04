<input type="hidden" v-model="session.config" value="session">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Default Driver
                @tooltip('This option controls the default session "driver" that will be used on requests. By default, we will use the lightweight native driver but you may specify any of the other wonderful drivers provided here.')
            </label>
            {!! form()->select('default', [
                    'file'          => 'File',
                    'cookie'        => 'Cookie',
                    'database'      => 'Database',
                    'apc'           => 'apc',
                    'memcached'     => 'Memcached',
                    'redis'         => 'Redis',
                    'array'         => 'array'
                ], $configuration->key("session.driver"),[
                    'class'     => 'form-control select2',
                    'id'        => 'default-session',
                    'v-model'   => 'session.driver',
                    'config'    => 'session.driver',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Lifetime
                @tooltip('Here you may specify the number of minutes that you wish the session to be allowed to remain idle before it expires. If you want them to immediately expire on the browser closing, set that option.')
            </label>
            {!! form()->input('text', 'lifetime', $configuration->key("session.lifetime"), [
                'class'         => 'form-control',
                'placeholder'   => 'Enter Session Lifetime Here',
                'v-model'       => 'session.lifetime'
            ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label-style block" for="title">Files
                @tooltip('When using the native session driver, we need a location where session files may be stored. A default has been set for you but a different location may be specified. This is only needed for file sessions.')
            </label>
            {!! form()->input('text', 'files', $configuration->key("session.files"), [
                'class'         => 'form-control',
                'placeholder'   => 'Enter Session Lifetime Here',
                'v-model'       => 'session.files'
            ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label-style block" for="title">Database Table
                @tooltip('When using the "database" session driver, you may specify the table we should use to manage the sessions. Of course, a sensible default is provided for you; however, you are free to change this as needed.')
            </label>
            {!! form()->input('text', 'table', $configuration->key("session.table"), [
                'class'         => 'form-control',
                'placeholder'   => 'Enter Session Lifetime Here',
                'v-model'       => 'session.table'
            ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label-style" for="debug">Expire On Close
                @tooltip('If you want them to immediately expire on the browser closing, set that TRUE.')
            </label>
            <br>
            {!! form()->checkbox('expiration_close', $value = 1, $checked = null, [
                'class'     => 'form-control bootstrap-checkbox']
            ) !!}
        </div>
    </div>
</div>