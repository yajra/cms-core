<input type="hidden" v-model="app.config" value="app">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Environment
                @tooltip('This value determines the "environment" your application is currently running in. This may determine how you prefer to configure various services your application utilizes. Set this in your ".env" file.')
            </label>
            {!! form()->select('env', [
                    'production'    => 'Production',
                    'local'         => 'Development'
                ],
                $configuration->key("app.env"),[
                    'v-model'   => 'app.env',
                    'class'     => 'form-control select2',
                    'config'    => 'app.env',
                ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Application URL
                @tooltip('This URL is used by the console to properly generate URLs when using the Artisan command line tool. You should set this to the root of your application so that it is used when running Artisan tasks.')
            </label>
            {!! form()->input('text', 'url', $configuration->key("app.url"), [
                'id'            => 'app_url',
                'class'         => 'form-control',
                'placeholder'   => 'Enter Application URL Here',
                'v-model'       => 'app.url',
            ]) !!}
        </div>
    </div>
</div>

<div class="row" style="margin-top: 10px">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label-style block" for="title">Timezone
                @tooltip('Here you may specify the default timezone for your application, which will be used by the PHP date and date-time functions. We have gone ahead and set this to a sensible default for you out of the box.')
            </label>
            {!! form()->select('timezone',
                array_combine(DateTimeZone::listIdentifiers(DateTimeZone::ALL),DateTimeZone::listIdentifiers(DateTimeZone::ALL)),
                $configuration->key("app.timezone"),[
                    'class'     => 'form-control select2',
                    'v-model'   => 'app.timezone',
                    'config'    => 'app.timezone',
            ]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label-style block" for="title">Language
                @tooltip('The application locale determines the default locale that will be used by the translation service provider. You are free to set this value to any of the locales which will be supported by the application.')
            </label>
            {!! form()->select('locale', [
                    'en' => 'English'
                ], $configuration->key("app.locale"),[
                    'class'     => 'form-control select2',
                    'v-model'   => 'app.locale',
                    'config'    => 'app.locale',
            ]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label-style block" for="title">Logging Configuration
                @tooltip('Here you may configure the log settings for your application. Out of the box, Laravel uses the Monolog PHP logging library. This gives you a variety of powerful log handlers / formatters to utilize.')
            </label>
            {!! form()->select('log', [
                'single'    => 'Single',
                'daily'     => 'Daily',
                'syslog'    => 'System Log',
                'errorlog'  => 'Error Log'],
                $configuration->key("app.log"),[
                    'class'     => 'form-control select2',
                    'v-model'   => 'app.log',
                    'config'    => 'app.log',
            ]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label-style" for="debug">Application Debug Mode
                @tooltip('When your application is in debug mode, detailed error messages with stack traces will be shown on every error that occurs within your application. If disabled, a simple generic error page is shown.')
            </label>
            <br>
            {!! form()->checkbox('debug', $value = $configuration->key("app.debug"), $checked = ($configuration->key("app.debug") == 1) ? true : false, [
                'id'        => 'app_debug',
                'class'     => 'form-control bootstrap-checkbox',
            ]) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label-style" for="debug">Display Debug Bar
                @tooltip('When your application is in debug mode and debugbar is set to true, DEBUGBAR component will be shown on every pages of the site.')
            </label>
            <br>
            {!! form()->checkbox('debug', $value = 1, $checked = ($configuration->key("app.debugbar") == null || $configuration->key("app.debugbar") == 0) ? false : true, [
                'id'        => 'app_debugbar',
                'class'     => 'form-control bootstrap-checkbox',
            ]) !!}
        </div>
    </div>
</div>
<input type="hidden" v-model="app.debug" value="{{ $configuration->key("app.debug") }}">
<input type="hidden" v-model="app.debugbar" value="{{ ($configuration->key("app.debugbar") == null || $configuration->key("app.debugbar") == 0) ? 0 : 1 }}">