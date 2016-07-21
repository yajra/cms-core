@extends('layouts.' . $template)

@section('body', '')

@push('styles')
@endpush

@section('keywords', $article->param('meta_keywords') ?? config('site.keywords'))
@section('description', $article->param('meta_description') ?? config('site.description'))
@section('author', $article->present()->author ?? config('site.author'))

@section('title')
{{ $article->title }} | @parent
@stop

@section('page-title')
{{$article->title}}
@stop

@section('content')
    @include('article.blog', ['article' => $article])
@stop

@push('scripts')
@endpush
