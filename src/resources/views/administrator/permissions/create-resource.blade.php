@extends('admin::layouts.master')

@section('title')
New Permission Resource | @parent
@stop

@section('page-title')
    @pageHeader('New Permission Resource', 'Create users resource permission and attach role.', 'fa fa-plus')
@stop

@section('content')
    {!! form()->model($permission, ['url' => route('administrator.permissions.store-resource')]) !!}
    @include('administrator.permissions.partials.form-resource')
    {!! form()->close() !!}
@stop
