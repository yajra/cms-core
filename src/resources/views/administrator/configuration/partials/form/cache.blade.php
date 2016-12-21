<div class="form-group">
    <label class="form-label-style block">
        Default Cache Store
        @tooltip('This option controls the default cache connection that gets used while using this caching library. This connection is used when another is not explicitly specified when executing a given caching function.')
    </label>
    {!! form()->select('default',
        array_combine(
            array_keys(config("cache.stores")),array_keys(config("cache.stores"))
        ),
        config("cache.default"), [
            'class'     => 'form-control ',
            'id'        => 'default-cache',
            'v-model'   => 'cache.default'
    ]) !!}
</div>

<div class="row">
    <div class="col-md-12">
        @foreach(config("cache.stores") as $cache)
            <div class="@if(config("cache.default") == $cache['driver']) @else hide @endif cache-container"
                 id="{{$cache['driver']}}-cache-container">
                @include('administrator.configuration.partials.form.cache.'.$cache['driver'])
            </div>
        @endforeach
    </div>
</div>
