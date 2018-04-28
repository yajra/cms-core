@extends('layouts.master')

@section('title', trans('cms::search.title'))
@section('page-title', trans('cms::search.title'))
@section('body', 'search')

@section('content')
    <h1>{{trans('cms::search.title')}}</h1>

    @include('search.partials.form')

    <hr>

    @if ($articles)
        <h2 class="lead">{{trans('cms::search.results')}} <span class="keyword">{{$keyword}}</span></h2>
        @forelse($articles as $article)
            <li>
                <a href="{{ $article->getUrl() }}">{{ $article->present()->introTitle(80) }}</a>
                <small class="muted">({{$article->category->title}})</small>
                <small class="pull-right"><i class="fa fa-calendar-o"></i> {{$article->created_at->format('F d, Y')}}
                </small>
            </li>
        @empty
            <p>{{trans('cms::search.empty')}}</p>
        @endforelse

        {{$articles->links()}}
    @endif
@stop
