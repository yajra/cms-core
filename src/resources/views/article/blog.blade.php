@if($article->param('show_title'))
<h3 class="article-title">
    <a href="{{ url($article->alias) }}">{{ $article->present()->title }}</a>
</h3>
@endif

<div class="article-details">
    @if($article->param('show_author'))
    <small class="inline-help">Written by: {{ $article->present()->author }}</small>
    <br>
    @endif

    @if($article->param('show_create_date'))
    <small class="inline-help">
        <i class="fa fa-calendar"></i> Published: {{ $article->present()->datePublished }}
    </small>
    <br>
    @endif

    @if($article->param('show_modify_date'))
    <small class="inline-help">
        <i class="fa fa-calendar"></i> Modified: {{ $article->present()->dateModified }}
    </small>
    <br>
    @endif

    @if($article->param('show_hits'))
    <small class="inline-help">
        <i class="fa fa-eye"></i> Hits: {{ $article->present()->hits }}
    </small>
    @endif
</div>

<div class="article-content">
    {!! $article->present()->content !!}
</div>
