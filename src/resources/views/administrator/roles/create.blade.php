@extends('admin::layouts.master')

@section('title')
New Role | @parent
@stop

@push('styles')
<style>
    .has-error .md-checkbox label, .has-error.md-checkbox label{
        color: #BD000F !important;
    }
</style>
@endpush

@section('page-title')
    @pageHeader('New Role', 'Create users role and attach permissions.', 'fa fa-plus')
@stop

@section('content')
    {!! form()->model($role, ['url' => route('administrator.roles.store')]) !!}
    @include('administrator.roles.partials.form')
    {!! form()->close() !!}
@stop
