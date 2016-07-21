@if($article->param('show_title'))
    <h3 class="article-title">
        <a href="{{ $article->getUrl() }}">{{ $article->present()->title }}</a>
    </h3>
@endif

<div class="article-details">
    @if($article->param('show_author'))
        <p class="article-author">Written by: {{ $article->present()->author }}</p>
    @endif

    @if($article->param('show_create_date'))
        <p class="article-created">
            <i class="fa fa-calendar"></i> Published: {{ $article->present()->datePublished }}
        </p>
    @endif

    @if($article->param('show_modify_date'))
        <p class="article-modified">
            <i class="fa fa-calendar"></i> Modified: {{ $article->present()->dateModified }}
        </p>
    @endif

    @if($article->param('show_hits'))
        <p class="article-hits">
            <i class="fa fa-eye"></i> Hits: {{ $article->present()->hits }}
        </p>
    @endif
</div>

<div class="article-content">
    {!! $article->present()->content !!}
</div>

<hr>

<div id="disqus_thread"></div>
