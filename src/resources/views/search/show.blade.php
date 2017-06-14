@extends('layouts.master')

@section('body', 'search')

@section('title')
    {{ trans('cms::search.title') }} | @parent
@stop

@section('page-title')
    {{ trans('cms::search.title') }}
@stop

@section('content')
    @include('search.partials.form')

    <hr>

    @if ($articles)
        <h3 class="lead">{{trans('cms::search.results')}} <span class="keyword">{{$keyword}}</span></h3>
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
