@extends('admin::layouts.master')

@section('title')
{{trans('cms::article.edit.title')}} | @parent
@stop

@section('body', 'sidebar-collapse')

@section('page-title')
    @pageHeader('cms::article.edit.title', 'cms::article.edit.description', 'cms::article.edit.icon')
@stop

@section('content')
    {!! form()->model($article, ['url' => route('administrator.articles.update', $article->id), 'method' => 'PUT']) !!}
    <div class="box box-primary">
        <div class="box-body">
            <a href="{{ route('administrator.articles.index') }}" class="btn btn-warning text-bold">{{trans('button.cancel')}}</a>
            <button type="submit" class="btn btn-primary text-bold">{{trans('button.update')}}</button>
        </div>
    </div>

    @include('administrator.articles.partials.form')
    {!! form()->close() !!}
@stop
