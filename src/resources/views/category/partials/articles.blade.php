<section class="category-article">
    @include('article.partials.header', ['article' => $article])

    @if($article->present()->introText)
        <div class="article-intro">
            {!! $article->present()->introText !!}
            <a href="{{$article->getUrl()}}">Read More</a>
        </div>
    @endif
</section>
<hr>
