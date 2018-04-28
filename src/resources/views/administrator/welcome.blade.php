@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title')
    <h1>{{trans('cms::backend.welcome.title', ['title' => config('site.name')])}}</h1>
    <p class="help-block">{{trans('cms::backend.welcome.description')}}</p>
@stop

@section('content')
    @include('administrator.dashboard.stats')

    <div class="row">
        <div class="col-md-6">
            @can('article.view')
                @include('administrator.dashboard.latest')
            @endcan

            @can('utilities.view')
                @include('administrator.dashboard.config')
            @endcan
        </div>

        <div class="col-md-6">
            @can('article.view')
                @include('administrator.dashboard.popular')
            @endcan
        </div>
    </div>
@endsection
