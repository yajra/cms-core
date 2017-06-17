<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">
                {{trans('cms::config.app.name')}}
                @tooltip('cms::config.app.name-info')
            </label>
            <input type="text" v-model="app.name" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">
                {{trans('cms::config.app.env')}}
                @tooltip('cms::config.app.env-info')
            </label>
            <select class="form-control" v-model="app.env">
                <option value="local">Local</option>
                <option value="staging">Staging</option>
                <option value="production">Production</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">
                {{trans('cms::config.app.url')}}
                @tooltip('cms::config.app.url-info')
            </label>
            <input type="text" v-model="app.url" class="form-control">
        </div>
    </div>
</div>

<div class="row" style="margin-top: 10px">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label-style block" for="title">
                {{trans('cms::config.app.timezone')}}
                @tooltip('cms::config.app.timezone-info')
            </label>
            {!! form()->select('timezone',
                array_combine(DateTimeZone::listIdentifiers(DateTimeZone::ALL),DateTimeZone::listIdentifiers(DateTimeZone::ALL)),
                config("app.timezone"), [
                    'class'     => 'form-control',
                    'v-model'   => 'app.timezone'
            ]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label-style block" for="title">
                {{trans('cms::config.app.language')}}
                @tooltip('cms::config.app.language-info')
            </label>
            <select class="form-control" v-model="app.locale">
                <option value="en">English</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label-style block" for="title">
                {{trans('cms::config.app.log')}}
                @tooltip('cms::config.app.log-info')
            </label>
            <select v-model="app.log" class="form-control">
                <option value="single">Single</option>
                <option value="daily">Daily</option>
                <option value="syslog">System Log</option>
                <option value="errorlog">Error Log</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label class="form-label-style">
                <input type="checkbox" v-model="app.debug" :checked="app.debug">
                {{trans('cms::config.app.debug')}}
                @tooltip('cms::config.app.debug-info')
            </label>
        </div>
        <div class="form-group">
            <label class="form-label-style">
                <input type="checkbox" v-model="app.debugbar" :checked="app.debugbar">
                {{trans('cms::config.app.debugbar')}}
                @tooltip('cms::config.app.debugbar-info')
            </label>
        </div>
    </div>
</div>
