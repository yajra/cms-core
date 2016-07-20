@extends('layouts.master')

@section('body', '')

@push('styles')
@endpush

@section('title')
    {{ $category->title }} | @parent
@stop

@section('keywords', $category->param('meta_keywords') ?? config('site.keywords'))
@section('description', $category->param('meta_description') ?? config('site.description'))
@section('author', $category->param('author_alias') ?? config('site.author'))

@section('page-title')
    {{ $category->title }}
@stop

@section('content')
    @if($category->param('show_description'))
        <div class="row category-description">
            <div class="col-md-12">
                {!! $category->description !!}
            </div>
        </div>
    @endif

    @each('category.partials.articles', $articles, 'article', 'category.partials.no-articles')

    {!! $articles->render() !!}
@stop
