@include('article.partials.header')

<div class="article-content">
    {!! $article->present()->content !!}
</div>

<hr>

<div id="disqus_thread"></div>
