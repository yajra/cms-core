@extends('layouts.' . $template)

@section('title', $article->title)
@section('keywords', $article->param('meta_keywords') ?? config('site.keywords'))
@section('description', $article->param('meta_description') ?? config('site.description'))
@section('author', $article->present()->author ?? config('site.author'))
@section('page-title', $article->title)

@section('content')
    @include('article.blog', ['article' => $article])
@stop
