@extends('admin::layouts.master')

@section('title')
{{trans('cms::widget.edit.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('cms::widget.edit.title', 'cms::widget.edit.description', 'cms::widget.edit.icon')
@stop

@section('content')
    {!! form()->model($widget, ['url' => route('administrator.widgets.update', $widget->id), 'method' => 'put']) !!}
    @include('administrator.widgets.partials.form')
    {!! form()->close() !!}
@stop
