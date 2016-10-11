@extends('admin::layouts.master')

@section('page-title')

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
