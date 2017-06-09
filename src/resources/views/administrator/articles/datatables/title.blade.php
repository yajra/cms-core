<a href="{{ route('administrator.articles.edit', $article->id) }}"
   data-toggle="tooltip"
   data-title="{{trans('cms::button.edit')}}"
>{{ $article->title }}</a>
<br>
<small>
    (Alias:
    <a href="{{url($article->getUrl())}}"
       target="_blank"
       class="text-orange"
       data-toggle="tooltip"
       data-title="{{trans('cms::button.preview')}}"
    >
        {{ $article->present()->slug }}
    </a>
    )
</small>
