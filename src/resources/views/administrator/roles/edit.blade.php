@extends('admin::layouts.master')

@section('title')
    Update Role | @parent
@stop

@section('page-title')
    @pageHeader('Update Role', 'Update users role and attach permissions.', 'fa fa-edit')
@stop

@section('content')
    {!! form()->model($role, ['url' => route('administrator.roles.update', $role->id), 'method' => 'put']) !!}
    @include('administrator.roles.partials.form')
    {!! form()->close() !!}
@stop
