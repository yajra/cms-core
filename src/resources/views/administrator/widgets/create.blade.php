@extends('admin::layouts.master')

@section('body', 'sidebar-collapse')

@section('title')
{{trans('cms::widget.create.title')}} | @parent
@stop

@push('styles')
@endpush

@section('page-title')
    @pageHeader('cms::widget.create.title', 'cms::widget.create.description', 'cms::widget.create.icon')
@stop

@section('content')
    {!! form()->model($widget, ['url' => route('administrator.widgets.store')]) !!}
    @include('administrator.widgets.partials.form')
    {!! form()->close() !!}
@stop
