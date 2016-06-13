@extends('admin::layouts.master')

@section('title')
{{trans('article.create.title')}} | @parent
@stop

@section('body', 'sidebar-collapse')

@section('page-title')
    @pageHeader('article.create.title', 'article.create.description', 'article.create.icon')
@stop

@section('content')
    {!! form()->model($article, ['url' => route('administrator.articles.store')]) !!}
    <div class="box box-solid">
        <div class="box-footer">
            <a href="{{ route('administrator.articles.index') }}" class="btn btn-warning text-bold text-uppercase">
                {{trans('button.cancel')}}
            </a>
            <button type="submit" class="btn btn-primary text-bold text-uppercase">
                <i class="fa fa-check"></i> {{trans('button.save')}}
            </button>
        </div>
    </div>

    @include('administrator.articles.partials.form')
    {!! form()->close() !!}
@stop

