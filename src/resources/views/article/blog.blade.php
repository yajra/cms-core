<h3 class="article-title">
    <a href="{{ url($article->alias) }}">{{ $article->title }}</a>
</h3>

<p>
    <small class="inline-help">Written by: {{ $article->present()->author }}</small>
    <br>
    <small class="inline-help">
        <i class="fa fa-calendar"></i> Published: {{ $article->present()->datePublished }}
    </small>
    <br>
    <small class="inline-help">
        <i class="fa fa-eye"></i> Hits: {{ $article->present()->hits }}
    </small>
</p>

<div class="article-content">
    {!! $article->present()->content !!}
</div>
