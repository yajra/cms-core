<a href="{{url($article->getUrl())}}"
   target="_blank"
   data-toggle="tooltip"
   title="Visit Page"
   class="btn btn-primary btn-xs"
>
    <i class="fa fa-link"></i>
</a>
<a href="{{ route('administrator.articles.edit', $article->id) }}">{{ $article->title }}</a>
<br>
<small>{{ $article->present()->slug }}</small>
