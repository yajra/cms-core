<input type="hidden" v-model="cache.config" value="cache">
<div class="form-group">
    <label class="form-label-style block" for="title">Default Cache Store
        @tooltip('This option controls the default cache connection that gets used while using this caching library. This connection is used when another is not explicitly specified when executing a given caching function.')
    </label>
    {!! form()->select('default',
        array_combine(
            array_keys($configuration->key("cache.stores")),array_keys($configuration->key("cache.stores"))
        ),
        $configuration->key("cache.default"),[
            'class'     => 'form-control select2',
            'id'        => 'default-cache',
            'v-model'   => 'cache.default',
            'config'    => 'cache.default'
    ]) !!}
</div>
<div class="row">
    <div class="col-md-12">
        @foreach($configuration->key("cache.stores") as $cache)
            <div class="@if($configuration->key("cache.default") == $cache['driver']) @else hide @endif cache-container"
                 id="{{$cache['driver']}}-cache-container">
                @include('administrator.configuration.partials.form.cache.'.$cache['driver'])
            </div>
        @endforeach
    </div>
</div>