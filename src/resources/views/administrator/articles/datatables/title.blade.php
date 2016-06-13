<a href="{{ route('administrator.articles.edit', $article->id) }}">{{ $article->title }}</a>
<small>(Alias: {{ $article->alias }})</small>
<br>
<small>Category: {{ $article->category->title }}</small>