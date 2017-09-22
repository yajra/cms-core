@extends('layouts.master')

@section('title')
{{trans('cms::permission.edit.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::permission.edit.title', 'cms::permission.edit.description', 'cms::permission.edit.icon')
@stop

@section('content')
    {!! form()->model($permission, ['url' => route('administrator.permissions.update', $permission->id), 'method' => 'put']) !!}
    @include('administrator.permissions.partials.form')
    {!! form()->close() !!}
@stop
