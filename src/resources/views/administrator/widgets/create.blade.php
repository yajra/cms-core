@extends('admin::layouts.master')

@section('body', 'sidebar-collapse')

@section('title')
New Widget | @parent
@stop

@push('styles')
@endpush

@section('page-title')
    @pageHeader('New Widget', 'Create a widget.', 'fa fa-plus')
@stop

@section('content')
    {!! form()->model($widget, ['url' => route('administrator.widgets.store')]) !!}
    @include('administrator.widgets.partials.form')
    {!! form()->close() !!}
@stop
