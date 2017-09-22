@extends('layouts.master')

@section('title')
{{trans('cms::permission.resource.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::permission.resource.title', 'cms::permission.resource.description', 'cms::permission.resource.icon')
@stop

@section('content')
    {!! form()->model($permission, ['url' => route('administrator.permissions.store-resource')]) !!}
    @include('administrator.permissions.partials.form-resource')
    {!! form()->close() !!}
@stop
