<div class="row">
    <div class="col-md-6">
        <image-browser name="parameters[intro_image]" value="{{$article->param('intro_image')}}">Intro Image</image-browser>
        @error('parameters[intro_image]')
        <br>
        <div class="form-group">
            <label class="form-label-style block" for="intro_image_alt">
                {{trans('cms::article.form.field.intro_image_alt')}}
                @tooltip('cms::article.form.tooltip.intro_image_alt')
            </label>
            {!! form()->text('parameters[intro_image_alt]', $article->param('intro_image_alt'), ['placeholder' => trans('cms::article.form.field.intro_image_alt_placeholder'), 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <image-browser name="parameters[image]" value="{{$article->param('image')}}">Article Image</image-browser>
            @error('parameters[image]')
        </div>
        <br>
        <div class="form-group">
            <label class="form-label-style block" for="image_alt">
                {{trans('cms::article.form.field.image_alt')}}
                @tooltip('cms::article.form.tooltip.image_alt')
            </label>
            {!! form()->text('parameters[image_alt]', $article->param('image_alt'), ['placeholder' => trans('cms::article.form.field.image_alt_placeholder'), 'class' => 'form-control']) !!}
        </div>
    </div>
</div>
