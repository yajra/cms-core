@extends('admin::layouts.master')

@section('title')
{{trans('cms::user.edit.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::user.edit.title', 'cms::user.edit.description', 'cms::user.edit.icon')
@stop

@section('content')
    {!! form()->model($user, ['url' => route('administrator.users.update', $user->id), 'method' => 'put']) !!}
    @include('administrator.users.partials.form')
    {!! form()->close() !!}
@stop
