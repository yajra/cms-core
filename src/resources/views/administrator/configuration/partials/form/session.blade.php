<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Default Driver
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
                ], config("session.driver"),[
                    'class'     => 'form-control',
                    'id'        => 'default-session',
                    'v-model'   => 'session.driver'
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Lifetime
                @tooltip('Here you may specify the number of minutes that you wish the session to be allowed to remain idle before it expires. If you want them to immediately expire on the browser closing, set that option.')
            </label>
            <input type="text" v-model="session.lifetime" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label-style block">
                Files
                @tooltip('When using the native session driver, we need a location where session files may be stored. A default has been set for you but a different location may be specified. This is only needed for file sessions.')
            </label>
            <input type="text" v-model="session.files" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label-style block">
                Database Table
                @tooltip('When using the "database" session driver, you may specify the table we should use to manage the sessions. Of course, a sensible default is provided for you; however, you are free to change this as needed.')
            </label>
            <input type="text" v-model="session.table" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label-style">
                <input type="checkbox" v-model="session.expire_on_close" :checked="session.expire_on_close">
                Expire On Close
                @tooltip('If you want them to immediately expire on the browser closing, set that TRUE.')
            </label>
        </div>
    </div>
</div>
