<input type="hidden" v-model="site.config" value="site">
<div class="form-group">
    <label class="form-label-style block" for="title">Site Name
        @tooltip('Site registered name.')
    </label>
    {!! form()->input('text', 'name', $configuration->key("site.name"),[
            'v-model'       => 'site.name',
            'class'         => 'form-control',
            'placeholder'   => 'Enter Site Name Here',
    ]) !!}
</div>

<div class="form-group">
    <label class="form-label-style block" for="title">Version
        @tooltip('Site version number.')
    </label>
    {!! form()->input('text', 'version', $configuration->key("site.version"),[
            'v-model'       => 'site.version',
            'class'         => 'form-control',
            'placeholder'   => 'Enter Version Here',
        ]) !!}
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Keywords
                @tooltip('Default site meta keywords.')
            </label>
            {!! form()->input('text', 'keywords', $configuration->key("site.keywords"),[
                    'v-model'       => 'site.keywords',
                    'class'         => 'form-control',
                    'placeholder'   => 'Enter Keywords Here',
                ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="title">Author
                @tooltip('Default site meta author name.')
            </label>
            {!! form()->input('text', 'author', $configuration->key("site.author"),[
                    'v-model'       => 'site.author',
                    'class'         => 'form-control',
                    'placeholder'   => 'Enter Author Name Here',
                ]) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label class="form-label-style block" for="title">Site Description
        @tooltip('Default site meta description.')
    </label>
    {!! form()->textarea('description', $configuration->key("site.description"),[
            'v-model'       => 'site.description',
            'class'         => 'form-control',
            'placeholder'   => 'Enter Site Description Here',
            'rows'          => '4',
        ]) !!}
</div>

<div class="form-group">
    <label class="form-label-style block" for="title">Administrator Template (AdminLTE Color Scheme)
        @tooltip('Administrator area AdminLTE color scheme.')
    </label>
    {!! form()->select('admin_theme', [
                    'blue'   => 'Blue',
                    'black'  => 'Black',
                    'green'  => 'Green',
                    'red'    => 'Red',
                    'purple' => 'Purple',
                    'yellow' => 'Yellow',
                    'blue-light'   => 'Blue - Light',
                    'black-light'  => 'Black - Light',
                    'green-light'  => 'Green - Light',
                    'red-light'    => 'Red - Light',
                    'purple-light' => 'Purple - Light',
                    'yellow-light' => 'Yellow - Light',
                ],
                $configuration->key("site.admin_theme"),[
                    'v-model'   => 'site.admin_theme',
                    'class'     => 'form-control select2',
                    'config'    => 'site.admin_theme',
                ])
    !!}
</div>

<div class="form-group">
    <label class="form-label-style" for="registration">Enable Registration
        @tooltip('Frontend registration flag. If set to true, registration will be allowed.')
    </label>
    <br>
    {!! form()->checkbox('registration', $value = false, $checked = null, [
        'v-model'   =>'registration',
        'class'     =>'form-control bootstrap-checkbox',
    ]) !!}
</div>
