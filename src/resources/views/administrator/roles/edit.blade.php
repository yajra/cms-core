@extends('admin::layouts.master')

@section('title')
{{trans('cms::role.edit.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::role.edit.title', 'cms::role.edit.description', 'cms::role.edit.icon')
@stop

@section('content')
    {!! form()->model($role, ['url' => route('administrator.roles.update', $role->id), 'method' => 'put']) !!}
    @include('administrator.roles.partials.form')
    {!! form()->close() !!}
@stop
