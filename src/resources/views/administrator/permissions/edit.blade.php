@extends('admin::layouts.master')

@section('title')
Update Permission | @parent
@stop

@section('page-title')
    @pageHeader('Update Permission', 'Update users permission and attach role.', 'fa fa-edit')
@stop

@section('content')
    {!! form()->model($permission, ['url' => route('administrator.permissions.update', $permission->id), 'method' => 'put']) !!}
    @include('administrator.permissions.partials.form')
    {!! form()->close() !!}
@stop
