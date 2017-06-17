<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">
                Application Name
                @tooltip('This is your registered application name.')
            </label>
            <input type="text" v-model="app.name" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">
                Environment
                @tooltip('This value determines the "environment" your application is currently running in. This may determine how you prefer to configure various services your application utilizes. Set this in your ".env" file.')
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
                Application URL
                @tooltip('This URL is used by the console to properly generate URLs when using the Artisan command line tool. You should set this to the root of your application so that it is used when running Artisan tasks.')
            </label>
            <input type="text" v-model="app.url" class="form-control">
        </div>
    </div>
</div>

<div class="row" style="margin-top: 10px">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label-style block" for="title">
                Timezone
                @tooltip('Here you may specify the default timezone for your application, which will be used by the PHP date and date-time functions. We have gone ahead and set this to a sensible default for you out of the box.')
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
                Language
                @tooltip('The application locale determines the default locale that will be used by the translation service provider. You are free to set this value to any of the locales which will be supported by the application.')
            </label>
            <select class="form-control" v-model="app.locale">
                <option value="en">English</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label-style block" for="title">
                Logging Configuration
                @tooltip('Here you may configure the log settings for your application. Out of the box, Laravel uses the Monolog PHP logging library. This gives you a variety of powerful log handlers / formatters to utilize.')
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
                Application Debug Mode
                @tooltip('When your application is in debug mode, detailed error messages with stack traces will be shown on every error that occurs within your application. If disabled, a simple generic error page is shown.')
            </label>
        </div>
        <div class="form-group">
            <label class="form-label-style">
                <input type="checkbox" v-model="app.debugbar" :checked="app.debugbar">
                Display Debug Bar
                @tooltip('When your application is in debug mode and debugbar is set to true, DEBUGBAR component will be shown on every pages of the site.')
            </label>
        </div>
    </div>
</div>
