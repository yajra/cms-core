@extends('admin::layouts.master')

@section('title')
{{trans('cms::permission.create.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::permission.create.title', 'cms::permission.create.description', 'cms::permission.create.icon')
@stop

@section('content')
    {!! form()->model($permission, ['url' => route('administrator.permissions.store')]) !!}
    @include('administrator.permissions.partials.form')
    {!! form()->close() !!}
@stop
