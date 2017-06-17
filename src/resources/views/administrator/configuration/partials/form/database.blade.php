<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label-style block" for="title">
                {{trans('cms::config.database.default')}}
                @tooltip('cms::config.database.default-info')
            </label>
            <select v-model="database.default" class="form-control">
                <option value="sqlite">sqlite</option>
                <option value="mysql">mysql</option>
                <option value="pgsql">pgsql</option>
                <option value="oracle">oracle</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="@if(config("database.default") == 'mysql') @else hide @endif db-container"
             id="mysql-db-container">
            @include('administrator.configuration.partials.form.databases.mysql')
        </div>
        <div class="@if(config("database.default") == 'oracle') @else hide @endif db-container"
             id="oracle-db-container">
            @include('administrator.configuration.partials.form.databases.oracle')
        </div>
        <div class="@if(config("database.default") == 'pgsql') @else hide @endif db-container"
             id="pgsql-db-container">
            @include('administrator.configuration.partials.form.databases.pgsql')
        </div>
        <div class="@if(config("database.default") == 'sqlite') @else hide @endif db-container"
             id="sqlite-db-container">
            @include('administrator.configuration.partials.form.databases.sqlite')
        </div>
    </div>
</div>
