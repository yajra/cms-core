<div class="form-group">
    <label class="form-label-style block">
        Site Name
        @tooltip('Site registered name.')
    </label>
    <input type="text" v-model="site.name" class="form-control">
</div>
<div class="form-group">
    <label class="form-label-style block">Version
        @tooltip('Site version number.')
    </label>
    <input type="text" v-model="site.version" class="form-control">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Keywords
                @tooltip('Default site meta keywords.')
            </label>
            <input type="text" v-model="site.keywords" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block">
                Author
                @tooltip('Default site meta author name.')
            </label>
            <input type="text" v-model="site.author" class="form-control">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label-style block">
        Site Description
        @tooltip('Default site meta description.')
    </label>
    <textarea cols="30" rows="4" class="form-control" v-model="site.description"></textarea>
</div>
<div class="form-group">
    <label class="form-label-style block">
        Administrator Template (AdminLTE Color Scheme)
        @tooltip('Administrator area AdminLTE color scheme.')
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
<div class="form-group">
    <label class="form-label-style">
        <input type="checkbox" v-model="site.registration" :checked="site.registration">
        Enable Registration
        @tooltip('Frontend registration flag. If set to true, registration will be allowed.')
    </label>
</div>
