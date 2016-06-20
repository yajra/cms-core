<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="author_alias">
                {{trans('cms::article.field.author_alias')}}
                @tooltip('cms::article.tooltip.author_alias')
            </label>
            {!! form()->input('text','author_alias', null, ['id'=>'author_alias','class'=>'form-control','placeholder'=>trans('cms::article.field.author_alias_placeholder')]) !!}
        </div>
        <div class="form-group">
            <label class="form-label-style block" for="meta_description">
                {{trans('cms::article.field.meta_description')}}
                @tooltip('cms::article.tooltip.meta_description')
            </label>
            {!! form()->textarea('parameters[meta_description]', $article->param('meta_description'), ['placeholder' => trans('cms::article.field.meta_description_placeholder'), 'class' => 'form-control', 'rows' => 3, 'cols' => 3]) !!}
        </div>
        <div class="form-group">
            <label class="form-label-style block" for="meta_keywords">
                {{trans('cms::article.field.meta_keywords')}}
                @tooltip('cms::article.tooltip.meta_keywords')
            </label>
            {!! form()->textarea('parameters[meta_keywords]', $article->param('meta_keywords'), ['placeholder' => trans('cms::article.field.meta_keywords_placeholder'), 'class' => 'form-control', 'rows' => 3, 'cols' => 3]) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label-style block" for="key_reference">
                {{trans('cms::article.field.key_reference')}}
                @tooltip('cms::article.tooltip.key_reference')
            </label>
            {!! form()->text('parameters[key_reference]', $article->param('key_reference'), ['placeholder' => trans('cms::article.field.key_reference_placeholder'), 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label class="form-label-style block" for="content_rights">
                {{trans('cms::article.field.content_rights')}}
                @tooltip('cms::article.tooltip.content_rights')
            </label>
            {!! form()->textarea('parameters[content_rights]', $article->param('content_rights'), ['placeholder' => trans('cms::article.field.content_rights_placeholder'), 'class' => 'form-control', 'rows' => 3, 'cols' => 3]) !!}
        </div>
        <div class="form-group">
            <label class="form-label-style block" for="external_reference">
                {{trans('cms::article.field.external_reference')}}
                @tooltip('cms::article.tooltip.external_reference')
            </label>
            {!! form()->text('parameters[external_reference]', $article->param('external_reference'), ['placeholder' => trans('cms::article.field.external_reference'), 'class' => 'form-control']) !!}
        </div>
    </div>
</div>
