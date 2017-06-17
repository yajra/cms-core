<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.site.name')}}
        @tooltip('cms::config.site.name-info')
    </label>
    <input type="text" v-model="site.name" class="form-control">
</div>
<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.site.version')}}
        @tooltip('cms::config.site.version-info')
    </label>
    <input type="text" v-model="site.version" class="form-control">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.site.keywords')}}
                @tooltip('cms::config.site.keywords-info')
            </label>
            <input type="text" v-model="site.keywords" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                {{trans('cms::config.site.author')}}
                @tooltip('cms::config.site.author-info')
            </label>
            <input type="text" v-model="site.author" class="form-control">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.site.description')}}
        @tooltip('cms::config.site.description-info')
    </label>
    <textarea cols="30" rows="4" class="form-control" v-model="site.description"></textarea>
</div>
<div class="form-group">
    <label class="form-label-style block">
        {{trans('cms::config.site.color')}}
        @tooltip('cms::config.site.color-info')
    </label>
    <select v-model="site.admin_theme" class="form-control">
        <option value="blue">Blue</option>
        <option value="black">Black</option>
        <option value="green">Green</option>
        <option value="red">Red</option>
        <option value="purple">Purple</option>
        <option value="yellow">Yellow</option>
        <option value="blue-light">Blue Light</option>
        <option value="black-light">Black Light</option>
        <option value="green-light">Green Light</option>
        <option value="red-light">Red Light</option>
        <option value="purple-light">Purple Light</option>
        <option value="yellow-light">Yellow Light</option>
    </select>
</div>
