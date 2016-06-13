@extends('admin::layouts.master')

@section('title')
    Update Widget | @parent
@stop

@section('page-title')
    @pageHeader('Update Widget', 'Update a widget.', 'fa fa-edit')
@stop

@section('content')
    {!! form()->model($widget, ['url' => route('administrator.widgets.update', $widget->id), 'method' => 'put']) !!}
    @include('administrator.widgets.partials.form')
    {!! form()->close() !!}
@stop
