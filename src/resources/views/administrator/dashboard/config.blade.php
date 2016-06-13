<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title text-uppercase"><i class="fa fa-cogs"></i> Server Configurations</h3>
    </div>
    <div class="box-body">
        <ul class="list-group">
            <li class="list-group-item"><i class="fa fa-home"></i> Site Configuration</li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-8">
                        Name: {{ config('site.name') }}
                    </div>
                    <div class="col-md-4">
                        Version: {{ config('site.version') }}
                    </div>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item">
                <i class="fa fa-database"></i> <span class="label label-danger text-uppercase">{{ config('database.default') }}</span> Database Configuration
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-6">
                        Driver: {{ config('database.connections.' . config('database.default') . '.driver') }}
                    </div>
                    <div class="col-md-6">
                        Database: {{ config('database.connections.' . config('database.default') . '.database') }}
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-6">
                        Username: {{ config('database.connections.' . config('database.default') . '.username') }}
                    </div>
                    <div class="col-md-6">
                        Password: {{ substr(config('database.connections.' . config('database.default') . '.password'), 0, 1) }}
                        ****
                        {{ substr(config('database.connections.' . config('database.default') . '.password'), strlen(config('database.connections.' . config('database.default') . '.password')) - 1, 1) }}
                    </div>
                </div>
        </ul>
    </div>
</div>