<a href="{{url($article->getUrl())}}"
   target="_blank"
   data-toggle="tooltip"
   title="Visit Page">
    <i class="fa fa-globe"></i>
</a>

<a href="{{ route('administrator.articles.edit', $article->id) }}">{{ $article->title }}</a>
<br>
<small>Slug: {{ $article->present()->slug }}</small>
