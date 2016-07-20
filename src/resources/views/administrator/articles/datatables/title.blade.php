<a href="{{ route('administrator.articles.edit', $article->id) }}">{{ $article->title }}</a>
<br>
<small>Alias: {{ $article->alias }}</small>
<br>
<small>Category: {{ $article->category->present()->slugList }}</small>
