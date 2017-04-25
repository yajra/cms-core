@include('article.partials.header')

<div class="article-content">
    {!! $article->present()->content !!}
</div>

@foreach($article->tagged as $tag)
    <li class="label label-info"><a href="/tags/{{$tag->tag_slug}}">{{$tag->tag_name}}</a></li>
@endforeach

<hr>

<div id="disqus_thread"></div>
