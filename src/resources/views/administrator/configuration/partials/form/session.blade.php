<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.session.driver')}}
                @tooltip('cms::config.session.driver-info')
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
                {{trans('cms::config.session.lifetime')}}
                @tooltip('cms::config.session.lifetime-info')
            </label>
            <input type="text" v-model="session.lifetime" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.session.files')}}
                @tooltip('cms::config.session.files-info')
            </label>
            <input type="text" v-model="session.files" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.session.table')}}
                @tooltip('cms::config.session.table-info')
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
                {{trans('cms::config.session.expire_on_close')}}
                @tooltip('cms::config.session.expire_on_close-info')
            </label>
        </div>
    </div>
</div>
