@extends('admin::layouts.master')

@section('title')
    New Permission | @parent
@stop

@section('page-title')
    @pageHeader('New Permission', 'Create users permission and attach role.', 'fa fa-plus')
@stop

@section('content')
    {!! form()->model($permission, ['url' => route('administrator.permissions.store')]) !!}
    @include('administrator.permissions.partials.form')
    {!! form()->close() !!}
@stop
