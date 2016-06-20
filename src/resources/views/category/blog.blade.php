@extends('layouts.master')

@section('body', '')

@push('styles')
@endpush

@section('title')
    {{ $category->title }} | @parent
@stop

@section('keywords', $category->param('meta_keywords') ?? config('site.keywords'))
@section('description', $category->param('meta_description') ?? config('site.description'))
@section('author', $category->param('author') ?? config('site.author'))

@section('page-title')
    {{ $category->title }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="lead">{{ $category->title }}</div>
        </div>
        <div class="col-md-6">
            <ul class="breadcrumb">
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                @foreach($category->getAncestorsAndSelfWithoutRoot(['title', 'alias']) as $breadcrumb)
                    <li><a href="{{ url('category/' . $breadcrumb->alias . '/blog') }}">{{ $breadcrumb->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

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
