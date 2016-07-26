<div class="row">
    <div class="col-md-6">
        <label class="form-label-style block" for="parameters[intro_image]">Intro Image</label>
        <div class="input-group input-group-sm">
            {!! form()->imageBrowser('parameters[intro_image]', $article->param('intro_image'),[
                'id'        => 'intro_image',
                'label'     => 'Select'
            ]) !!}
            {!! $errors->first('parameters[intro_image]', '<span class="help-block">:message</span>') !!}
        </div>
        <br>
        <div class="form-group {{ $errors->has('parameters[image_float]') ? 'has-error' : '' }}">
            <label class="form-label-style block" for="parameters[image_float]">
                {{trans('cms::article.form.field.image_float')}}
                @tooltip('cms::article.form.tooltip.image_float')
            </label>
            {!! form()->select('parameters[image_float]', ['Use Global','Right', 'Left','None'], $article->param('image_float', 0), ['id'=>'parameters[image_float]','class'=>'form-control']) !!}
            {!! $errors->first('parameters[image_float]', '<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-group">
            <label class="form-label-style block" for="img_intro_alt">
                {{trans('cms::article.form.field.img_intro_alt')}}
                @tooltip('cms::article.form.tooltip.img_intro_alt')
            </label>
            {!! form()->text('parameters[img_intro_alt]', $article->param('img_intro_alt'), ['placeholder' => trans('cms::article.form.field.img_intro_alt_placeholder'), 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label class="form-label-style block" for="url_a_text">
                {{trans('cms::article.form.field.image_intro_caption')}}
                @tooltip('cms::article.form.tooltip.image_intro_caption')
            </label>
            {!! form()->text('parameters[image_intro_caption]', $article->param('image_intro_caption'), ['placeholder' => trans('cms::article.form.field.image_intro_caption_placeholder'), 'class' => 'form-control']) !!}
        </div>
        <hr>
        <div class="input-group input-group-sm">
            {!! form()->imageBrowser('parameters[image_fulltext]',$article->param('image_fulltext'),[
                'id'        => 'image_fulltext',
                'label'     => 'Select'
            ]) !!}
            {!! $errors->first('parameters[intro_image]', '<span class="help-block">:message</span>') !!}
        </div>
        <br>
        <div class="form-group {{ $errors->has('parameters[image_float_fulltext]') ? 'has-error' : '' }}">
            <label class="form-label-style block" for="parameters[image_float_fulltext]">
                {{trans('cms::article.form.field.image_float_fulltext')}}
                @tooltip('cms::article.form.tooltip.image_float_fulltext')
            </label>
            {!! form()->select('parameters[image_float_fulltext]', ['Use Global','Right', 'Left','None'], $article->param('image_float_fulltext', 0), ['id'=>'parameters[image_float_fulltext]','class'=>'form-control']) !!}
            {!! $errors->first('parameters[image_float_fulltext]', '<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-group">
            <label class="form-label-style block" for="img_intro_alt_fulltext">
                {{trans('cms::article.form.field.img_intro_alt_fulltext')}}
                @tooltip('cms::article.form.tooltip.img_intro_alt_fulltext')
            </label>
            {!! form()->text('parameters[img_intro_alt_fulltext]', $article->param('img_intro_alt_fulltext'), ['placeholder' => trans('cms::article.form.field.img_intro_alt_fulltext_placeholder'), 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label class="form-label-style block" for="image_intro_caption_fulltext">
                {{trans('cms::article.form.field.image_intro_caption_fulltext')}}
                @tooltip('cms::article.form.tooltip.image_intro_caption_fulltext')
            </label>
            {!! form()->text('parameters[image_intro_caption_fulltext]', $article->param('image_intro_caption_fulltext'), ['placeholder' => trans('cms::article.form.field.image_intro_caption_fulltext_placeholder'), 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-5">
        <div class="link-a-container">
            <div class="form-group">
                <label class="form-label-style block" for="url_a">
                    {{trans('cms::article.form.field.url_a')}}
                    @tooltip('cms::article.form.tooltip.url_a')
                </label>
                {!! form()->text('parameters[url_a]', $article->param('url_a'), ['placeholder' => trans('cms::article.form.field.url_a_placeholder'), 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label class="form-label-style block" for="url_a_text">
                    {{trans('cms::article.form.field.url_a_text')}}
                    @tooltip('cms::article.form.tooltip.url_a_text')
                </label>
                {!! form()->text('parameters[url_a_text]', $article->param('url_a_text'), ['placeholder' => trans('cms::article.form.field.url_a_text_placeholder'), 'class' => 'form-control']) !!}
            </div>
            <div class="form-group {{ $errors->has('parameters[url_target_a]') ? 'has-error' : '' }}">
                <label class="form-label-style block" for="parameters[url_target_a]">
                    {{trans('cms::article.form.field.url_target_a')}}
                    @tooltip('cms::article.form.tooltip.url_target_a')
                </label>
                {!! form()->select('parameters[url_target_a]', ['Use Global','Open in parent window', 'Open in new window','Open in popup','Modal'], $article->param('url_target_a', 0), ['id'=>'parameters[url_target_a]','class'=>'form-control']) !!}
                {!! $errors->first('parameters[url_target_a]', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <hr>
        <div class="link-a-container">
            <div class="form-group">
                <label class="form-label-style block" for="url_b">
                    {{trans('cms::article.form.field.url_b')}}
                    @tooltip('cms::article.form.tooltip.url_b')
                </label>
                {!! form()->text('parameters[url_b]', $article->param('url_b'), ['placeholder' => trans('cms::article.form.field.url_b_placeholder'), 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label class="form-label-style block" for="url_b_text">
                    {{trans('cms::article.form.field.url_b_text')}}
                    @tooltip('cms::article.form.tooltip.url_b_text')
                </label>
                {!! form()->text('parameters[url_b_text]', $article->param('url_b_text'), ['placeholder' => trans('cms::article.form.field.url_b_text_placeholder'), 'class' => 'form-control']) !!}
            </div>
            <div class="form-group {{ $errors->has('parameters[url_target_b]') ? 'has-error' : '' }}">
                <label class="form-label-style block" for="parameters[url_target_b]">
                    {{trans('cms::article.form.field.url_target_b')}}
                    @tooltip('cms::article.form.tooltip.url_target_b')
                </label>
                {!! form()->select('parameters[url_target_b]', ['Use Global','Open in parent window', 'Open in new window','Open in popup','Modal'], $article->param('url_target_b', 0), ['id'=>'parameters[url_target_b]','class'=>'form-control']) !!}
                {!! $errors->first('parameters[url_target_b]', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <hr>
    </div>
</div>
