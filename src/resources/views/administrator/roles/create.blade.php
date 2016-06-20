@extends('admin::layouts.master')

@section('title')
{{trans('cms::role.create.title')}} | @parent
@stop

@push('styles')
<style>
    .has-error .md-checkbox label, .has-error.md-checkbox label{
        color: #BD000F !important;
    }
</style>
@endpush

@section('page-title')
    @pageHeader('cms::role.create.title', 'cms::role.create.description', 'cms::role.create.icon')
@stop

@section('content')
    {!! form()->model($role, ['url' => route('administrator.roles.store')]) !!}
    @include('administrator.roles.partials.form')
    {!! form()->close() !!}
@stop
