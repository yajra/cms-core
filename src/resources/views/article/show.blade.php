@extends('layouts.master')

@section('body', '')

@push('styles')
@endpush

@section('keywords', $article->fluentParameters()->meta_keywords ?? config('site.keywords'))
@section('description', $article->fluentParameters()->meta_description ?? config('site.description'))
@section('author', $article->present()->author ?? config('site.author'))

@section('title')
{{ $article->title }} | @parent
@stop

@section('page-title')
{{$article->title}}
@stop

@section('content')
    <h3 class="article-title">{{ $article->title }}</h3>
    <p>
        <small class="article-author"><i class="fa fa-user"></i> {{ $article->present()->author() }}</small>
        &nbsp;&nbsp;
        <small class="article-date"><i class="fa fa-calendar"></i> {{ $article->present()->dateCreated() }}</small>
    </p>
    <div class="article-content">
        {!! $article->present()->content() !!}
    </div>
@stop

@push('scripts')
@endpush
