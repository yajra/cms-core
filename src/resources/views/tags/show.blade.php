@extends('layouts.master')

@section('title', 'TAG: ' . $slug)
@section('page-title', $slug)

@section('content')
    <h1>Articles for tag: {{ $slug }}</h1>

    @each('category.partials.articles', $articles, 'article', 'category.partials.no-articles')

    {!! $articles->render() !!}
@stop
