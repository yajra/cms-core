@extends('admin::layouts.master')

@section('title')
    {{trans('cms::utilities.index.title')}} | @parent
@stop

@push('styles')
@endpush

@section('page-title')
    @pageHeader('cms::utilities.index.title', 'cms::utilities.index.description', 'cms::utilities.index.icon')
@stop

@section('content')
    <iframe src="{{route('administrator.utilities.info', ['dump'])}}" frameborder="0" width="100%" height="600px"></iframe>
@stop

@push('scripts')
@endpush
